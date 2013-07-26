/**
 * Js control for flash player
 * User: ssergy
 * Date: 17.02.12
 * Time: 11:23
 *
 */


var myListener = new Object();
var curTrack = 0;
var curVolume =  70;
var startSlide = 0;


/**
 * Initialisation
 */
myListener.onInit = function()
{
    this.position = 0;

    if(typeof playitem != "undefined" && playitem > 0)
    {
        //start selected track (if it exists in list)
        if($('#list').find('tr[tid=' + playitem + ']').length > 0)
        {
            play($('#list').find('tr[tid=' + playitem + ']').attr('track'), playitem);
        }
        else
        {
            play('', 0);
        }
    }
    else
    {
        //start first track
        play('', 0);
    }
};


/**
 * Update
 */
myListener.onUpdate = function()
{
    /*
        document.getElementById("info_playing").innerHTML = this.isPlaying;
        document.getElementById("info_url").innerHTML = this.url;
        document.getElementById("info_volume").innerHTML = this.volume;
        document.getElementById("info_position").innerHTML = this.position;
        document.getElementById("info_duration").innerHTML = this.duration;
        document.getElementById("info_bytes").innerHTML = this.bytesLoaded + "/" + this.bytesTotal + " (" + this.bytesPercent + "%)";
        */
    //position && duration
    var seconds = Math.round(this.position/1000);
    var minutes = Math.floor( seconds/60 );
    seconds = 1*seconds - 60*minutes;
    $('.track_time1').html( minutes+':'+(seconds<10 ? '0' : '')+seconds );
    
    /*
    var seconds = Math.round(this.duration/1000);
    var minutes = Math.floor( seconds/60 );
    seconds = seconds - 60*minutes;
    $('.track_time2').html( minutes+':'+(seconds<10 ? '0' : '')+seconds );
    */
   
    //play buttons
    var isPlay = ("true"==this.isPlaying);
    if (isPlay)
    {
        $('.player_control').find('.track_play').hide();
        $('.player_control').find('.track_pause').show(); 
    }
    else
    {
        $('.player_control').find('.track_pause').hide();
        $('.player_control').find('.track_play').show();  
    }
    
        
    //slider    
    var sliderPosition = 0 + Math.round(100 * this.position / this.duration);
    //$( "#slider" ).slider( "option", "value", sliderPosition );
    $('#fd-slider-slider-h').find('.fd-slider-handle').css('left', 5*sliderPosition+'px');
    $('.track_bar').width( sliderPosition + '%');
    if("false" == this.isPlaying && this.position == 0)
    {
        next();
    }
};

function getFlashObject(obj)
{
    if(typeof obj != "undefined" && obj != null)
    {
        return obj.getElementById("myFlash");
    }
    return document.getElementById("myFlash");
}

function updateTrackBlock(track, obj)
{
    var curTR = null;
    var curTrackBlock = null;
    var curTrackImage = null;
    if(typeof obj != "undefined" && obj != null)
    {
        curTR = $('#list', obj).find('tr[tid=' + curTrack + ']');
        curTrackBlock = $('.track_block', obj);
        curTrackImage = $('.album_img', obj);
    }
    else
    {
        curTR = $('#list').find('tr[tid=' + curTrack + ']');
        curTrackBlock = $('.track_block');
        curTrackImage = $('.album_img');
    }
    
    $('.track_time2').html( $('.track_time', curTR).html() );

    $('.track_name', curTrackBlock).html( $('.ttl', curTR).html() );
    $('.track_author a', curTrackBlock).attr('href', $('.artist', curTR).attr('href') );
    $('.track_author a', curTrackBlock).html( $('.artist', curTR).html() );
    $('.track_author a', curTrackBlock).attr('genres', $('.artist', curTR).attr('genres') );
    if($('.albumttl', curTR).html() != '')
    {
        if(1*$('.albumttl', curTR).attr('active') == 1)
        {
            $('.track_album a', curTrackBlock).attr('href', $('.artist', curTR).attr('href') + '/music/' + $('.albumttl', curTR).attr('mid'));
        }
        else
        {
            $('.track_album a', curTrackBlock).attr('href', $('.artist', curTR).attr('href') + '/music');
        }
        
        $('.track_album a', curTrackBlock).html( $('.albumttl', curTR).html() );
        $('.track_album', curTrackBlock).show();
        if(1*$('.albumttl', curTR).attr('price') > 0 && 1*$('.albumttl', curTR).attr('buyed') == 0 && 1*$('.albumttl', curTR).attr('active') == 1)
        {
            $('.track_buttons .buy_album', curTrackBlock).attr('mid', $('.albumttl', curTR).attr('mid'));
            $('.track_buttons .buy_album', curTrackBlock).attr('price', $('.albumttl', curTR).attr('price'));
            $('.track_buttons .buy_album', curTrackBlock).attr('tracks', $('.albumttl', curTR).attr('tracks'));
            $('.track_buttons .buy_album', curTrackBlock).attr('savings', $('.albumttl', curTR).attr('savings'));
            $('.track_buttons .buy_album', curTrackBlock).show();
        }
        else
        {
            $('.track_buttons .buy_album', curTrackBlock).hide();
        }
    }
    else
    {
        $('.track_album', curTrackBlock).hide();
        $('.track_buttons .buy_album', curTrackBlock).hide();
    }
    if($('img', curTR).length > 0)
    {
        $('a', curTrackImage).attr('href', $('.track_album a', curTrackBlock).attr('href'));
        var imsrc = $('img', curTR).attr('src');
        imsrc = imsrc.replace('/x_', '/m_');
        imsrc = imsrc.replace('/ph/album-22x22', '/ph/album-96x96');
        $('img', curTrackImage).attr('src', imsrc);
        $(curTrackImage).show();
    }
    else
    {
        $(curTrackImage).hide();
    }
    if($('.buy_music', curTR).length > 0)
    {
        $('.track_buttons', curTrackBlock).show();
        $('.track_buttons .buy_music').attr('mid', $('.buy_music', curTR).attr('mid'));
        $('.track_buttons .buy_music').attr('price', $('.buy_music', curTR).attr('price'));
    }
    else
    {
        $('.track_buttons', curTrackBlock).hide();
    }
}

function play(file, track, obj)
{
    if (file != '')
    {
        getFlashObject(obj).SetVariable("method:setUrl", file);
        curTrack = track;
    }
    
    if (file == '' && !curTrack)
    {
        getFlashObject(obj).SetVariable("method:setUrl", $('.tracks_table tr:first').attr('track'));
        curTrack = $('.tracks_table tr:first').attr('tid');      
    }
    updateTrackBlock(track, obj);
    
    getFlashObject(obj).SetVariable("method:play", "");
    getFlashObject(obj).SetVariable("enabled", "true");
}

function next()
{
    var next_track = '';
    var next_tid = 0;
    if($('#list').find('tr[tid=' + curTrack + ']').next('tr').length > 0)
    {
        next_track = $('#list').find('tr[tid=' + curTrack + ']').next('tr').attr('track');
        next_tid = $('#list').find('tr[tid=' + curTrack + ']').next('tr').attr('tid');
    }
    if(next_track != '')
    {
        play(next_track, next_tid);
    }
}

function prev()
{
    var prev_track = '';
    var prev_tid = 0;
    if($('#list').find('tr[tid=' + curTrack + ']').prev('tr').length > 0)
    {
        prev_track = $('#list').find('tr[tid=' + curTrack + ']').prev('tr').attr('track');
        prev_tid = $('#list').find('tr[tid=' + curTrack + ']').prev('tr').attr('tid');
    }
    if(prev_track != '')
    {
        play(prev_track, prev_tid);
    }
}

function pause(obj)
{
    getFlashObject(obj).SetVariable("method:pause", "");
}

function stop(obj)
{
    getFlashObject(obj).SetVariable("method:stop", "");   
}

function setPosition( position )
{
    getFlashObject().SetVariable("method:setPosition", position);
}

function setVolume( volume )
{
    getFlashObject().SetVariable("method:setVolume", volume);
    curVolume = volume;
}


//Init slider
$(document).ready(function () {
    //sound control
    $('.track_sound').click(function() {
        if ($(this).hasClass('off'))
        {
            $(this).removeClass('off');
            setVolume(curVolume);
        }
        else
        {
            $(this).addClass('off');
            setVolume(0);
        }    
    });
    
});


//vetical slide callback
function DoSlide()
{
    var px = $('#fd-slider-slider-v').find('.fd-slider-handle').css('top');
    px = parseInt( px.replace('px', '') );
    $('.volume_progress').height( ((1-px/47) * 100)+'%' );
    setVolume( Math.ceil((1-px/47) * 100) );
    
    if (0==Math.ceil((1-px/47) * 100) && !$('.track_sound').hasClass('off'))
    {
        $('.track_sound').addClass('off');
    }
    else if (0<Math.ceil((1-px/47) * 100) && $('.track_sound').hasClass('off'))
    {
        $('.track_sound').removeClass('off');
    }
}

function SetUpSlide()
{
    //setup vertical slider
    //var h = $('.volume_progress').css('height');
    //alert(h);
    //h = parseInt(h.replace('%', ''));
    h = 70;//TODO -если меняется начальная громкость - менять тут и в шаблоне
    $('#fd-slider-slider-v').find('.fd-slider-handle').css('top', 47 - Math.ceil(h*47/100)+'px');
}

//horizontal slide callback
function DoSlideH()
{
    var px = $('#fd-slider-slider-h').find('.fd-slider-handle').css('left');
    px = Math.ceil( parseInt( px.replace('px', '') ) / 5 );
    $('.track_bar').width( px + '%' );
    
    getFlashObject().SetVariable("method:setVolume", 0);
    setPosition( Math.ceil(myListener.duration*(px/100)) );
    getFlashObject().SetVariable("method:setVolume", curVolume);
    
}