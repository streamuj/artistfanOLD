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
	BuyPhotosProcess:  function(albumName,userId,url,photoId,photoPrice,artist_url,title,image)
    {
		//$( "#buy_music_dialog" ).dialog();
		
		 if(artist_url != '')
        {
            $( "#buy_music_dialog" ).find('.track_author a').attr('href', artist_url);         
          
        }
		var music_url = $( "#buy_music_dialog" ).find('.track_author a').attr('href') + '/photo';
        $( "#buy_music_dialog" ).find('.track_name').html( '<a href=url">' + albumName + '</a>');
        $( "#buy_music_dialog" ).find('.album_img a').attr('href', music_url + '/' + photoId);
        $( "#buy_music_dialog" ).find('.album_img img').attr('src','/files/photo/thumbs/'+userId+'/'+image);
		
        $( "#buy_music_dialog" ).find('.track_genres').html(title);		
		 if(photoPrice > 0)
        {
<!--			$( "#buy_music_dialog" ).find('.price strong').html('<input type="text" style="width:85px;height:25px;" class="payMore"  name="payMore" id="payMore" >');-->
			$( "#buy_music_dialog" ).find('.price strong').html(photoPrice);
            $( "#buy_music_dialog" ).find('.price').show();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val(' Buy ');
        }
        else
        {
            $( "#buy_music_dialog" ).find('.price').hide();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Add');
        }
		$( "#buy_music_dialog" ).dialog({width: 570, modal: false});
			//http://localartistfan.com/u/lenin/photo/3?ph=4
		$( "#buy_music_dialog" ).find('.music_buy_btn').unbind('click');	
        $( "#buy_music_dialog" ).find('.music_buy_btn').click(function() {
           
            errs = new Array();
            
			alert('Ajax Functions Start Here to Buy');
				
				
			
			
			<!--Start -->
			

			
			
			
			<!--End -->
			
			
			
        });
		
			
			 
			

			
	}
}

var doLoad = 0;
var oBuyPhoto = new buyphoto();
