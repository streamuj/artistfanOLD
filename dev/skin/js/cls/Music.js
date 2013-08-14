function Music()
{

}

Music.prototype =
{
    AlbumExistsInCart: function(a_id) {

		  $.ajax({
                type:'POST',
                dataType:'json',
                data:{'a_id':a_id },
                url:'/base/profile/AlbumExistsInCart',
                success:function (data)
                {
					checkResponseRedirect(data);
					if(data.data!='')
						{
							$('.action').css("display","none");	
						}
						else
						{
							$('.action').css("display","");	
						}
					
				}
			});

	
	},
	
	ShowTrackArtisttoArtist: function(a_id){	
	  $.ajax({
                type:'POST',
                dataType:'json',
                data:{'a_id':a_id },
                url:'/base/profile/AlbumExistsInCart',
                success:function (data)
                {
						checkResponseRedirect(data);
					if(data.data!='')
						{
						  $.ajax({
								type:'POST',
								dataType:'json',
								data:{'a_id': a_id,'ExistingAlbum' : true},
								url:'/base/profile/ArtisttwoArtistAlbumTrackList',
								success:function (data)
								{
									checkResponseRedirect(data);
									if (data.q == 'ok')
									{						
										$('#tracks_by_album_'+a_id).html(data.data);
									}
								}
							});				
															
							
						}
						else
						{
				
				
/*		  $.ajax({
                type:'POST',
                dataType:'json',
                data:{'u_id':u_id, 'a_id': a_id},
                url:'/base/profile/ArtistMusicByAlbum',
                success:function (data)
                {

                    if (data.q == 'ok')
                    {						
						$('#tracks_by_album_'+a_id).html(data.data);
					}
				}
			});				*/
				
						}
					
				}
			});
		

				 
				
		},
		
    ShowTrack: function( u_id, a_id ) {
		if($('#tracks_by_album_'+a_id ).is(':visible')){
			$('#tracks_by_album_'+a_id).fadeOut();
			return;
		}
		
		if($('#tracks_by_album_'+a_id + ' tr').length > 0) {
			$('.tracks').hide();		
			$('#tracks_by_album_'+a_id).fadeIn();
			return;
		}
	  $.ajax({
                type:'POST',
                dataType:'json',
                data:{'a_id':a_id },
                url:'/base/profile/AlbumExistsInCart',
                success:function (data)
                {
						checkResponseRedirect(data);
					if(data.data!='')
						{
						  $.ajax({
								type:'POST',
								dataType:'json',
								data:{'u_id':u_id, 'a_id': a_id,'ExistingAlbum' : true},
								url:'/base/profile/ArtistMusicByAlbum',
								success:function (data)
								{	checkResponseRedirect(data);
									 if (data.q == 'ok')
									{
										$('.tracks').hide();
										$('#tracks_by_album_'+a_id).html(data.data);
										$('#tracks_by_album_'+a_id).fadeIn();
									}
								}
							});				
															
							
						}
						else
						{
							  $.ajax({
									type:'POST',
									dataType:'json',
									data:{'u_id':u_id, 'a_id': a_id},
									url:'/base/profile/ArtistMusicByAlbum',
									success:function (data)
									{
										checkResponseRedirect(data);					
										if (data.q == 'ok')
										{
											$('.tracks').hide();
											$('#tracks_by_album_'+a_id).html(data.data);
											$('#tracks_by_album_'+a_id).fadeIn();
										}
									}
								});				
								
						}
				}
			});
		

				 
		},
		
    ShowArtistTrack: function( a_id ) {
		 
		if($('#tracks_by_album_'+a_id ).is(':visible')){
		$('#tracks_by_album_'+a_id).fadeOut();
		
			 // Start 
			 //	$('#tracks_by_album_'+a_id).animate({ "opacity": "show" }, "slow", "easein");
			 // End 
			 
			return;
		}
		if($('#tracks_by_album_'+a_id + ' tr').length > 0) 
		{
			$('.tracks').fadeOut();		
			$('#tracks_by_album_'+a_id).fadeIn();
			
			 // Start 
			 // $('#tracks_by_album_'+a_id).animate({ "opacity": "show" }, "slow", "easein");
			 // End 
			 
			return;
		}
		  $.ajax({
                type:'POST',
                dataType:'json',
                data:{'a_id': a_id },
                url:'/base/artist/ArtistMusicByAlbum',
                success:function (data)
                {	
				checkResponseRedirect(data);
                    if (data.q == 'ok')
                    {
						$('.tracks').hide();
						$('#tracks_by_album_'+a_id).html(data.data);
					    $('#tracks_by_album_'+a_id).fadeIn();
						 
							// Start 
							// $('#tracks_by_album_'+a_id).animate({ "opacity": "show" }, "slow", "easein");
							// End 
						 
					}
				}
			});
				 
		},	
		
		ShowMyPurchasedTrack: function( a_id ) {
			if($('#tracks_by_album_'+a_id ).is(':visible')){
			$('#tracks_by_album_'+a_id).fadeOut();
			return;
		}
		if($('#tracks_by_album_'+a_id + ' tr').length > 0) {
			$('.tracks').fadeOut();		
			$('#tracks_by_album_'+a_id).fadeIn();
			return;
		}
		  $.ajax({
                type:'POST',
                dataType:'json',
                data:{'a_id': a_id},
                url:'/base/artist/ArtistPurchasedMusicList',
                success:function (data)
                {		
				checkResponseRedirect(data);
                    if (data.q == 'ok')
                    {
						$('.tracks').hide();
						$('#tracks_by_album_'+a_id).html(data.data);
						$('#tracks_by_album_'+a_id).fadeIn();
					}
				}
			});
				 
		},	
		
		ShowFanPurchasedTrack: function( a_id ) {
		if($('#tracks_by_album_'+a_id ).is(':visible')){
			$('#tracks_by_album_'+a_id).fadeOut();
			return;
		}
		if($('#tracks_by_album_'+a_id + ' tr').length > 0) {
			$('.tracks').hide();		
			$('#tracks_by_album_'+a_id).fadeIn();
			return;
		}
		  $.ajax({
                type:'POST',
                dataType:'json',
                data:{'a_id': a_id},
                url:'/base/fan/FanPurchasedMusicList',
                success:function (data)
                {	
					checkResponseRedirect(data);
                    if (data.q == 'ok')
                    {
						$('.tracks').hide();
						$('#tracks_by_album_'+a_id).html(data.data);
						$('#tracks_by_album_'+a_id).fadeIn();
					}
				}
			});
				 
		},	
		
		MusicAlbumEditStep3: function( a_id )
		{
			 $.ajax({
                type:'POST',
                dataType:'json',
                data:{'AlbumId': a_id},
                url:'/base/artist/AlbumEditData',
                success:function (data)
                {	
					checkResponseRedirect(data);
                    if (data.q == 'ok')
                    {
						$('#EditMusic_Album').html(data.data);
					}
				}
			});
		},
		
	
		
    InitMusicButtons: function()
    {
		$('#view_album').hide();
		$('#view_album1').hide();
		$('#view_tracks').show();					
		$('#btn_view_album').click(function(){
			$('#view_album').show();
			$('#btn_view_album').addClass('active');
			$('#view_tracks').hide();	
			$('#btn_view_track').removeClass('active');
			});	
		$('#btn_view_track').click(function(){
			$('#view_album').hide();
			$('#btn_view_album').removeClass('active');
			$('#view_tracks').show();	
			$('#btn_view_track').addClass('active');
			});
    }
}
//Music class
var oMusic = new Music;
//Musicer window
var mMusic;
