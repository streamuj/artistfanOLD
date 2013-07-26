function Play()
{

}

Play.prototype =
{
    ShowPlayer: function( action, data ) {
        var data = (typeof data != "undefined") ? data : '';
        
        if (typeof mPlayer == "undefined" || mPlayer.closed || mPlayer.document==null || mPlayer.location==null)
        {
            //если документ не существует - нужно указать, что именно туда грузить
            //
            //get modal window
            var params = "menubar=no,location=yes,resizable=no,scrollbars=no,status=yes,width=687,height=636";
            mPlayer = window.open('/base/player/play?action='+action+'&data='+data, "player", params);
            mPlayer.focus();
        }
        else
        {
            //иначе обновляем содержимое и перезапускаем плеер
            var obj = mPlayer.document;

            //actions
            switch (action)
            {
                //add one track to player
                case 'add_track':
                //add one album to player
                case 'add_album':
                    $.ajax({
                        type:'POST',
                        dataType:'json',
                        data:{'action': action, 'data': data, 'json': 1},
                        url:'/base/player/play',
                        success:function (data)
                        {
							
                            if (data.q == 'ok')
                            {
                                $('#list', obj).empty();
                                var s = '';
                                for (var i in data.data)
                                {
                                    s = '<tr track="/' + ((data.data[i]['TrackPreview'] && data.data[i]['Price']>0 && data.data[i]['IsOther'] && (typeof data.data[i]['MusicPurchase'] == "undefined" || data.data[i]['MusicPurchase']==null)) ? data.data[i]['TrackPreview'] : data.data[i]['Track']) + '" tid="'+data.data[i]['Id'] + '">' +
                                        '<td><a href="javascript:void(0);" onclick="play($(this).parents(\'tr\').attr(\'track\'), $(this).parents(\'tr\').attr(\'tid\'));"><img width="22" height="22" alt="" src="/' + (data.data[i]['Image'] ? data.data[i]['Image'] : 'i/ph/track-22x22.png') + '" /></a><span class="albumttl" mid="'+data.data[i]['AlbumId']+'" price="'+data.data[i]['AlbumPrice']+'" savings="'+data.data[i]['AlbumSavings']+'" tracks="'+data.data[i]['AlbumTracks']+'" buyed="'+data.data[i]['MusicPurchase']['WithAllAlbum']+'" active="'+(data.data[i]['AlbumActive'] && !data.data[i]['AlbumDeleted'] ? 1 : 0)+'" style="display:none;">'+data.data[i]['AlbumTitle'] + '</span></td>' +
                                        '<td><strong><a href="javascript:void(0);" onclick="play($(this).parents(\'tr\').attr(\'track\'), $(this).parents(\'tr\').attr(\'tid\'));" class="ttl">' + data.data[i]['Title'] + '</a></strong> <br /> by <a href="/u/' + data.data[i]['Name'] + '" class="artist">' + data.data[i]['Band'] + '</a></td>' +
                                        '<td><span class="track_time">';
                                    if(data.data[i]['TrackPreview'] && data.data[i]['Price']>0 && data.data[i]['IsOther'] && (typeof data.data[i]['MusicPurchase'] == "undefined" || data.data[i]['MusicPurchase']==null))
                                    {
                                        s += data.data[i]['TrackPreviewLength'];
                                    }
                                    else
                                    {
                                        s += data.data[i]['TrackLength'];
                                    }
                                    s += '</span></td>';
                                    s += '<td class="number">';
                                    if (data.data[i]['Price']>0 && data.Status!=2 && data.data[i]['IsOther'] && (typeof data.data[i]['MusicPurchase'] == "undefined" || data.data[i]['MusicPurchase']==null))
                                    {
                                        s += '<span class="pricetag">' + data.data[i]['Price'] + '</span>';
                                    }
                                    else if(!data.data[i]['Price'] && data.Status!=2 && data.data[i]['IsOther'] && (typeof data.data[i]['MusicPurchase'] == "undefined" || data.data[i]['MusicPurchase']==null))
                                    {
                                        s += '<span class="pricetag free">Free</span>';
                                    }
                                    else if(!data.data[i]['Price'] || (data.IsAuth && !data.data[i]['IsOther']) || data.data[i]['MusicPurchase'])
                                    {
                                        s += '<span class="pricetag own">&#10004;</span>';
                                    }
                                    s += '</td>';

                                    s += '<td>';
                                    if (data.data[i]['Price']>0 && data.Status!=2 && data.data[i]['IsOther'] && (typeof data.data[i]['MusicPurchase'] == "undefined" || data.data[i]['MusicPurchase']==null))
                                    {
                                        s += '<a href="javascript: void(0);" class="button yellow_button buy_music" onclick="' + (data.Status==1 ? 'oProfile.InitBuyMusic(this);' : 'oProfile.PurchaseRedirect(\'track\', $(this).attr(\'mid\'), 1)') + '" mid="' + data.data[i]['Id'] + '" price="' + data.data[i]['Price'] + '">Buy</a>';
                                    }
                                    else if(!data.data[i]['Price'] && data.Status!=2 && data.data[i]['IsOther'] && (typeof data.data[i]['MusicPurchase'] == "undefined" || data.data[i]['MusicPurchase']==null))
                                    {
                                        s += '<a href="javascript: void(0);" class="button yellow_button add_music" onclick="' + (data.Status==1 ? 'oProfile.InitBuyMusic(this);' : 'oProfile.PurchaseRedirect(\'track\', $(this).attr(\'mid\'), 1)') + '" mid="' + data.data[i]['Id'] + '" price="0">Add to My music</a>';
                                    }
                                    else if(!data.data[i]['Price'] || (data.IsAuth && !data.data[i]['IsOther']) || data.data[i]['MusicPurchase'])
                                    {
                                        s += '<a href="/' + data.data[i]['Track'] + '" class="button">Download</a>';
                                    }
                                    s += '</td>' +
                                        '<td><a href="#" class="del"></a></td>' +
                                        '</tr>';
                                    $('#list', obj).append(s);
                                }
                                if(data.data[0] != "undefined" && data.data[0] != null)
                                {
                                    //stop(obj);
                                    //play first loaded track
                                    if (data.data[0]['TrackPreview'] && data.Status==1 && data.data[0]['Price']>0 && data.data[0]['IsOther'] && (typeof data.data[0]['MusicPurchase'] == "undefined" || data.data[0]['MusicPurchase']==null))
                                    {
                                        play('/' + data.data[0]['TrackPreview'], data.data[0]['Id'], obj);
                                    }
                                    else if(!data.data[0]['Price'] || (data.IsAuth && !data.data[0]['IsOther']) || data.data[0]['MusicPurchase'])
                                    {
                                        play('/' + data.data[0]['Track'], data.data[0]['Id'], obj);
                                    }
                                }
                            }
                        }
                    });
                    mPlayer.focus();

                break;

                //play current user tracks
                case 'playlist':
                    $.ajax({
                        type:'POST',
                        dataType:'json',
                        data:{'action': action, 'data': data, 'json': 1},
                        url:'/base/player/play',
                        success:function (data)
                        {
                            if (data.q == 'ok')
                            {
                                $('#list', obj).empty();
                                var starti = 0;
                                var s = '';
                                for (var i in data.data)
                                {
                                    s = '<tr track="/' + data.data[i]['Track'] + '" tid="'+data.data[i]['Id'] + '">' +
                                        '<td><a href="javascript:void(0);" onclick="play($(this).parents(\'tr\').attr(\'track\'), $(this).parents(\'tr\').attr(\'tid\'));"><img width="22" height="22" alt="" src="/' + (data.data[i]['Image'] ? data.data[i]['Image'] : 'i/ph/track-22x22.png') + '" /></a><span class="albumttl" mid="'+data.data[i]['AlbumId']+'" active="'+(data.data[i]['AlbumActive'] && !data.data[i]['AlbumDeleted'] ? 1 : 0)+'" style="display:none;">'+data.data[i]['AlbumTitle'] + '</span></td>' +
                                        '<td><strong><a href="javascript:void(0);" onclick="play($(this).parents(\'tr\').attr(\'track\'), $(this).parents(\'tr\').attr(\'tid\'));" class="ttl">' + data.data[i]['Title'] + '</a></strong> <br /> by <a href="/u/' + data.data[i]['Name'] + '" class="artist">' + data.data[i]['Band'] + '</a></td>' +
                                        '<td><span class="track_time">' + data.data[i]['TrackLength'] + '</span></td>' +
                                        '<td class="number"><span class="pricetag own">&#10004;</span></td>' +
                                        '<td>' + 
                                        '<a href="/' + data.data[i]['Track'] + '" class="button">Download</a>' +
                                        '</td>' +
                                        '<td><a href="#" class="del"></a></td>' +
                                        '</tr>';
                                    $('#list', obj).append(s);
                                    if(data.playitem == data.data[i]['Id'])
                                    {
                                        starti = i;
                                    }
                                }
                                if(data.data[starti] != "undefined" && data.data[starti] != null)
                                {
                                    stop(obj);
                                    //play selected (or first) track in playlist
                                    play('/' + data.data[starti]['Track'], data.data[starti]['Id'], obj);
                                }
                            }
                        }
                    });
                    mPlayer.focus();

                    break;
            }

            //console.log( $(obj).find('.tracks_table').html() );
            //$(obj).find('.tracks_table tr:fisrt').click();
        }
    },
    DeleteMusic: function(id, user_id)
    {
        var user_id = typeof user_id != "undefined" ? user_id : 0;

        if(!confirm('Do you really want to delete this song from your music library?'))
        {
            return;
        }
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id+'&user_id='+user_id,
            url:      '/base/fan/Music',
            success: function (data)
            {
                if (data.q == 'ok')
                {
                    $('#music_track').html(data.data);
                }
            }
        });
    },	
    DeleteVideo: function( id )
    {
        var user_id = typeof user_id != "undefined" ? user_id : 0;

        if(!confirm('Do you really want to delete this video from your video list?'))
        {
            return;
        }
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "delete_video_id="+id,
            url:      '/base/fan/Video',
            success: function (data)
            {
                if (data.q == 'ok')
                {
                    $('#video_list').html(data.data);
                }
            }
        });
    },
	
    InitPlayButtons: function()
    {
        $('body').delegate('.play_album', 'click', function(){
		//$('.play_album').click(function() {
            oPlay.ShowPlayer('add_album', $(this).attr('mid'));
        });
        $('body').delegate('.play_track', 'click', function(){
		//$('.play_track').click(function() {
            oPlay.ShowPlayer('add_track', $(this).attr('mid'));
        });
		$('body').delegate('.playlist_track', 'click', function(){
        //$('.playlist_track').click(function() {
            oPlay.ShowPlayer('playlist', $(this).attr('mid'));
        });
		$('body').delegate('.playlist', 'click', function(){
        //$('.playlist').click(function() {
            oPlay.ShowPlayer('playlist');
        });
    }
}
//play class
var oPlay = new Play;
//player window
var mPlayer;
