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
		isFancyBox = false;
		if($(this).hasClass('fancyComment')){
			isFancyBox = true;
		}
		noOfLines = 5;
		var thisObj = $(this);
		var lineHeight = parseInt(thisObj.css('line-height').substr(0, 2), 10);
		var adjustedHeight = thisObj[0].clientHeight;
		var maxHeight = lineHeight * noOfLines;
		if (maxHeight > adjustedHeight) {			
			adjustedHeight = Math.max(thisObj[0].scrollHeight, adjustedHeight);
			adjustedHeight = Math.min(maxHeight, adjustedHeight);
			if (adjustedHeight > thisObj[0].clientHeight) {
				thisObj.css('height',adjustedHeight +'px');
				//thisObj.height(currentChatAreaHeight);
				thisObj.css('overflow','hidden');
			}
		} else {
			thisObj.css('overflow','auto');
		}
		if(event.keyCode == 13 && event.shiftKey == 0)  {
			var thisObj = $(this);
			var val = thisObj.val();
			var wallId = thisObj.attr('id').split('_')[1];
			if($.trim(val) == ''){
				this.focus();
				//alert('Please enter comment');
				thisObj.val('');				
				return false;
			} else {				
				$.ajax({
					 type:'POST',
					 dataType:'json',
					 data:{'id': user_id, 'mesg': val, 'wallId': wallId, 'fancybox': isFancyBox },
					 url:'/base/profile/AddWallComment',
					 dataType: 'json',
					 success: function(data){
						 checkResponseRedirect(data);
						 if (data.q == 'ok')
						{							
							thisObj.val('');
							$('.wall_'+wallId).hide();
							if(isFancyBox){
								$('#popupComment_'+wallId).append(data.fancyComment);
								box = $('.AlbumPOP').find('.scrollArea');
								if($('.storyContent div.slimScrollDiv').length == 0){
									divHeight = box.height();
									scrollHeight = $('#popBox .Lpic').height() -100;
									if(divHeight >= scrollHeight){
										$(box).slimScroll({ height: scrollHeight });
									}
								} 
								/*
								if($('.storyContent div.slimScrollDiv').length){
									box = $('.AlbumPOP').find('.scrollArea');
									scrollHeight = $('#popBox .Lpic').height() -100;
									var curHeight = $('.slimScrollBar').height();
									//$('.slimScrollBar').css({top: (scrollHeight - curHeight+10)});
									$(box).slimScroll({ scrollTo: scrollHeight +'px' });
								}
								*/
								return;
							}
							if(fWall)
							{
								oWall.FeedReload();
							}
							else
							{
								//$('#latestComment_'+wallId).append(data.comment);								
								oWall.Reload( 1 );
							}
							
						}
						else if(data.q == 'err')
						{
							$('#err_mesg').html( data.msg );
						}
					}
				})
			}
		}
	},
    Post: function()
    {
        $('#err_mesg').removeClass('error');
        var er = 0;
        $('#mesg').removeClass('input_err');
		
		if($('#wallImage').val() =="" && $('#videoLink').val() == "")
		{
			if (jQuery.trim($("#mesg").val()) == "" || $("#mesg").val()=='Say something...')
			{
				//'Please specify message';
				$('#err_mesg').addClass('error').html('Please specify message').show();
				er = 1;
			}
			else
			{
				$('#err_mesg').removeClass('error').html('').hide();
			}
		}
		else
		{
			$('#err_mesg').removeClass('error').html('').hide();
		}
		
		if(!oWall.validateVideoURL($("#videoLink").val()))
		{
			$('#err_mesg').addClass('error').html('Please Copy Valid Video URL(Youtube or Vimeo)').show();
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
					checkResponseRedirect(data);
                    $('.say_form').find('.wait').hide();
                    $('.say_form').find('.button').removeClass('noactive');
                    if (data.q == 'ok')
                    {
                        $('#mesg').val('Say something...');
						$('#sayBtn1').hide();
						$('#wallImg').attr('src', '/si/placeholder.gif');
						$('#wallImage').val('');
						$('#videoLink').val('');
						oErrors.SetOkFld('image', '');
                        oWall.Reload( 1 );
						$('#err_mesg').html('');
						$('#err_mesg').removeClass('error');						
						$('#mesg').css({height: "35px" });
						$('.tab').hide();
						
						$('.say_form .upload_status').removeClass('good').html('');						
                    }
                    else if(data.q == 'err')
                    {
                        $('#err_mesg').addClass('error').html( data.msg ).show();
                    }
                }
            });
			//alert(mesg);
        }   
    },	
    PostFeedWall: function()
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
			$('#err_video').html('Please Copy Valid Video URL(Youtube or Vimeo)').show();
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
					checkResponseRedirect(data);
                    $('.say_form').find('.wait').hide();
                    $('.say_form').find('.button').removeClass('noactive');
                    if (data.q == 'ok')
                    {
                        $('#mesg').val('Say something...');
						//$('#wallImg').hide();
						$('#wallImg').attr('src', '/si/placeholder.gif');
						$('#wallImage').val('');
						$('#videoLink').val('');
						oErrors.SetOkFld('image', '');
                        oWall.FeedReload();
                    }
                    else if(data.q == 'err')
                    {
                        $('#err_mesg').html( data.msg ).show();
                    }
                }
            });
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
            before_id = $('.wall:last').attr('wtime');
        }
		
        if (doReload && !doPrReload)
        {
            return false;
        }
        doReload = 1;
	
        $('.wall_more').find('.wait').show();
        var wall_last_id = $('.wall:first').attr('wtime');
        var log_last_id = $('.post_info:first').find('p:first').attr('lid');
	
        $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': user_id, 'after_id': before_id ? 0 : wall_last_id, 'before_id': before_id, 'log_last_id': !before_id ? log_last_id : 0},
                url:'/base/profile/WallLoad?rand='+Math.random(),
                success:function (data)
                {
					checkResponseRedirect(data);
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
                        
						$('a[rel=group1]').each(function(){
							wallFancySetting.datahref = $(this).attr('data-href');
							$(this).fancybox(wallFancySetting);
						});
						
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

    
    FeedReload: function( doPrReload, before_id )
    {

       var doPrReload = (typeof(doPrReload) != "undefined" && 1==doPrReload) ? 1 : 0;
       var before_id  = (typeof(before_id) != "undefined") ? 1 : 0;

        if (before_id)
        {
            before_id = $('.wall:last').attr('wtime');
        }

      /*  if (doReloadF && !doPrReload)
        {
            return false;
        }
		*/
        doReloadF = 1;
        $('.wall_more').find('.wait').show();
        var wall_last_id = $('.wall:first').attr('wtime');
        var st = $('input#from').val();

        $.ajax({
                type:'POST',
                dataType:'json',
                data:{'after_id': before_id ? 0 : wall_last_id, 'before_id': before_id, 'status': st},
                url:'/base/profile/FeedLoad',
                success:function (data)
                {
					//alert(data.feedWall);
					checkResponseRedirect(data);
                    if (data.q == 'ok')
                    {
                        var s = '';
                        var cl = '';
						s = data.wallDetail;

						//$('input#fWall').val(1);
//						$('#fWall').val(data.feedWall);
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
						$('a[rel=group1]').each(function(){
							//wallFancySetting.href= $(this).attr('href')+'&ajaxMode=1';
							wallFancySetting.datahref = $(this).attr('data-href');
							$(this).fancybox(wallFancySetting);
						});
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
	
	DeleteWall: function(w_id)
	{
		 if (!confirm('Do you wish to delete this wall post?'))
		 {
			 return false;
		 }
		else
		{
			$.ajax({
				type:     'POST',
				dataType: 'json',
				data:     {'id': w_id},
				url:      '/base/profile/wallDelete',
				success: function (data)
				{
					checkResponseRedirect(data);
					if (data.q == 'ok')
					{
						$('#wall_'+w_id).remove();
					}
				}
			});
		}
			
	},
	
	DeleteComment: function(cmt_id)
	{
		 if (!confirm('Do you wish to delete this comment?'))
		 {
			 return false;
		 }
		else
		{
			$.ajax({
				type:     'POST',
				dataType: 'json',
				data:     {'id': cmt_id},
				url:      '/base/profile/commentDelete',
				success: function (data)
				{
					if (data.q == 'ok')
					{
						$('#comment_'+cmt_id).remove();
					}
				}
			});
		}
			
	},	
    FeedFilter: function(status, obj)
    {
		$('input#from').val(status);
        $('.wall_info').html('');
        oWall.FeedReload();
		
    }
}
$(document).ready(function ()
{
	$('body').on('hover', '.commentsDisplay', function(){
		$(this).find('.removeBtn').show();
	});
	$('body').on('mouseleave', '.commentsDisplay', function(){
		$(this).find('.removeBtn').hide();
	});
	 $('body').delegate('.wallComment, .fancyComment', 'keypress', oWall.PostComment);
	 /*$('#tabPhoto').click(function(){		
	   if($('#videoLink').val())
	   {
		   //$('#err_mesg').html("Video Link Added. ");
		   $('#video-uploader').show();
		   $('#videoDialog').dialog('open');			
	   }
	   else
	   {
	   	$('#file-uploader').show();
       	$('#fileDialog').dialog('open');	  
	   }
	   
	 });
	 $('#tabVideo').click(function(){

		if($('#wallImage').val())
		{
		   //$('#err_mesg').html("Photo Added.");		
		   $('#file-uploader').show();
    	   $('#fileDialog').dialog('open');	  		   
	   	}	
		else
		{
		   $('#video-uploader').show();
		   $('#videoDialog').dialog('open');			
		}
	 });
	*/
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
				checkResponseRedirect(responseJSON);
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
					//$('#wallImg').hide();
					//$('#wallImage').val('');
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
	 $.ajaxSetup({
		data: {ajaxMode:1}
	});
	 
	 /*
	 $('#fileDialog, #videoDialog').dialog({
			autoOpen: false,
			width: 500,
			height: 280,
			modal:false,
			buttons:{
			'Cancel' : {
				 "text":'Cancel', "class": 'button bgrey', "click": function() {
					 $('#err_video').html('');
					 $('#err_mesg').removeClass('error').html('');
					 $('#wallImage').val('');					 		 
					 $('#wallImg img').attr('src', '');						 
					 $('#err_image').html('');					 
					 $('#videoLink').val('');
					 $('.say_form .upload_status').removeClass('good').html('');
			 		 $(this).dialog('close');
			 	}
				 },
				 
			'OK' : {
				 "text":'OK', "class": 'button wblue', "click": function() {

						if($(this).attr('id') == 'videoDialog') 
						{
							if(!oWall.validateVideoURL($("#videoLink").val()))
							{
								$('#err_video').html('Please Copy Valid Video URL(Youtube or Vimeo)');
								er = 1;
							} 
							else 
							{							
								$(this).dialog('close');
								$('#err_video').html('');
								$('#err_mesg').removeClass('error').html('');
								if($('#wallImage').val())
									$('.say_form .upload_status').addClass('good').html('File Uploaded successfully');								
								if($('#videoLink').val())
									$('.say_form .upload_status').addClass('good').html('Video Uploaded successfully');								
							}
						} 
						else 
						{				
							$(this).dialog('close');
							$('#err_mesg').removeClass('error').html('');
							
							if($('#wallImage').val())
									$('.say_form .upload_status').addClass('good').html('File Uploaded successfully');								
							if($('#videoLink').val())
									$('.say_form .upload_status').addClass('good').html('Video Uploaded successfully');	
						}										 
					 }
				 },
		}
	});
	 */
});
var oWall = new Wall();
var tm = 0;
var doReload = 0;
var doReloadM = 0;
var doReloadF = 0;



var wallFancySetting = {
	/*
	width : 1000,
	height: 1000,
	/*type : 'iframe',*/
	autoSize: true,
	onStart: function(){
		//alert($(this).attr('data-href'));
	},
	onComplete: function() {
		box = $('.AlbumPOP').find('.scrollArea');
		/*
		divHeight = $('#popBox .Lpic').height();
		$('#popBox .comContain').height(divHeight);
		*/
		divHeight = box.height();
		scrollHeight = $('#popBox .Lpic').height() - 100;
		if(divHeight >= scrollHeight){
			$(box).slimScroll({ height: scrollHeight });
		}
	}
};