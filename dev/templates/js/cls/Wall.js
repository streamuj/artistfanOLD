/**
 * Wall js controller
 *
 */
 

function Wall()
{

}


Wall.prototype =
{
    __construct:function ()
    {
        $(document).ready(function ()
        {
        });
    },

    PostComment: function(event){
		if(event.keyCode == 13 && event.shiftKey == 0)  {
			var thisObj = $(this);
			var val = thisObj.val();
			var wallId = thisObj.attr('id').split('_')[1];
			if($.trim(val) == ''){
				this.focus();
				alert('Please enter comment');
				return false;
			} else {
				$.ajax({
					 type:'POST',
					 dataType:'json',
					 data:{'mesg': val, 'wallId': wallId},
					 url:'/base/profile/AddWallComment',
					 dataType: 'json',
					 success: function(data){
						 if (data.q == 'ok')
						{
							thisObj.val('Add Comments');
							$('#latestComment_'+wallId).append(data.comment);
							oWall.Reload( 1 );
						}
						else if(data.q == 'err')
						{
							$('#err_mesg').html( data.msg ).parent().show();
						}
					}
				})
			}
		}
	},
    Post: function()
    {
        $('#err_mesg').parent().hide();
        var er = 0;
        $('#mesg').removeClass('input_err');
        if (jQuery.trim($("#mesg").val()) == "" || $("#mesg").val()=='Say something...')
        {
            //'Please specify message';
            $('#err_mesg').html('Please specify message').parent().show();
            //$('#mesg').addClass('input_err');
            er = 1;
        }
		if(!oWall.validateVideoURL($("#videoLink").val()))
		{
			//'Please specify message';
			$('#err_mesg').html('Please Copy Valid Video URL(Youtube or Vimeo)').parent().show();
			//$('#mesg').addClass('input_err');
			er = 1;
		}
        if (!er)
        {
            $('.say_form').find('.wait').show();
            $('.say_form').find('.button').addClass('noactive');
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': user_id, 'mesg': $("#mesg").val(), image:$('#wallImage').val(), video:$('#videoLink').val()},
				
                url:'/base/profile/WallPost',
                success:function (data)
                {
                    $('.say_form').find('.wait').hide();
                    $('.say_form').find('.button').removeClass('noactive');
                    if (data.q == 'ok')
                    {
                        $('#mesg').val('Say something...');
						$('#wallImg').hide();
						$('#wallImage').val('');
						$('#videoLink').val('');
						oErrors.SetOkFld('image', '');
						$('#file-uploader').hide();
						$('#video-uploader').hide();
                        oWall.Reload( 1 );
                    }
                    else if(data.q == 'err')
                    {
                        $('#err_mesg').html( data.msg ).parent().show();
                    }
                }
            });
			//alert(mesg);
        }   
    },
    validateVideoURL: function( str )
    {
		str = $.trim(str);		
		if(str == ''){ return true;	}		
		youtube = /http:\/\/www\.youtube.com\//;
		if(youtube.test(str)){
			if(/embed/.test(str)){
				return true;	
			} else if(/watch\?v=([^?&]*)/.test(str)){
				return true;
		   }
		}
		vimeo = /http:\/\/(www\.)?vimeo.com\//;
		if(vimeo.test(str)){
			return true;	
		}
/*		brightcove = /[0-9]{10,}/
		if(brightcove.test(str)){
			return true;	
		}*/
		return false;
	},
    
    Reload: function( doPrReload, before_id )
    {
        var doPrReload = (typeof(doPrReload) != "undefined" && 1==doPrReload) ? 1 : 0;
        var before_id  = (typeof(before_id) != "undefined") ? 1 : 0;
        
        if (before_id)
        {
            before_id = $('.wall:last').attr('wid');
        }
        
        if (doReload && !doPrReload)
        {
            return false;
        }
        doReload = 1;
        $('.wall_more').find('.wait').show();
        var wall_last_id = $('.wall:first').attr('wid');
        var log_last_id = $('.post_info:first').find('p:first').attr('lid');
        $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': user_id, 'after_id': before_id ? 0 : wall_last_id, 'before_id': before_id, 'log_last_id': !before_id ? log_last_id : 0},
                url:'/base/profile/WallLoad',
                success:function (data)
                {
                    if (data.q == 'ok')
                    {
                        var s = '';
                        var wall_id = 0;

                        if(wall_last_id && typeof data.log[wall_last_id] != "undefined")
                        {
                            for(var ii in data.log[wall_last_id])
                            {
                                //s += oWall.ShowLog(data.log[wall_last_id][ii], data.artist);
                            }
                            if(typeof $('.wall_info').find('.wall:first').next('.post_info') != "undefined" && $('.wall_info').find('.wall:first').next('.post_info').length > 0)
                            {
                                $('.wall_info').find('.wall:first').next('.post_info').prepend(s);
                            }
                            else
                            {
                                $('.wall_info').find('.wall:first').after('<div class="post_info">' + s + '</div>');
                            }
                            s = '';
                        }
						s = data.wallDetail;
                        if (before_id)
                        {
                            $('.wall_info').append(s);
                        }
                        else if (wall_last_id)
                        {
                            $('.wall_info').prepend(s);
                        }
                        else
                        {
                            $('.wall_info').html(s);
                        }
                        
                        //show-hide "more" link
                        if (before_id || !wall_last_id)
                        {
                            if ( 1*data.countAll > $('.wall').length )
                            {
                                $('.wall_more a').html((1*data.countAll - $('.wall').length) + ' more wall posts...');
                                $('.wall_more').show();

                            }
                            else
                            {
                                $('.wall_more').hide();
                            }
                        }
                        $('.wall_more').find('.wait').hide();
                        $('#fanscount').html(data.fanscount);
                        doReload = 0;                 
                    }
                }
        });
        if(tm != 0)
        {
            clearTimeout(tm);
        }
        tm = setTimeout("oWall.Reload("+doPrReload+");", 20000);
    },

    ShowLog: function(row, artist)
    {
        var res = '';
        res += '<p lid="'+row['Id']+'">';
        switch(row['Action'])
        {
            case 'buy_track':
                res += '<a href="/u/'+row['Name']+'" class="icon_02">'+(row['BandName'] != '' && row['BandName']!= null ? row['BandName'] : row['FirstName']+' '+row['LastName'])+'</a>' +
                    ' just bought ' + (artist ? artist + "'s" : 'your')+ ' track “'+row['Title']+'”: <b>+'+row['Money']+' credits</b>';
                break;
            case 'buy_album':
                res += '<a href="/u/'+row['Name']+'" class="icon_03">'+(row['BandName'] != '' && row['BandName']!= null ? row['BandName'] : row['FirstName']+' '+row['LastName'])+'</a>' +
                    ' just bought ' + (artist ? artist + "'s" : 'your')+ ' album “'+row['Title']+'”: <b>+'+row['Money']+' credits</b>';
                break;
            case 'buy_video':
                res += '<a href="/u/'+row['Name']+'" class="icon_03">'+(row['BandName'] != '' && row['BandName']!= null ? row['BandName'] : row['FirstName']+' '+row['LastName'])+'</a>' +
                    ' just bought ' + (artist ? artist + "'s" : 'your')+ ' video “'+row['Title']+'”: <b>+'+row['Money']+' credits</b>';
                break;
            case 'buy_access':
                res += '<a href="/u/'+row['Name']+'" class="icon_03">'+(row['BandName'] != '' && row['BandName']!= null ? row['BandName'] : row['FirstName']+' '+row['LastName'])+'</a>' +
                    ' just bought ' + (artist ? artist + "'s" : 'your')+ ' online event access “'+row['Title']+'”: <b>+'+row['Money']+' credits</b>';
                break;
            case 'follow':
                res += '<a href="/u/'+row['Name']+'" class="icon_01">'+(row['BandName'] != '' && row['BandName']!= null ? row['BandName'] : row['FirstName']+' '+row['LastName'])+'</a>' +
                    ' is now following ' + (artist ? artist : 'you');
                break;
        }
        res += '</p>';
        return res;
    },

    MainReload: function()
    {
        if (doReloadM)
        {
            return false;
        }
        doReloadM = 1;
        var wall_last_id = $('.wall_info').find('.twit_block:first').attr('wid');
        $.ajax({
                type:'POST',
                dataType:'json',
                data:{'after_id': wall_last_id},
                url:'/base/profile/WallLoadMain',
                success:function (data)
                {
                    if (data.q == 'ok')
                    {
                        var s = '';
                        for (var i in data.data)
                        {
                            s += '<div class="twit_block" wid="'+data.data[i]['Id']+'">' +
                                '<div class="twit_icon">' +
                                    '<a href="/u/'+data.data[i]['Name']+'"><img src="' + (data.data[i]['Avatar'] != '' ? '/files/images/avatars/x_' + data.data[i]['Avatar'] : '/i/ph/user-22x22.png') + '" width="23" height="23" alt="" /></a>' +
				'</div>' +
				'<div class="twit_text">' +
                                    '<div class="twit_info"><a href="/u/'+data.data[i]['Name']+'">'+(data.data[i]['BandName'] != '' && data.data[i]['BandName'] != null ? data.data[i]['BandName'] : data.data[i]['FirstName']+' '+data.data[i]['LastName'])+'</a> says '+data.data[i]['Pdate'] + ' ago </div>' +
                                    data.data[i]['Mesg'] +
				'</div>' +
				'<div class="cl"></div>' +
                                '</div>';
                        }
                        if(wall_last_id)
                        {
                            $('.wall_info').prepend(s);
                        }
                        else
                        {
                            $('.wall_info').html(s);
                        }
                        $('.wall_info').find('.twit_block:gt(3)').remove();
                        doReloadM = 0;
                    }
                }
        });
        setTimeout("oWall.MainReload();", 20000);
    },

    FeedReload: function( doPrReload, before_id )
    {
        var doPrReload = (typeof(doPrReload) != "undefined" && 1==doPrReload) ? 1 : 0;
        var before_id  = (typeof(before_id) != "undefined") ? 1 : 0;

        if (before_id)
        {
            before_id = $('.wall:last').attr('wid');
        }

      /*  if (doReloadF && !doPrReload)
        {
            return false;
        }
		*/
        doReloadF = 1;
        $('.wall_more').find('.wait').show();
        var wall_last_id = $('.wall:first').attr('wid');
        var st = $('input#from').val();
        $.ajax({
                type:'POST',
                dataType:'json',
                data:{'after_id': before_id ? 0 : wall_last_id, 'before_id': before_id, 'status': st},
                url:'/base/profile/FeedLoad',
                success:function (data)
                {
                    if (data.q == 'ok')
                    {
                        var s = '';
                        var cl = '';
						s = data.wallDetail;

                        if (before_id)
                        {
                            $('.wall_info').append(s);
                        }
                        else if (wall_last_id)
                        {
                            $('.wall_info').prepend(s);
                        }
                        else
                        {
                            $('.wall_info').html(s);
                        }

                        //show-hide "more" link
                        if (before_id || !wall_last_id)
                        {
                             if ( 1*data.countAll > $('.wall').length )
                            {
                                $('.wall_more a').html((1*data.countAll - $('.wall').length) + ' more wall posts...');
                                $('.wall_more').show();

                            }
                            else
                            {
                                $('.wall_more').hide();
                            }
                        }
                        $('.wall_more').find('.wait').hide();
                        doReloadF = 0;
                    }
                }
        });
        if(tm != 0)
        {
            clearTimeout(tm);
        }
        tm = setTimeout("oWall.FeedReload("+doPrReload+");", 20000);
    },

    FeedFilter: function(status, obj)
    {
        var current = $(obj).attr('class');
        if(current.indexOf('active') == -1)
        {
            $('.switch a').removeClass('active');
            $(obj).addClass('active');
            $('input#from').val(status);
            $('.wall_info').html('');
            oWall.FeedReload();
        }
    }
}
$(document).ready(function ()
{
	 $('body').delegate('.wallComment', 'keypress', oWall.PostComment);
	 $('#file-uploader').hide();		
	 $('#video-uploader').hide();
	 $('#tabPhoto').click(function(){
		$('#file-uploader').show();
		$('#video-uploader').hide();
	 });
	 $('#tabVideo').click(function(){
		$('#file-uploader').hide();
		$('#video-uploader').show();
				
	 });
	 if($('#file-uploader').length){
		 var uploader = new qq.FileUploader({
			element: $('#file-uploader')[0],
			action: '/base/profile/UploadWallPhoto',
			params: {},
			// validation
			allowedExtensions: [],
			// each file size limit in bytes
			sizeLimit: 153600000, // max size
			debug: false,
			onSubmit: function(id, fileName){
				oErrors.SetWaitFld('image');
				this.params = {
				'id': user_id,
				};
				$('#progress').show();
			},
			onProgress: function(id, fileName, loaded, total){
				if(total > 0 && loaded <= total ){
					var width = Math.round(loaded / total * 100);
					$('#progress-percent').html(width);
					$('#progress-value').css('width', width + '%');
				}
			},
			onComplete: function(id, fileName, responseJSON){
				$('#progress').hide();
				oErrors.SetClearFld('image');
				if (responseJSON.success==true) {
					var video = '/'+responseJSON['image'];
					$('#wallImg img').attr('src', video);
					$('#wallImg').show();
					$('#wallImage').val(video);
					oErrors.SetOkFld('image', 'File uploaded!');
				}
				else if(responseJSON.error)
				{
					oErrors.SetBadFld('image', responseJSON.error);
				}
			},
			onCancel: function(id, fileName){
				$('#progress').hide();
				oErrors.SetClearFld('image');
			},
	
			multiple: false,
			autoSubmit: true,
	
			messages: {
				
			},
			showMessage: function(message){
				oErrors.SetBadFld('image', message);
			}
		});
	 }
});
var oWall = new Wall();
var tm = 0;
var doReload = 0;
var doReloadM = 0;
var doReloadF = 0;
