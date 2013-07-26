/**
 * Photo JS class
 * User: usawebsolution php team
 * Date: 19.01.2011
 * Time: 19:24:26
 *
 */

var show_login = 0;

function buyphoto()
{

}


buyphoto.prototype =
{
       __construct:function ()
    {
        $(document).ready(function ()
        {

        });
    },
	 BuyPhotos:function (obj)
    {
        oBuyPhoto.BuyPhotosProcess($(obj).attr('photoAlbumName'),$(obj).attr('pUserId'),$(obj).attr('url'),$(obj).attr('photoId'),$(obj).attr('photoPrice'),$(obj).attr('artistName'),$(obj).attr('title'),$(obj).attr('image'));
		
    
	},
	 BuyRedirectPhotos:function (obj)
    {
        oBuyPhoto.BuyRedirectPhotosProcess($(obj).attr('photoId'));
		
    
	},
	
	 addPhotos:function (obj)
    {
        oBuyPhoto.addPhotosProcess($(obj).attr('photoAlbumName'),$(obj).attr('pUserId'),$(obj).attr('url'),$(obj).attr('photoId'),$(obj).attr('photoPrice'),$(obj).attr('artistName'),$(obj).attr('title'),$(obj).attr('image'));
		
    
	},
	BuyRedirectPhotosProcess: function(id)
	{
		  document.location = '/payment/photopayment/'+id;
	},
	addPhotosProcess:  function(albumName,userId,url,photoId,photoPrice,artist_url,title,image)
    {
		
		//$( "#buy_music_dialog" ).dialog();
		
		
		 if(artist_url != '')
        {
            $( "#buy_music_dialog" ).find('.track_author a').attr('href', artist_url);         
          
        }
		var music_url = $( "#buy_music_dialog" ).find('.track_author a').attr('href') + '/photo';
        $( "#buy_music_dialog" ).find('.track_name').html( '<a href=url">' + albumName + '</a>');
        $( "#buy_music_dialog" ).find('.album_img a').attr('href', music_url + '/' + photoId);
        $( "#buy_music_dialog" ).find('.album_img img').attr('src',subDomain+'photo/thumbs/'+userId+'/'+image);
		
        $( "#buy_music_dialog" ).find('.track_genres').html(title);	

		 if(photoPrice > 0)
        {
<!--			$( "#buy_music_dialog" ).find('.price strong').html('<input type="text" style="width:85px;height:25px;" class="payMore"  name="payMore" id="payMore" >');-->
			$( "#buy_music_dialog" ).find('.price strong').html(photoPrice);
            $( "#buy_music_dialog" ).find('.price').show();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Buy');
        }
        else
        {
            $( "#buy_music_dialog" ).find('.price').hide();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Add');
        }

		$( "#buy_music_dialog" ).dialog({width: 570, modal: true});
		
			//http://localartistfan.com/u/lenin/photo/3?ph=4
		$( "#buy_music_dialog" ).find('.music_buy_btn').unbind('click');	
        $( "#buy_music_dialog" ).find('.music_buy_btn').click(function() {
																	   
           
            errs = new Array();
            
			
			<!--Start -->
			 $( "#buy_music_dialog" ).find('.music_buy_btn').addClass('noactive');
            $( "#buy_music_dialog" ).find('.wait').show();
            $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
            $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': photoId},
                url:'/base/profile/buyphoto',
                success:function (data)
                {
					
                    doLoadP = 0;
                    $( "#buy_music_dialog" ).find('.music_buy_btn').removeClass('noactive');
                    $( "#buy_music_dialog" ).find('.wait').hide();
                    if (data.q == 'ok')
                    {
                       if(data.errs.length > 0)
                        {
                            errs = data.errs;
						  $( "#buy_music_dialog" ).find('#music_err').html('Photo is Already purchased').parent().show();
						  
                        }
                        else
                        {
                            $( "#buy_music_dialog" ).find('#music_success').html('Album is Added').parent().show();
                            // many photo mean load here
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });	
           // document.location = '/payment/photopayment/'+photoId;
        });
        $( "#buy_music_dialog" ).find('.reset_button').click(function() {
            $( "#buy_music_dialog" ).dialog('close');
        });		
	},
	
	
	BuyPhotosProcess:  function(albumName,userId,url,photoId,photoPrice,artist_url,title,image)
    {
		

	  if(artist_url != '')
        {
            $( "#buy_music_dialog" ).find('.track_author a').attr('href', artist_url);         
          
        }
		var music_url = $( "#buy_music_dialog" ).find('.track_author a').attr('href') + '/photo';
        $( "#buy_music_dialog" ).find('.track_name').html( '<a href=url">' + albumName + '</a>');
        $( "#buy_music_dialog" ).find('.album_img a').attr('href', music_url + '/' + photoId);
        $( "#buy_music_dialog" ).find('.album_img img').attr('src',subDomain+'photo/thumbs/'+userId+'/'+image);
		
        $( "#buy_music_dialog" ).find('.track_genres').html(title);	

		 if(photoPrice > 0)
        {

			$( "#buy_music_dialog" ).find('.price strong').html(photoPrice);
            $( "#buy_music_dialog" ).find('.price').show();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Buy');
        }
        else
        {
            $( "#buy_music_dialog" ).find('.price').hide();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Add');
        }
		$( "#buy_music_dialog" ).dialog({width: 570, modal: true});		
		$( "#buy_music_dialog" ).find('.music_buy_btn').unbind('click');	
        $( "#buy_music_dialog" ).find('.music_buy_btn').click(function() {
			errs = new Array();
			 $( "#buy_music_dialog" ).find('.music_buy_btn').addClass('noactive');
            $( "#buy_music_dialog" ).find('.wait').show();
            $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
            $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
            document.location = '/payment/photopayment/'+photoId;
        });
        $( "#buy_music_dialog" ).find('.reset_button').click(function() {
            $( "#buy_music_dialog" ).dialog('close');
        });		
	}
}

var doLoad = 0;
var oBuyPhoto = new buyphoto();
