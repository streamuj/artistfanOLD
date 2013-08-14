function Profile()
{

}


Profile.prototype =
{
    __construct:function ()
    {
        $(document).ready(function ()
        {

        });
    },


    EditEvent: function() 
    {
        var er = 0;
        errs = {};
        
        $('#err_Location, #err_EventDate, #err_EventTime, #err_Title').html('');

        if (jQuery.trim($("#Location").val()) == "")
        {
            errs['Location'] = 'Please specify event location';
            er = 1;
        }


        if (jQuery.trim($("#EventDate").val()) == "")
        {
            errs['EventDate'] = 'Please specify event date';
            er = 1;
        }	

        if (jQuery.trim($("#EventTime").val()) == "")
        {
            errs['EventTime'] = 'Please specify event time';
            er = 1;
        }	

        if (jQuery.trim($("#Title").val()) == "")
        {
            errs['Title'] = 'Please specify event title';
            er = 1;
        }

        if (er)
        {
        	oErrors.Show();
        } 
        else
        {
        	$('#event_form').submit();
        }
       
    },


    EditTrack: function() {

        $('#err_Title, #err_DateRelease').html('');
        errs = {};  
        var er = 0;
        
        if (jQuery.trim($("#Title").val()) == "")
        {
            errs['Title'] = 'Please specify track title';
            er = 1;
        }

        if (jQuery.trim($("#DateRelease").val()) == "")
        {
            errs['DateRelease'] = 'Please specify release date';
            er = 1;
        }   
        
        if (er)
        {
            oErrors.Show();
        } 
        else
        {
            $('#track_form').submit();
        }
             
    },


    EditAlbum: function() {

        $('#err_Title, #err_DateRelease').html('');
        errs = {};
        var er = 0;

        if (jQuery.trim($("#Title").val()) == "")
        {
            errs['Title'] = 'Please specify album title';
            er = 1;
        } 

        if (jQuery.trim($("#DateRelease").val()) == "")
        {
            errs['DateRelease'] = 'Please specify release date';
            er = 1;
        }   

        if (er)
        {
            oErrors.Show();
        } 
        else
        {

            $('#album_form').submit();
        } 
        
    },
    
    
    EditVideo: function() {

        $('#err_Title').html('');
        errs = {};  
        var er = 0;
        
        if (jQuery.trim($("#Title").val()) == "")
        {
            errs['Title'] = 'Please specify video title';
            er = 1;
        }

        
        if (er)
        {
            oErrors.Show();
        } 
        else
        {
            $('#video_form').submit();
        }
             
    },

    EditVideoYt: function() {

        $('.err').html('');
        errs = {};
        var er = 0;

        if (jQuery.trim($("#Title").val()) == "")
        {
            errs['Title'] = 'Please specify video title';
            er = 1;
        }
        if (jQuery.trim($("#VideoCode").val()) == "" && jQuery.trim($("#VideoLink").val()) == "")
        {
            errs['VideoCode'] = 'Please specify video code or video link';
            errs['VideoLink'] = 'Please specify video code or video link';
            er = 1;
        }

        if (er)
        {
            oErrors.Show();
        }
        else
        {
            $('#video_form').submit();
        }

    },

    /**
     * Add / Edit photo album
     */
    EditPhotoAlbum: function() {

        $('#err_Title').html('');
        errs = {};
        var er = 0;

        if (jQuery.trim($("#Title").val()) == "")
        {
            errs['Title'] = 'Please specify album title';
            er = 1;
        }

        if (er)
        {
            oErrors.Show();
        }
        else
        {
            $('#album_form').submit();
        }
    },

    /*
     * Add/edit photo
     */
    EditPhoto: function() {

        $('#err_Title, #err_PhotoDate').html('');
        errs = {};
        var er = 0;

        if (1*jQuery.trim($("#AlbumId").val()) == 0)
        {
            if(jQuery.trim($("#AlbumTitle").val()) == "")
            {
                errs['AlbumTitle'] = 'Please specify name for new album';
                er = 1;
            }
        }

        if (er)
        {
            oErrors.Show();
        }
        else
        {
            $('#photo_form').submit();
        }
    },

    /**
     * Get popup for buy music (in player window)
     */
    InitBuyMusic: function(obj)
    {
        var imgsrc = ($(this).parent().parent().find('img').length > 0) ? $(obj).parent().parent().find('img').attr('src') : $(obj).parent().parent().parent().find('img').attr('src');
        imgsrc = imgsrc.replace('/x_', '/m_');
        var ttl = $(obj).parent().parent().find('.ttl').html();
        var artist_url = $(obj).parent().parent().find('.artist').attr('src');
        var artist_band = $(obj).parent().parent().find('.artist').html();
        var artist_genres = $(obj).parent().parent().find('.artist').attr('genres');
        oProfile.BuyMusic( $(obj).attr('mid'), ttl, $(obj).attr('price'), imgsrc, artist_url, artist_band, artist_genres, 1 );
    },
	
	/**
	* Get Popup for paymore in the player window By Lenin Kumar K	
	*/
	 /**
     * Get popup Pay More Album buy music (in player window)
     */
	 payMoreAlbumBuyMusicDialogClear: function()
    {
        $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
        $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
        $( "#buy_music_dialog" ).find('.track_album .track_count').html('');
        $( "#buy_music_dialog" ).find('.track_album').hide();     
        $( "#buy_music_dialog" ).find('.music_buy_btn').removeClass('noactive');
		$( "#buy_music_dialog" ).find('#track_savings .red').show();
        $( "#buy_music_dialog" ).find('#track_savings').show();
        $( "#buy_music_dialog" ).find('.wait').hide();
        $( "#buy_music_dialog" ).find('#dialog_mid').val('');
    },
	 
	    
	   PayMoreUrlMusicAlbum: function()
    	{
			
		
        oProfile.payMoreAlbumBuyMusicDialogClear();
        $( "#buy_music_dialog" ).find('#dialog_mid').val(id);
        var in_player = typeof in_player != "undefined" ? in_player : 0;
        if(artist_url != '')
        {
            $( "#buy_music_dialog" ).find('.track_author a').attr('href', artist_url);
            $( "#buy_music_dialog" ).find('.track_author a').html(artist_band);
            $( "#buy_music_dialog" ).find('.track_album .track_genres').html(atrist_genres);
        }
        var music_url = $( "#buy_music_dialog" ).find('.track_author a').attr('href') + '/music';

        $( "#buy_music_dialog" ).find('.track_name').html( '<a href="' + music_url + '/' + id + '">' + title + '</a>');
        $( "#buy_music_dialog" ).find('.album_img a').attr('href', music_url + '/' + id);
        $( "#buy_music_dialog" ).find('.album_img img').attr('src', image);
		
        if(price > 0)
        {
			/* 
				Problem Fixing light box  + pay more + album in this 
				url  :	http://localartistfan.com/u/lenin/music
					
			 */
			//$(".column").disableSelection();
			
            $( "#buy_music_dialog" ).find('.price strong').html('<input type="text" style="width:85px;height:25px;" class="payMore"  name="payMore" id="payMore" >');
            $( "#buy_music_dialog" ).find('.price').show();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Pay More');
        }
        else
        {
            $( "#buy_music_dialog" ).find('.price').hide();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Add');
        }
        if(tracks > 0)
        {
            $( "#buy_music_dialog" ).find('.track_album .track_count').html( tracks + ' Songs');
        }
        //$( "#buy_music_dialog" ).find('.track_album').show();
		// im here 
		
        if(1*savings > 0)
        {
            $( "#buy_music_dialog" ).find('#track_savings .red').html( savings);
            $( "#buy_music_dialog" ).find('#track_savings').show();
        }

    	$( "#buy_music_dialog" ).dialog({width: 570, modal: false});

        $( "#buy_music_dialog" ).find('.music_buy_btn').unbind('click');
        $( "#buy_music_dialog" ).find('.music_buy_btn').click(function() {
            errs = new Array();
            if (doLoadP)
            {
                return false;
            }
				var payMore =  $('#payMore').val();
				
				
			
			
			<!--Start -->
			
				if(payMore=='')
						{
							   $( "#buy_music_dialog" ).find('#music_err').html('Please Enter The Some Fund... :)').parent().show();
						}
				else
						{
							
							var intRegex = /^\d+$/;
							var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
							var str = payMore;
							if(intRegex.test(str) || floatRegex.test(str)) 
								{
								// Here im Process to update the database and start payement process
								/**
								*Ajax Function  Start Here
								**/
					if(payMore>=price)
						{
							
            doLoadP = 1;
            $( "#buy_music_dialog" ).find('.music_buy_btn').addClass('noactive');
            $( "#buy_music_dialog" ).find('.wait').show();
            $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
            $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': $( "#buy_music_dialog" ).find('#dialog_mid').val(),payMore:payMore},
                url:'/base/profile/PayMoreAlbumPurchaseMusic',
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
                            oErrors.ShowInOne('music_err');
                        }
                        else
                        {
                            $( "#buy_music_dialog" ).find('#music_success').html('Album is purchased').parent().show();
                            if(in_player == 1)
                            {
                                //reload tracks in player
                                for(var i in data.tracks)
                                {
                                    if($('.track_list #list').length > 0 && $('.track_list #list').find('tr[tid=' + i + ']').length > 0)
                                    {
                                        data.tracks[i] = '/' + data.tracks[i];
                                        $('.track_list #list').find('tr[tid=' + i + ']').attr('track', data.tracks[i]);
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.buy_music').replaceWith('<a href="' + data.tracks[i] + '" class="button">Download</a>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.add_music').replaceWith('<a href="' + data.tracks[i] + '" class="button">Download</a>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.pricetag').replaceWith('<span class="pricetag own">&#10004;</span>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.albumttl').attr('buyed', '1');
                                        if(typeof curTrack != "undefined" && curTrack == i)
                                        {
                                            $('#track_buttons').hide();
                                            play(data.tracks[i], curTrack);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });
						}
						else
						{

							$( "#buy_music_dialog" ).find('#music_err').html('Oops Not Less Than Priced Rates :'+price).parent().show();																	 
						}
			
								/**
								*Ajax Function End Here
								**/
								
							  
								
								}
							else
							{
							 $( "#buy_music_dialog" ).find('#music_err').html('Only Numbers Allowed... :( ').parent().show();
							}
							
						
						}
			
			
			
			<!--End -->
			
			
			
        });
        $( "#buy_music_dialog" ).find('.reset_button').click(function() {
            $( "#buy_music_dialog" ).dialog('close');
        });

    },
	 // to buy album and save
    InitPayMoreBuyAlbum: function(obj)
    {
        var imgsrc = ($(this).parent().parent().find('img').length > 0) ? $(obj).parent().parent().find('img').attr('src') : $(obj).parent().parent().parent().find('img').attr('src');
        imgsrc = imgsrc.replace('/x_', '/m_');
        var ttl = $(obj).parent().parent().find('.ttl').html();
        var artist_url = $(obj).parent().parent().find('.artist').attr('src');
        var artist_band = $(obj).parent().parent().find('.artist').html();
        var artist_genres = $(obj).parent().parent().find('.artist').attr('genres');
        //oProfile.BuyAlbum( $(obj).attr('mid'), ttl, $(obj).attr('price'), imgsrc, artist_url, artist_band, artist_genres, 1 );
      //  oProfile.PayMoreAlbumBuyMusic( $(obj).attr('mid'), ttl, $(obj).attr('price'), imgsrc, artist_url, artist_band, artist_genres, 1 );
	    oProfile.PayMoreAlbumBuyMusic( $(obj).attr('mid'), ttl, $(obj).attr('price'), $(obj).attr('tracks'), $(obj).attr('savings'), imgsrc, artist_url, artist_band, artist_genres, 1 );
		
		
    },
	// to buy the track
	 InitPayMoreMusic: function(obj)
    {
        var imgsrc = ($(this).parent().parent().find('img').length > 0) ? $(obj).parent().parent().find('img').attr('src') : $(obj).parent().parent().parent().find('img').attr('src');
        imgsrc = imgsrc.replace('/x_', '/m_');
        var ttl = $(obj).parent().parent().find('.ttl').html();
        var artist_url = $(obj).parent().parent().find('.artist').attr('src');
        var artist_band = $(obj).parent().parent().find('.artist').html();
        var artist_genres = $(obj).parent().parent().find('.artist').attr('genres');		
        oProfile.PayMoreMusic( $(obj).attr('mid'), ttl, $(obj).attr('price'), imgsrc, artist_url, artist_band, artist_genres, 1 );
    },
    /**
     * Get popup for buy album (in player window)
     */
    InitBuyAlbum: function(obj)
    {
        var imgsrc = $(obj).parent().parent().parent().find('img').attr('src');		
        imgsrc = imgsrc.replace('/x_', '/m_');
        var ttl = $(obj).parent().parent().find('.track_album a').html();
        var artist_url = $(obj).parent().parent().find('.artist').attr('src');
        var artist_band = $(obj).parent().parent().find('.artist').html();
        var artist_genres = $(obj).parent().parent().find('.artist').attr('genres');
        oProfile.BuyAlbum( $(obj).attr('mid'), ttl, $(obj).attr('price'), $(obj).attr('tracks'), $(obj).attr('savings'), imgsrc, artist_url, artist_band, artist_genres, 1 );
		
		// something problem to show saving price 
    },
	
	    InitPayMoreUrlMusicBuyAlbum: function(obj)
    {
		
				
        var imgsrc = $(obj).parent().parent().parent().find('img').attr('src');
        imgsrc = imgsrc.replace('/x_', '/m_');
        var ttl = $(obj).parent().parent().find('.track_album a').html();
        var artist_url = $(obj).parent().parent().find('.artist').attr('src');
        var artist_band = $(obj).parent().parent().find('.artist').html();
        var artist_genres = $(obj).parent().parent().find('.artist').attr('genres');
		
        oProfile.BuyAlbum( $(obj).attr('mid'), ttl, $(obj).attr('price'), $(obj).attr('tracks'), $(obj).attr('savings'), imgsrc, artist_url, artist_band, artist_genres, 1 );
		// something problem to show saving price 
    
		
		
    /*    var imgsrc = $(obj).parent().parent().parent().find('img').attr('src');
        imgsrc = imgsrc.replace('/x_', '/m_');
        var ttl = $(obj).parent().parent().find('.track_album a').html();
        var artist_url = $(obj).parent().parent().find('.artist').attr('src');
        var artist_band = $(obj).parent().parent().find('.artist').html();
        var artist_genres = $(obj).parent().parent().find('.artist').attr('genres');
		alert($(obj).attr('genres'));
        oProfile.PayMoreUrlMusicBuyAlbum( $(obj).attr('mid'), ttl, $(obj).attr('price'), $(obj).attr('tracks'), $(obj).attr('savings'), imgsrc, artist_url, artist_band, artist_genres, 1 );
*/
    },

    /**
     * Init purchase buttons
     */
    InitPurchase: function()
    {
        $('.buy_album').click(function() {

            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
            oProfile.BuyAlbum( $(this).attr('mid'), $(this).parent().find('.ttl').html(), $(this).attr('price'), $(this).attr('tracks'), $(this).attr('savings'), imgsrc, '', '', '' );
        });
		
		// Pay More For Album By Lenin Kumar K
		$('.pay_more_buy_album').click(function() {
												
       //     var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
            //oProfile.PayMoreAlbumBuyMusic( $(this).attr('mid'), $(this).parent().find('.ttl').html(), $(this).attr('price'), $(this).attr('tracks'), $(this).attr('savings'), imgsrc, '', '', '' );
            //oProfile.BuyAlbum( $(this).attr('mid'), $(this).parent().find('.ttl').html(), $(this).attr('price'), $(this).attr('tracks'), $(this).attr('savings'), imgsrc, '', '', '' );
  var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
             oProfile.PayMoreUrlMusicBuyAlbum( $(this).attr('mid'), $(this).parent().find('.ttl').html(), $(this).attr('price'), $(this).attr('tracks'), $(this).attr('savings'), imgsrc, '', '', '' );
			
 		   // oProfile.PayMoreAlbumBuyMusic();

				   
        });
        
        $('.buy_music').click(function() {
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
            imgsrc = imgsrc.replace('/x_', '/m_');
            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oProfile.BuyMusic( $(this).attr('mid'), ttl, $(this).attr('price'), imgsrc, '', '', '' );
        });
		
		 $('.pay_more_urlmusic_buy_album').click(function() {

            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
             oProfile.PayMoreUrlMusicBuyAlbum( $(this).attr('mid'), $(this).parent().find('.ttl').html(), $(this).attr('price'), $(this).attr('tracks'), $(this).attr('savings'), imgsrc, '', '', '' );
        });

        $('.pay_more_buy_music').click(function() {
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
            imgsrc = imgsrc.replace('/x_', '/m_');
            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oProfile.BuyMusic( $(this).attr('mid'), ttl, $(this).attr('price'), imgsrc, '', '', '' );
            //oProfile.PayMoreforpageMusic( $(this).attr('mid'), ttl, $(this).attr('price'), imgsrc, '', '', '' );			
			
        });


        $('.buy_video').click(function() {
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
            if(typeof imgsrc != "undefined" && imgsrc != null)
            {
                imgsrc = imgsrc.replace('/x_', '/m_');
            }
            else
            {
                imgsrc = '';
            }
            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oProfile.BuyVideo( $(this).attr('mid'), ttl, $(this).attr('price'), imgsrc );
        });
		


        $('.paymore_buy_video').click(function() {
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
            if(typeof imgsrc != "undefined" && imgsrc != null)
            {
                imgsrc = imgsrc.replace('/x_', '/m_');
            }
            else
            {
                imgsrc = '';
            }
            
            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oProfile.PayMoreBuyVideo( $(this).attr('mid'), ttl, $(this).attr('price'), imgsrc );
		
        });


    
        $('.add_video').click(function() {
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
            if(typeof imgsrc != "undefined" && imgsrc != null)
            {
                imgsrc = imgsrc.replace('/x_', '/m_');
            }
            else
            {
                imgsrc = '';
            }

            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oProfile.BuyVideo( $(this).attr('mid'), ttl, 0, imgsrc );
        });
        $('.add_music').click(function() {
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
            imgsrc = imgsrc.replace('/x_', '/m_');
            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oProfile.BuyMusic( $(this).attr('mid'), ttl, 0, imgsrc, '', '', '' );
        });
        $('.add_album').click(function() {
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
            oProfile.BuyAlbum( $(this).attr('mid'), $(this).parent().find('.ttl').html(), 0, $(this).attr('tracks'), 0, imgsrc, '', '', '' );
        });
    },

    /**
     * Init purchase buttons for guests
     */
    InitPurchaseForGuests: function()
    {
        $('.buy_album').click(function() {
            oProfile.PurchaseRedirect('album', $(this).attr('mid'));
        });

        $('.buy_music').click(function() {
            oProfile.PurchaseRedirect('track', $(this).attr('mid'));
        });

        $('.buy_video').click(function() {
            oProfile.PurchaseRedirect('video', $(this).attr('mid'));
        });

        $('.add_video').click(function() {
            oProfile.PurchaseRedirect('video', $(this).attr('mid'));
        });
        $('.add_music').click(function() {
            oProfile.PurchaseRedirect('track', $(this).attr('mid'));
        });
        $('.add_album').click(function() {
            oProfile.PurchaseRedirect('album', $(this).attr('mid'));
        });
    },

    PurchaseRedirect: function(what, id, in_player)
    {
        var in_player = typeof in_player != "undefined" ? in_player : 0;
        if (doLoadP)
        {
            return false;
        }
        doLoadP = 1;
        $.ajax({
            type:'POST',
            dataType:'json',
            data:{'id': id, 'what': what},
            url:'/base/profile/ActionNotAuth',
            success:function (data)
            {
                doLoadP = 0;
                if (data.q == 'ok')
                {
                    if(in_player == 1)
                    {
                        window.opener.location = '/base/user/login';
                        window.close();
                    }
                    else
                    {
                        document.location = '/base/user/login';
                    }
                }
            }
        });
    },

    BuyMusicDialogClear: function()
    {
        $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
        $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
        $( "#buy_music_dialog" ).find('.track_album .track_count').html('');
        //$( "#buy_music_dialog" ).find('.track_album').hide();
        $( "#buy_music_dialog" ).find('#track_savings .red').html('');
        $( "#buy_music_dialog" ).find('#track_savings').hide();
        $( "#buy_music_dialog" ).find('.music_buy_btn').removeClass('noactive');
        $( "#buy_music_dialog" ).find('.wait').hide();
        $( "#buy_music_dialog" ).find('#dialog_mid').val('');
		

		
		
		
    },

BuyAlbumMusicDialogClear: function()
    {
        $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
        $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
        $( "#buy_music_dialog" ).find('.track_album .track_count').html('');
        //$( "#buy_music_dialog" ).find('.track_album').hide();
        $( "#buy_music_dialog" ).find('#track_savings .red').html('');
        $( "#buy_music_dialog" ).find('#track_savings').hide();
        $( "#buy_music_dialog" ).find('.music_buy_btn').removeClass('noactive');
        $( "#buy_music_dialog" ).find('.wait').hide();
        $( "#buy_music_dialog" ).find('#dialog_mid').val('');
		

		
		
		
    },

	    PayMoreUrlMusicBuyAlbum: function(id, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player)

    {
        oProfile.BuyMusicDialogClear();
		
	   //oProfile.BuyAlbumMusicDialogClear();
	   //alert('Im Here Saving Buy Album');
        $( "#buy_music_dialog" ).find('#dialog_mid').val(id);
        var in_player = typeof in_player != "undefined" ? in_player : 0;
        if(artist_url != '')
        {
            $( "#buy_music_dialog" ).find('.track_author a').attr('href', artist_url);
            $( "#buy_music_dialog" ).find('.track_author a').html(artist_band);
            $( "#buy_music_dialog" ).find('.track_album .track_genres').html(atrist_genres);
        }
        var music_url = $( "#buy_music_dialog" ).find('.track_author a').attr('href') + '/music';

        $( "#buy_music_dialog" ).find('.track_name').html( '<a href="' + music_url + '/' + id + '">' + title + '</a>');
        $( "#buy_music_dialog" ).find('.album_img a').attr('href', music_url + '/' + id);
        $( "#buy_music_dialog" ).find('.album_img img').attr('src', image);
        if(price > 0)
        {
            $( "#buy_music_dialog" ).find('.price strong').html('<input type="text" style="width:85px;height:25px;" class="payMore"  name="payMore" id="payMore" >');
            $( "#buy_music_dialog" ).find('.price').show();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Pay More');
        }
        else
        {
            $( "#buy_music_dialog" ).find('.price').hide();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Add');
        }
        if(tracks > 0)
        {
            $( "#buy_music_dialog" ).find('.track_album .track_count').html( tracks + ' Songs');
        }
        //$( "#buy_music_dialog" ).find('.track_album').show();
        if(1*savings > 0)
        {
            $( "#buy_music_dialog" ).find('#track_savings .red').html( savings);
            $( "#buy_music_dialog" ).find('#track_savings').show();
        }

    	$( "#buy_music_dialog" ).dialog({width: 570, modal: false});

        $( "#buy_music_dialog" ).find('.music_buy_btn').unbind('click');
        $( "#buy_music_dialog" ).find('.music_buy_btn').click(function() {
            errs = new Array();
            if (doLoadP)
            {
                return false;
            }
				var payMore =  $('#payMore').val();
				<!--Strat -->
				if(payMore=='')
						{
							   $( "#buy_music_dialog" ).find('#music_err').html('Please Enter The Some Fund... :)').parent().show();
						}
				else
						{
							
							
							var intRegex = /^\d+$/;
							var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
							var str = payMore;
							if(intRegex.test(str) || floatRegex.test(str)) 
								{
								// Here im Process to update the database and start payement process
								/**
								*Ajax Function  Start Here
								**/
					if(payMore>=price)
						{
							
            doLoadP = 1;
            $( "#buy_music_dialog" ).find('.music_buy_btn').addClass('noactive');
            $( "#buy_music_dialog" ).find('.wait').show();
            $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
            $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': $( "#buy_music_dialog" ).find('#dialog_mid').val(),payMore:payMore},
                url:'/base/profile/PayMoreAlbumPurchaseMusic',
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
                            oErrors.ShowInOne('music_err');
                        }
                        else
                        {
                            $( "#buy_music_dialog" ).find('#music_success').html('Album is purchased').parent().show();
                            if(in_player == 1)
                            {
                                //reload tracks in player
                                for(var i in data.tracks)
                                {
                                    if($('.track_list #list').length > 0 && $('.track_list #list').find('tr[tid=' + i + ']').length > 0)
                                    {
                                        data.tracks[i] = '/' + data.tracks[i];
                                        $('.track_list #list').find('tr[tid=' + i + ']').attr('track', data.tracks[i]);
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.buy_music').replaceWith('<a href="' + data.tracks[i] + '" class="button">Download</a>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.add_music').replaceWith('<a href="' + data.tracks[i] + '" class="button">Download</a>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.pricetag').replaceWith('<span class="pricetag own">&#10004;</span>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.albumttl').attr('buyed', '1');
                                        if(typeof curTrack != "undefined" && curTrack == i)
                                        {
                                            $('#track_buttons').hide();
                                            play(data.tracks[i], curTrack);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });
						}
						else
						{

							$( "#buy_music_dialog" ).find('#music_err').html('Oops Not Less Than Priced Rates :'+price).parent().show();																	 
						}
			
								/**
								*Ajax Function End Here
								**/
								
							  
								
								}
							else
							{
							 $( "#buy_music_dialog" ).find('#music_err').html('Only Numbers Allowed... :( ').parent().show();
							}
							
						
						
						}
				<!--End -->
				
				
				

        });
        $( "#buy_music_dialog" ).find('.reset_button').click(function() {
            $( "#buy_music_dialog" ).dialog('close');
        });

    },
	
    BuyMusic: function(id, title, price, image, artist_url, artist_band, atrist_genres, in_player)
    {
        errs = new Array();
        var in_player = typeof in_player != "undefined" ? in_player : 0;
        oProfile.BuyMusicDialogClear();
        $( "#buy_music_dialog" ).find('#dialog_mid').val(id);
        if(artist_url != '')
        {
            $( "#buy_music_dialog" ).find('.track_author a').attr('href', artist_url);
            $( "#buy_music_dialog" ).find('.track_author a').html(artist_band);
            $( "#buy_music_dialog" ).find('.track_album .track_genres').html(atrist_genres);
        }
        
        var music_url = $( "#buy_music_dialog" ).find('.track_author a').attr('href') + '/music';
        $( "#buy_music_dialog" ).find('.track_name').html( title );
        $( "#buy_music_dialog" ).find('.album_img a').attr('href', music_url);
        $( "#buy_music_dialog" ).find('.album_img img').attr('src', image);
        if(price > 0)
        {
            $( "#buy_music_dialog" ).find('.price strong').html(price);
            $( "#buy_music_dialog" ).find('.price').show();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Buy');
			/*alert(price); */
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
            if (doLoadP)
            {
                return false;
            }
            doLoadP = 1;
            $( "#buy_music_dialog" ).find('.music_buy_btn').addClass('noactive');
            $( "#buy_music_dialog" ).find('.wait').show();
            $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
            $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': $( "#buy_music_dialog" ).find('#dialog_mid').val()},
                url:'/base/profile/PurchaseMusic',
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
                            oErrors.ShowInOne('music_err');
                        }
                        else
                        {
                            $( "#buy_music_dialog" ).find('#music_success').html('Track is purchased').parent().show();
                            if(in_player == 1)
                            {
                                var mid = $( "#buy_music_dialog" ).find('#dialog_mid').val();
                                //reload track in player
                                if($('.track_list #list').length > 0 && $('.track_list #list').find('tr[tid=' + mid + ']').length > 0)
                                {
                                    data.track = '/' + data.track;
                                    $('.track_list #list').find('tr[tid=' + mid + ']').attr('track', data.track);
                                    $('.track_list #list').find('tr[tid=' + mid + ']').find('.buy_music').replaceWith('<a href="' + data.track + '" class="button">Download</a>');
                                    $('.track_list #list').find('tr[tid=' + mid + ']').find('.add_music').replaceWith('<a href="' + data.track + '" class="button">Download</a>');
                                    $('.track_list #list').find('tr[tid=' + mid + ']').find('.pricetag').replaceWith('<span class="pricetag own">&#10004;</span>');
                                    if(typeof curTrack != "undefined" && curTrack == mid)
                                    {
                                        $('#track_buttons').hide();
                                        play(data.track, curTrack);
                                    }
                                }
                            }
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });
        });
        $( "#buy_music_dialog" ).find('.reset_button').click(function() {
            $( "#buy_music_dialog" ).dialog('close');
        });

    },
	
	/*
	* Pay More by Lenin Kumar popup Window Datas
	*/
		verifyPayMore: function(values,currentPrice)
		{

			var name = $("#payMore").attr("name");
			alert(name);
		},

    PayMoreMusicDialogClear: function()
    {
		
        $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
        $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
        $( "#buy_music_dialog" ).find('.track_album .track_count').html('');
        //$( "#buy_music_dialog" ).find('.track_album').hide();
        $( "#buy_music_dialog" ).find('#track_savings .red').html('');
        $( "#buy_music_dialog" ).find('#track_savings').hide();
        $( "#buy_music_dialog" ).find('.music_buy_btn').removeClass('noactive');
        $( "#buy_music_dialog" ).find('.wait').hide();
        $( "#buy_music_dialog" ).find('#dialog_mid').val('');
	},
		
	   PayMoreMusic: function(id, title, price, image, artist_url, artist_band, atrist_genres, in_player)
    {
		
        errs = new Array();
        var in_player = typeof in_player != "undefined" ? in_player : 0;
        oProfile.PayMoreMusicDialogClear();
        $( "#buy_music_dialog" ).find('#dialog_mid').val(id);
        if(artist_url != '')
        {
            $( "#buy_music_dialog" ).find('.track_author a').attr('href', artist_url);
            $( "#buy_music_dialog" ).find('.track_author a').html(artist_band);
            $( "#buy_music_dialog" ).find('.track_album .track_genres').html(atrist_genres);
        }
        
        var music_url = $( "#buy_music_dialog" ).find('.track_author a').attr('href') + '/music';
        $( "#buy_music_dialog" ).find('.track_name').html( title );
        $( "#buy_music_dialog" ).find('.album_img a').attr('href', music_url);
        $( "#buy_music_dialog" ).find('.album_img img').attr('src', image);		
		

		
		
		
	
		
		
        if(price > 0)
        {
            $( "#buy_music_dialog" ).find('.price strong').html('<input type="text" style="width:85px;height:25px;" class="payMore"  name="payMore" id="payMore" >');
          //  $( "#buy_music_dialog" ).find('.price').show(); 
          /*  $( "#buy_music_dialog" ).find('.price').html('<input type="text" style="width:85px;height:25px;" onblur="return  oProfile.verifyPayMore(this.value,10);" >'); 	*/		  		/*	$( "#buy_music_dialog" ).find('.price').html('<input type="text" style="width:85px;height:25px;" class="payMore"  name="payMore" id="payMore" >'); 	*/

            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Pay More');
        }
        else
        {
            $( "#buy_music_dialog" ).find('.price').hide();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Add');
        }

    	$( "#buy_music_dialog" ).dialog({width: 570, modal: false});
        $( "#buy_music_dialog" ).find('.music_buy_btn').unbind('click');

        $( "#buy_music_dialog" ).find('.music_buy_btn').click(function() {
            errs = new Array();
            if (doLoadP)
            {
                return false;
            }
			var payMore =  $('#payMore').val();
            
			
			
			if(payMore=='')
						{
							   $( "#buy_music_dialog" ).find('#music_err').html('Please Enter The Some Fund... :) ').parent().show();
						}
						else
						{
							var intRegex = /^\d+$/;
							var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
							var str = payMore;
							if(intRegex.test(str) || floatRegex.test(str)) 
								{
								// Here im Process to update the database and start payement process
								/**
								*Ajax Function  Start Here
								**/
					if(payMore>=price)
						{
							
										doLoadP = 1;
            $( "#buy_music_dialog" ).find('.music_buy_btn').addClass('noactive');
            $( "#buy_music_dialog" ).find('.wait').show();
            $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
            $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
								 $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': $( "#buy_music_dialog" ).find('#dialog_mid').val(),'payMore':payMore},
                url:'/base/profile/payMoreMusic/',
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
                            oErrors.ShowInOne('music_err');
                        }
                        else
                        {
                            $( "#buy_music_dialog" ).find('#music_success').html('Track is purchased').parent().show();
                            if(in_player == 1)
                            {
                                var mid = $( "#buy_music_dialog" ).find('#dialog_mid').val();
                                //reload track in player
                                if($('.track_list #list').length > 0 && $('.track_list #list').find('tr[tid=' + mid + ']').length > 0)
                                {
                                    data.track = '/' + data.track;
                                    $('.track_list #list').find('tr[tid=' + mid + ']').attr('track', data.track);
                                    $('.track_list #list').find('tr[tid=' + mid + ']').find('.buy_music').replaceWith('<a href="' + data.track + '" class="button">Download</a>');
                                    $('.track_list #list').find('tr[tid=' + mid + ']').find('.add_music').replaceWith('<a href="' + data.track + '" class="button">Download</a>');
                                    $('.track_list #list').find('tr[tid=' + mid + ']').find('.pricetag').replaceWith('<span class="pricetag own">&#10004;</span>');
                                    if(typeof curTrack != "undefined" && curTrack == mid)
                                    {
                                        $('#track_buttons').hide();
                                        play(data.track, curTrack);
                                    }
                                }
                            }
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });
					
							
							
						}
						else
						{

							$( "#buy_music_dialog" ).find('#music_err').html('Oops Not Less Than Priced Rates :'+price).parent().show();																	 
						}
			
								/**
								*Ajax Function End Here
								**/
								
							  
								
								}
							else
							{
							 $( "#buy_music_dialog" ).find('#music_err').html('Only Numbers Allowed... :( ').parent().show();
							}
							
						}
           
        });
        $( "#buy_music_dialog" ).find('.reset_button').click(function() {
            $( "#buy_music_dialog" ).dialog('close');
        });

    },

    BuyAlbum: function(id, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player)
    {
        oProfile.BuyMusicDialogClear();
	   //oProfile.BuyAlbumMusicDialogClear();
	   //alert('Im Here Saving Buy Album');
        $( "#buy_music_dialog" ).find('#dialog_mid').val(id);
        var in_player = typeof in_player != "undefined" ? in_player : 0;
        if(artist_url != '')
        {
            $( "#buy_music_dialog" ).find('.track_author a').attr('href', artist_url);
            $( "#buy_music_dialog" ).find('.track_author a').html(artist_band);
            $( "#buy_music_dialog" ).find('.track_album .track_genres').html(atrist_genres);
        }
        var music_url = $( "#buy_music_dialog" ).find('.track_author a').attr('href') + '/music';

        $( "#buy_music_dialog" ).find('.track_name').html( '<a href="' + music_url + '/' + id + '">' + title + '</a>');
        $( "#buy_music_dialog" ).find('.album_img a').attr('href', music_url + '/' + id);
        $( "#buy_music_dialog" ).find('.album_img img').attr('src', image);
        if(price > 0)
        {
            $( "#buy_music_dialog" ).find('.price strong').html( price );
            $( "#buy_music_dialog" ).find('.price').show();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Buy');
        }
        else
        {
            $( "#buy_music_dialog" ).find('.price').hide();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Add');
        }
        if(tracks > 0)
        {
            $( "#buy_music_dialog" ).find('.track_album .track_count').html( tracks + ' Songs');
        }
        //$( "#buy_music_dialog" ).find('.track_album').show();
        if(1*savings > 0)
        {
            $( "#buy_music_dialog" ).find('#track_savings .red').html( savings);
            $( "#buy_music_dialog" ).find('#track_savings').show();
        }

    	$( "#buy_music_dialog" ).dialog({width: 570, modal: true});

        $( "#buy_music_dialog" ).find('.music_buy_btn').unbind('click');
        $( "#buy_music_dialog" ).find('.music_buy_btn').click(function() {
            errs = new Array();
            if (doLoadP)
            {
                return false;
            }
            doLoadP = 1;
            $( "#buy_music_dialog" ).find('.music_buy_btn').addClass('noactive');
            $( "#buy_music_dialog" ).find('.wait').show();
            $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
            $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': $( "#buy_music_dialog" ).find('#dialog_mid').val()},
                url:'/base/profile/PurchaseAlbum',
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
                            oErrors.ShowInOne('music_err');
                        }
                        else
                        {
                            $( "#buy_music_dialog" ).find('#music_success').html('Album is purchased').parent().show();
                            if(in_player == 1)
                            {
                                //reload tracks in player
                                for(var i in data.tracks)
                                {
                                    if($('.track_list #list').length > 0 && $('.track_list #list').find('tr[tid=' + i + ']').length > 0)
                                    {
                                        data.tracks[i] = '/' + data.tracks[i];
                                        $('.track_list #list').find('tr[tid=' + i + ']').attr('track', data.tracks[i]);
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.buy_music').replaceWith('<a href="' + data.tracks[i] + '" class="button">Download</a>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.add_music').replaceWith('<a href="' + data.tracks[i] + '" class="button">Download</a>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.pricetag').replaceWith('<span class="pricetag own">&#10004;</span>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.albumttl').attr('buyed', '1');
                                        if(typeof curTrack != "undefined" && curTrack == i)
                                        {
                                            $('#track_buttons').hide();
                                            play(data.tracks[i], curTrack);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });
        });
        $( "#buy_music_dialog" ).find('.reset_button').click(function() {
            $( "#buy_music_dialog" ).dialog('close');
        });

    },
	
	PayMoreBuyVideoDialogClear: function()
    {

        $( "#buy_video_dialog" ).find('#video_err').html('').parent().hide();
        $( "#buy_video_dialog" ).find('#video_success').html('').parent().hide();
        $( "#buy_video_dialog" ).find('.video_buy_btn').removeClass('noactive');
        $( "#buy_video_dialog" ).find('.wait').hide();
        $( "#buy_video_dialog" ).find('.track_name').html('');		
	},
    PayMoreBuyVideo: function(id, title, price, image)
    {
		 oProfile.PayMoreBuyVideoDialogClear();
        $( "#buy_video_dialog" ).find('#dialog_vid').val(id);
        $( "#buy_video_dialog" ).find('#video_err').html('').parent().hide();
        $( "#buy_video_dialog" ).find('#video_success').html('').parent().hide();
        $( "#buy_video_dialog" ).find('.video_buy_btn').removeClass('noactive');
        $( "#buy_video_dialog" ).find('.wait').hide();
        $( "#buy_video_dialog" ).find('.track_name').html( title );
        if(image != '')
        {
            $( "#buy_video_dialog" ).find('.album_img img').attr('src', image);
        }
        if(price > 0)
        {
            $( "#buy_video_dialog" ).find('.price strong').html('<input type="text" style="width:85px;height:25px;" class="payMore"  name="payMore" id="payMore" >');
            $( "#buy_video_dialog" ).find('.price').show();
            $( "#buy_video_dialog" ).find('.video_buy_btn').val('Pay More');
        }
        else
        {
            $( "#buy_video_dialog" ).find('.price').hide();
            $( "#buy_video_dialog" ).find('.video_buy_btn').val('Add');
        }
        

    	$( "#buy_video_dialog" ).dialog({width: 570, modal: false});

        $( "#buy_video_dialog" ).find('.video_buy_btn').unbind('click');
        $( "#buy_video_dialog" ).find('.video_buy_btn').click(function() {
            errs = {};
            if (doLoadP)
            {
                return false;
            }
			var payMore =  $('#payMore').val();
		    
			
				if(payMore=='')
						{
							   $( "#buy_video_dialog" ).find('#video_err').html('Please Enter The Some Fund... :)').parent().show();
						}
				else
						{
												

							var intRegex = /^\d+$/;
							var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
							var str = payMore;
							if(intRegex.test(str) || floatRegex.test(str)) 
							{
										if(payMore>=price)	
											{
												
		   doLoadP = 1;
            $( "#buy_video_dialog" ).find('.video_buy_btn').addClass('noactive');
            $( "#buy_video_dialog" ).find('.wait').show();
            $( "#buy_video_dialog" ).find('#video_success').html('').parent().hide();
            $( "#buy_video_dialog" ).find('#video_err').html('').parent().hide();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': $( "#buy_video_dialog" ).find('#dialog_vid').val(),'PayMore' : payMore },
                url:'/base/profile/PurchaseVideo',
                success:function (data)
                {
                    doLoadP = 0;
                    $( "#buy_video_dialog" ).find('.video_buy_btn').removeClass('noactive');
                    $( "#buy_video_dialog" ).find('.wait').hide();
                    if (data.q == 'ok')
                    {
                        if(data.errs.length > 0)
                        {
                            errs = data.errs;
                            oErrors.ShowInOne('video_err');
                        }
                        else
                        {
                            $( "#buy_video_dialog" ).find('#video_success').html((price > 0 ? 'Video is purchased' : 'Video was added to your list')).parent().show();
                            document.location = '/fan/video?id='+$( "#buy_video_dialog" ).find('#dialog_vid').val();
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });
																		
												
												
											}
										else
											{
									 $( "#buy_video_dialog" ).find('#video_err').html('Oops Not Less Than Priced Rates :'+price).parent().show();																	 												
											}
								
							}
							else
							{
							$( "#buy_video_dialog" ).find('#video_err').html('Only Numbers Allowed... :( ').parent().show();																
							}
							
								
						}
         
        });
        $( "#buy_video_dialog" ).find('.reset_button').click(function() {
            $( "#buy_video_dialog" ).dialog('close');
        });
    
    
	},
	

    BuyVideo: function(id, title, price, image)
    {
		alert('Video Module');
		return false;
        $( "#buy_video_dialog" ).find('#dialog_vid').val(id);
        $( "#buy_video_dialog" ).find('#video_err').html('').parent().hide();
        $( "#buy_video_dialog" ).find('#video_success').html('').parent().hide();
        $( "#buy_video_dialog" ).find('.video_buy_btn').removeClass('noactive');
        $( "#buy_video_dialog" ).find('.wait').hide();
        $( "#buy_video_dialog" ).find('.track_name').html( title );
        if(image != '')
        {
            $( "#buy_video_dialog" ).find('.album_img img').attr('src', image);
        }
        if(price > 0)
        {
            $( "#buy_video_dialog" ).find('.price strong').html( price );
            $( "#buy_video_dialog" ).find('.price').show();
            $( "#buy_video_dialog" ).find('.video_buy_btn').val('Buy');
        }
        else
        {
            $( "#buy_video_dialog" ).find('.price').hide();
            $( "#buy_video_dialog" ).find('.video_buy_btn').val('Add');
        }
        

    	$( "#buy_video_dialog" ).dialog({width: 570, modal: true});

        $( "#buy_video_dialog" ).find('.video_buy_btn').unbind('click');
        $( "#buy_video_dialog" ).find('.video_buy_btn').click(function() {
            errs = {};
            if (doLoadP)
            {
                return false;
            }
            doLoadP = 1;
            $( "#buy_video_dialog" ).find('.video_buy_btn').addClass('noactive');
            $( "#buy_video_dialog" ).find('.wait').show();
            $( "#buy_video_dialog" ).find('#video_success').html('').parent().hide();
            $( "#buy_video_dialog" ).find('#video_err').html('').parent().hide();
			
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': $( "#buy_video_dialog" ).find('#dialog_vid').val()},
                url:'/base/profile/PurchaseVideo',
                success:function (data)
                {
                    doLoadP = 0;
                    $( "#buy_video_dialog" ).find('.video_buy_btn').removeClass('noactive');
                    $( "#buy_video_dialog" ).find('.wait').hide();
                    if (data.q == 'ok')
                    {
                        if(data.errs.length > 0)
                        {
                            errs = data.errs;
                            oErrors.ShowInOne('video_err');
                        }
                        else
                        {
                            $( "#buy_video_dialog" ).find('#video_success').html((price > 0 ? 'Video is purchased' : 'Video was added to your list')).parent().show();
                            document.location = '/fan/video?id='+$( "#buy_video_dialog" ).find('#dialog_vid').val();
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });
        });
        $( "#buy_video_dialog" ).find('.reset_button').click(function() {
            $( "#buy_video_dialog" ).dialog('close');
        });
    },

    /**
     * Init event buttons
     */
    InitEventActions: function()
    {
        $('.attend_event').click(function(){
            var obj = $(this);
            var id = $(obj).attr('mid');
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': id},
                url:'/base/profile/AttendEvent',
                success:function (data)
                {
                    if (data.q == 'ok')
                    {
                        //$(obj).remove();
                        $(obj).replaceWith('<div class="good status-good">You\'re going</div>');
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });
        });
        $('.notattend_event').click(function(){
            var obj = $(this);
            var id = $(obj).attr('mid');
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': id},
                url:'/base/profile/RemoveAttendEvent',
                success:function (data)
                {
                    if (data.q == 'ok')
                    {
                        document.location = '/fan/events';
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });
        });
        $('.buy_access').click(function() {
            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            if(!ttl && $('.ttl').length == 1)
            {
                ttl = $('.ttl').html();
            }
            var imgsrc = ($(this).parent().parent().find('.event-artist img').length > 0) ? $(this).parent().parent().find('.event-artist img').attr('src') : '';
            var artist_url = ($(this).parent().parent().find('.event-artist a').length > 0) ? $(this).parent().parent().find('.event-artist a').attr('href') : '';
            var artist_band = ($(this).parent().parent().find('.event-artist a').length > 0) ? $(this).parent().parent().find('.event-artist a').attr('title') : '';
            oProfile.BuyAccess( $(this).attr('mid'), ttl, $(this).attr('price'), imgsrc, artist_url, artist_band );
        });
        $('.announce_event').click(function(){
            var obj = $(this);
            var id = $(obj).attr('mid');
            if (doLoadP)
            {
                return false;
            }
            doLoadP = 1;
            $(obj).addClass('noactive');
            $(obj).parent().parent().find('.wait').show();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': id, 'json': '1'},
                url:'/base/artist/EventAnnounce',
                success:function (data)
                {
                    doLoadP = 0;
                    $(obj).removeClass('noactive');
                    $(obj).parent().parent().find('.wait').hide();
                    if (data.q == 'ok')
                    {
                        $(obj).replaceWith('<div class="good">Announced</div>');
                    }
                }
            });
        });
        $('.cancel_event').click(function(){
            if (confirm('Do You wish to cancel this event?'))
            {
                var obj = $(this);
                var id = $(obj).attr('mid');
                if (doLoadP)
                {
                    return false;
                }
                doLoadP = 1;
                $(obj).addClass('noactive');
                $(obj).parent().parent().find('.wait').show();
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    data:{'id': id},
                    url:'/base/artist/EventCancel',
                    success:function (data)
                    {
                        doLoadP = 0;
                        $(obj).removeClass('noactive');
                        $(obj).parent().parent().find('.wait').hide();
                        if (data.q == 'ok')
                        {
                            //$(obj).replaceWith('<div class="good">Event canceled</div>');
                            document.location = '/artist/events/' + id;
                        }
                    }
                });
            }
        });
        $('.event_finish').click(function(){
            if (confirm('Do You wish to finish this broadcast?'))
            {
                var obj = $(this);
                var id = 1*$(obj).attr('mid');
                if (doLoadP)
                {
                    return false;
                }
                doLoadP = 1;
                if(id == 0)
                {
                    document.location = '/artist/broadcasting';
                    return false;
                }
                $(obj).addClass('noactive');
                $(obj).parent().find('.wait').show();
                $.ajax({
                    type:'POST',
                    dataType:'json',
                    data:{'id': id},
                    url:'/base/artist/EventFinish',
                    success:function (data)
                    {
                        doLoadP = 0;
                        $(obj).removeClass('noactive');
                        $(obj).parent().find('.wait').hide();
                        if (data.q == 'ok')
                        {
                            document.location = '/artist/broadcasting?event_finished=' + data.id;
                        }
                    }
                });
            }
        });
    },

    /**
     * Init event buttons for guest
     */
    InitEventActionsForGuests: function()
    {
        $('.attend_event').click(function(){
            oProfile.PurchaseRedirect('event_attend', $(this).attr('mid'));
        });
        $('.notattend_event').click(function(){
            oProfile.PurchaseRedirect('event_remove_attend', $(this).attr('mid'));
        });
        $('.buy_access').click(function() {
            oProfile.PurchaseRedirect('event_access', $(this).attr('mid'));
        });
    },

    BuyAccess: function(id, title, price, image, artist_url, artist_band)
    {
        $( "#buy_access_dialog" ).find('.track_name').html( title );
        if(price > 0)
        {
            $( "#buy_access_dialog" ).find('.price strong').html( price );
            $( "#buy_access_dialog" ).find('.price').show();
            $( "#buy_access_dialog" ).find('.access_buy_btn').val('Buy');
        }
        else
        {
            $( "#buy_access_dialog" ).find('.price').hide();
            $( "#buy_access_dialog" ).find('.access_buy_btn').val('Get');
        }
        if(image != '')
        {
            $( "#buy_access_dialog" ).find('.album_img img').attr('src', image);
        }
        if(artist_url != '')
        {
            $( "#buy_access_dialog" ).find('.album_img a').attr('href', artist_url);
            $( "#buy_access_dialog" ).find('.track_author a').attr('href', artist_url);
        }
        if(artist_band != '')
        {
            $( "#buy_access_dialog" ).find('.track_author a').html(artist_band);
        }

    	$( "#buy_access_dialog" ).dialog({width: 570, modal: true});

        $( "#buy_access_dialog" ).find('.access_buy_btn').unbind('click');
        $( "#buy_access_dialog" ).find('.access_buy_btn').click(function() {
            errs = new Array();
            if (doLoadP)
            {
                return false;
            }
            doLoadP = 1;
            $( "#buy_access_dialog" ).find('.access_buy_btn').addClass('noactive');
            $( "#buy_access_dialog" ).find('.wait').show();
            $( "#buy_access_dialog" ).find('#access_success').html('').parent().hide();
            $( "#buy_access_dialog" ).find('#access_err').html('').parent().hide();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': id},
                url:'/base/profile/PurchaseEventAccess',
                success:function (data)
                {
                    doLoadP = 0;
                    $( "#buy_access_dialog" ).find('.access_buy_btn').removeClass('noactive');
                    $( "#buy_access_dialog" ).find('.wait').hide();
                    if (data.q == 'ok')
                    {
                        if(data.errs.length > 0)
                        {
                            errs = data.errs;
                            oErrors.ShowInOne('access_err');
                        }
                        else
                        {
                            $( "#buy_access_dialog" ).find('#access_success').html('Access is purchased').parent().show();
                            document.location = '/fan/events/' + id;
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });
        });
        $( "#buy_access_dialog" ).find('.reset_button').click(function() {
            $( "#buy_access_dialog" ).dialog('close');
        });

    },


    InitPayout: function()
    {
        $('.cancel_payout').click(function() {
            if (confirm('Do You wish to chancel this payment?'))
            {
                var id  = $(this).attr('aid');
                var obj = $(this);

                $.ajax({
                    type:'POST',
                    dataType:'json',
                    data:{'id': id},
                    url:'/artist/CancelPayout',
                    success:function (data)
                    {
                        if (data.q == 'ok')
                        {
                            $(obj).parent().parent().remove();    
                        }
                    }
                });  
            }     
        });
        

    },


    ChangePassword: function(n)
    {
        var mod = n == 1 ? 'artist' : 'fan';
        if (doLoadP)
        {
            return false;
        }
        doLoadP = 1;

        $('.err').html('');
        $('#pass_change').html('');
        $('#pass_change').parent().hide();

        var options = {
            type:'post',
            dataType:'json',
            clearForm:false,
            resetForm:false,
            url:'/' + mod + '/settings',
            beforeSubmit:function ()
            {
                $('#settings_form').find('.wait').show();
                $('#settings_form').find('.button').addClass('noactive');
            },
            success:function (data)
            {
                $('#settings_form').find('.wait').hide();
                $('#settings_form').find('.button').removeClass('noactive');
                doLoadP = 0;
                if (data.q == 'ok')
                {
                    $('#pass_change').html('Your password was successfully changed.');
                    $('#pass_change').parent().show();
                    $('#settings_form input[type=password]').val('');
                }
                else
                {
                    if (data.errs)
                    {
                        for (var i in data.errs)
                        {
                            oErrors.SetBadFld(i, data.errs[i]);
                            //$('#err_' + i).html('<br />' + data.errs[i]);
                        }
                    }
                }
            }
        };
        $('#settings_form').ajaxSubmit(options);        
    },
	
    AddEmail: function(n)
    {
        var mod = n == 1 ? 'artist' : 'fan';
        if (doLoadP)
        {
            return false;
        }
        doLoadP = 1;

        $('.err').html('');
        $('#add_email').html('');
        $('#add_email').parent().hide();

        var options = {
            type:'post',
            dataType:'json',
            clearForm:false,
            resetForm:false,
            url:'/' + mod + '/settings',
            beforeSubmit:function ()
            {
                $('#add_email_form').find('.wait').show();
                $('#add_email_form').find('.button').addClass('noactive');
            },
            success:function (data)
            {
                $('#add_email_form').find('.wait').hide();
                $('#add_email_form').find('.button').removeClass('noactive');
                doLoadP = 0;
                if (data.q == 'ok')
                {
                    $('#add_email').html('Your Email was successfully Added.');
                    $('#add_email').parent().show();
                    $('#add_email_form input[type=text]').val('');
                }
                else
                {
                    if (data.errs)
                    {
                        for (var i in data.errs)
                        {
                            oErrors.SetBadFld(i, data.errs[i]);
                            //$('#err_' + i).html('<br />' + data.errs[i]);
                        }
                    }
                }
            }
        };
        $('#add_email_form').ajaxSubmit(options);        
    },
	
    ChangeAccount: function(n, t)
    {
        var mod = n == 1 ? 'artist' : 'fan';
        if (doLoadP)
        {
            return false;
        }
        doLoadP = 1;
        $('#social_form').find('input[name=do]').val('social_' + t);

        $('.err').html('');
        $('#social_change').html('');
        $('#social_change').parent().hide();

        var options = {
            type:'post',
            dataType:'json',
            clearForm:false,
            resetForm:false,
            url:'/' + mod + '/settings',
            beforeSubmit:function ()
            {
                $('#social_form').find('.'+t+'_wait').show();
                $('#social_form').find('.'+t+'_btn').addClass('noactive');
            },
            success:function (data)
            {
                $('#social_form').find('.'+t+'_wait').hide();
                $('#social_form').find('.'+t+'_btn').removeClass('noactive');
                doLoadP = 0;
                if (data.q == 'ok')
                {
                    $('#social_change').html('Account updated.');
                    $('#social_change').parent().show();
                    if(t == 'fb')
                    {
                        if(data.url)
                        {
                            $('#status_fb_id').html('Status: not connected');
                            document.location = data.url;
                        }
                        else
                        {
                            $('#status_fb_id').hide();
                        }
                    }
                    else
                    {
                        if(data.url)
                        {
                            $('#status_tw_id').html('Status: not connected');
                            document.location = data.url;
                        }
                        else
                        {
                            $('#status_tw_id').hide();
                        }
                    }
                }
                else
                {
                    if (data.errs)
                    {
                        for (var i in data.errs)
                        {
                            oErrors.SetBadFld(i, data.errs[i]);
                        }
                    }
                }
            }
        };
        $('#social_form').ajaxSubmit(options);
    },

    GetVideoStatus: function(n, id)
    {
        var mod = n == 1 ? 'artist' : 'fan';
        if (doLoadP)
        {
            return false;
        }
        doLoadP = 1;

        $.ajax({
            type:'POST',
            dataType:'json',
            data:{'id': id},
            url:'/base/profile/CheckVideoStatus',
            success:function (data)
            {
                doLoadP = 0;
                if (data.q == 'ok')
                {
                    if(data.status == 2)
                    {
                        document.location = '/' + mod + '/video/' + id;
                    }
                }
            }
        });

        setTimeout("oProfile.GetVideoStatus("+n+", "+id+");", 30000);
    },
	
	GetMusicStatus: function(n, id)
    {
        var mod = n == 1 ? 'artist' : 'fan';
        if (doLoadP)
        {
            return false;
        }
        doLoadP = 1;

        $.ajax({
            type:'POST',
            dataType:'json',
            data:{'id': id},
            url:'/base/profile/CheckMusicStatus',
            success:function (data)
            {
                doLoadP = 0;
                if (data.q == 'ok')
                {
                    if(data.status == 0)
                    {
						if(mod == 'artist') {
                        	document.location = '/player/music/' + id;
						} else {
							document.location = '/fan/play/' + id;
						}
                    }
                }
            }
        });

        setTimeout("oProfile.GetMusicStatus("+n+", "+id+");", 30000);
    },

    CheckEventOnline: function(event_id)
    {
        $.ajax({
            type:'POST',
            dataType:'json',
            data:{'event_id': event_id},
            url:'/base/profile/CheckEventOnline',
            success:function (data)
            {
                if (data.q == 'ok')
                {
                    if(data.online == 1)
                    {
                        window.location.reload();
                    }
                }
            }
        });

        setTimeout("oProfile.CheckEventOnline('"+event_id+"');", 30000);
    },

    GetViewersCount: function(event_id, more)
    {
        var more = (typeof(more) != "undefined" && 1==more) ? 1 : 0;
        var curv = 1*$('.viewers_list').find('li.viewer').length;
        var curp = 1*$('.viewers_list').attr('pid');
        var time = 1*$('#runtime').attr('stime');
        if(more && 1*$('#viewers_count').html() > curv)
        {
            curp++;
        }
        if (doLoadP && !more)
        {
            return false;
        }
        doLoadP = 1;

        $.ajax({
            type:'POST',
            dataType:'json',
            data:{'event_id': event_id, 'page': curp, 'time': time},
            url:'/base/profile/GetViewersList',
            success:function (data)
            {
                if (data.q == 'ok')
                {
                    var s = '';
                    $('#viewers_count').html(data.count);
                    for (var i in data.list)
                    {
                        s += '<li class="viewer" vid="'+data.list[i]['Id']+'">' +
                                  '<a href="/u/'+data.list[i]['Name']+'"><img src="' + (data.list[i]['Avatar'] != '' ? '/files/images/avatars/x_' + data.list[i]['Avatar'] : '/i/ph/user-48x48.png') + '" width="48" height="48" alt="" /></a>' +
                              '</li>';
                    }
                    s += '<li class="more" style="display: none;">' + $('li.more').html() + '</li>';
                    $('.viewers_list').html(s);
                    
                    $('.viewers_list').attr('pid', curp)
                    curv = 1*$('.viewer').length;
                    data.count = 1*data.count;
                    if(data.count > curv)
                    {
                        $('.viewers_list').find('.more a').html('and ' + (data.count - curv) + ' + more');
                        $('.viewers_list').find('.more').show();
                    }
                    else
                    {
                        $('.viewers_list').find('.more').hide();
                    }
                    if(time == 0)
                    {
                        $('#runtime').attr('stime', data.time);
                    }
                    $('#runtime').html(data.length);
                }
                doLoadP = 0;
            }
        });
        if(tm != 0)
        {
            clearTimeout(tm);
        }
        tm = setTimeout("oProfile.GetViewersCount('"+event_id+"');", 60000);
    },

    UpdateViewer: function(event_id)
    {
        if (doLoadP)
        {
            return false;
        }
        doLoadP = 1;

        $.ajax({
            type:'POST',
            dataType:'json',
            data:{'event_id': event_id},
            url:'/base/profile/UpdateViewer',
            success:function (data)
            {
                doLoadP = 0;
            }
        });
        setTimeout("oProfile.UpdateViewer('"+event_id+"');", 180000);
    },

    Payment: function()
    {
        if (doLoadP)
        {
            return false;
        }
        doLoadP = 1;

        $('.err').html('');
        $('#buy_result').html('');
        $('#buy_result').parent().find('strong').html('');
        $('#buy_result').parent().removeClass('alert_error').removeClass('alert_success').hide();

        var options = {
            type:'post',
            dataType:'json',
            clearForm:false,
            resetForm:false,
            url:'/fan/buypoints',
            beforeSubmit:function ()
            {
                $('#buy_form').find('.wait').show();
                $('#buy_form').find('.button').addClass('noactive');
            },
            success:function (data)
            {
                $('#buy_form').find('.wait').hide();
                $('#buy_form').find('.button').removeClass('noactive');
                doLoadP = 0;
                if (data.q == 'ok')
                {
                    $('#buy_result').html('The operation was successfully processed.');
                    $('#buy_result').parent().find('strong').html('Success!');
                    $('#buy_result').parent().addClass('alert_success').show();
                    $('.amount strong').html(data.ballance);
                    $('#buy_form').resetForm();
                    if(data.redirect)
                    {
                        document.location = '/' + data.redirect;
                    }
                }
                else if(data.q == 'err')
                {
                    $('#buy_result').html(data.errs['common']);
                    $('#buy_result').parent().find('strong').html('Error!');
                    $('#buy_result').parent().addClass('alert_error').show();
                    if (data.errs)
                    {
                        for (var i in data.errs)
                        {
                            oErrors.SetBadFld(i, data.errs[i]);
                        }
                    }
                }
                else if(data.q == 'cancel')
                {
                    $('#buy_result').html(data.errs['common']);
                    $('#buy_result').parent().find('strong').html('Error!');
                    $('#buy_result').parent().addClass('alert_error').show();
                    $('#buy_form').resetForm();
                }
                $('body,html').scrollTop(0);
            }
        };
        $('#buy_form').ajaxSubmit(options);
    },
	
	ValidateAmount: function()
	{
		if($('#frmPaypal .button').hasClass('noactive')) return false;
		var amount = $('#paypal').val();
		if($.trim(amount) == '') {
			oErrors.SetBadFld('paypal', 'Enter Amount');
			return false;
		} else if(!validDecimal(amount)) {
			oErrors.SetBadFld('paypal', 'Enter Numeric Values');
			return false;
		} else {
			oErrors.SetOkFld('paypal');
		}
		$('#frmPaypal').find('.wait').show();
		$('#frmPaypal').find('.button').addClass('noactive');
		var options = {
            type:'post',
            dataType:'json',
            clearForm:false,
            resetForm:false,
            url:'/fan/buypaypalpoints', 
          /*  url:'/fan/BuyPoints', 		*/  
            success:function (data)
            {
                $('#frmPaypal').find('.wait').hide();
                $('#frmPaypal').find('.button').removeClass('noactive');
                doLoadP = 0;
                if (data.q == 'ok')
                {
                    $('#buy_result').html('The operation was successfully processed.');
                    $('#buy_result').parent().find('strong').html('Success!');
                    $('#buy_result').parent().addClass('alert_success').show();
                    $('.amount strong').html(data.ballance);
                    $('#frmPaypal').resetForm();
                    if(data.redirect)
                    {
                        document.location = '/' + data.redirect;
                    }
                }
                else if(data.q == 'err')
                {
                    $('#buy_result').html(data.errs['common']);
                    $('#buy_result').parent().find('strong').html('Error!');
                    $('#buy_result').parent().addClass('alert_error').show();
                    if (data.errs)
                    {
                        for (var i in data.errs)
                        {
                            oErrors.SetBadFld(i, data.errs[i]);
                        }
                    }
                }
                else if(data.q == 'cancel')
                {
                    $('#buy_result').html(data.errs['common']);
                    $('#buy_result').parent().find('strong').html('Error!');
                    $('#buy_result').parent().addClass('alert_error').show();
                    $('#frmPaypal').resetForm();
                }
                $('body,html').scrollTop(0);
            }
        };
        $('#frmPaypal').ajaxSubmit(options);
		return false;
	},
	 InitPayMoreforpageMusic: function(obj)
    {
        var imgsrc = ($(this).parent().parent().find('img').length > 0) ? $(obj).parent().parent().find('img').attr('src') : $(obj).parent().parent().parent().find('img').attr('src');
        imgsrc = imgsrc.replace('/x_', '/m_');
        var ttl = $(obj).parent().parent().find('.ttl').html();
        var artist_url = $(obj).parent().parent().find('.artist').attr('src');
        var artist_band = $(obj).parent().parent().find('.artist').html();
        var artist_genres = $(obj).parent().parent().find('.artist').attr('genres');
		alert('artist Url '+artist_url);
        oProfile.PayMoreforpageMusic( $(obj).attr('mid'), ttl, $(obj).attr('price'), imgsrc, artist_url, artist_band, artist_genres, 1 );
    },
	 PayMoreforpagesMusicDialogClear: function()
    {
		
        $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
        $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
        $( "#buy_music_dialog" ).find('.track_album .track_count').html('');
        //$( "#buy_music_dialog" ).find('.track_album').hide();
        $( "#buy_music_dialog" ).find('#track_savings .red').html('');
        $( "#buy_music_dialog" ).find('#track_savings').hide();
        $( "#buy_music_dialog" ).find('.music_buy_btn').removeClass('noactive');
        $( "#buy_music_dialog" ).find('.wait').hide();
        $( "#buy_music_dialog" ).find('#dialog_mid').val('');
	},
	  PayMoreforpageMusic: function(id, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player)
    {
       // oProfile.BuyMusicDialogClear();
	   //oProfile.BuyAlbumMusicDialogClear();
	   //alert('Im Here Saving Buy Album');
        $( "#buy_music_dialog" ).find('#dialog_mid').val(id);
        var in_player = typeof in_player != "undefined" ? in_player : 0;
        if(artist_url != '')
        {
            $( "#buy_music_dialog" ).find('.track_author a').attr('href', artist_url);
            $( "#buy_music_dialog" ).find('.track_author a').html(artist_band);
            $( "#buy_music_dialog" ).find('.track_album .track_genres').html(atrist_genres);
        }
        var music_url = $( "#buy_music_dialog" ).find('.track_author a').attr('href') + '/music';

        $( "#buy_music_dialog" ).find('.track_name').html( '<a href="' + music_url + '/' + id + '">' + title + '</a>');
        $( "#buy_music_dialog" ).find('.album_img a').attr('href', music_url + '/' + id);
        $( "#buy_music_dialog" ).find('.album_img img').attr('src', image);

        if(price > 0)
        {
            $( "#buy_music_dialog" ).find('.price strong').html('<input type="text" style="width:85px;height:25px;" class="payMore"  name="payMore" id="payMore" >');
            $( "#buy_music_dialog" ).find('.price').show();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Pay More');
        }
        else
        {
            $( "#buy_music_dialog" ).find('.price').hide();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Add');
        }
        if(tracks > 0)
        {
            $( "#buy_music_dialog" ).find('.track_album .track_count').html( tracks + ' Songs');
        }
        //$( "#buy_music_dialog" ).find('.track_album').show();
        if(1*savings > 0)
        {
            $( "#buy_music_dialog" ).find('#track_savings .red').html( savings);
            $( "#buy_music_dialog" ).find('#track_savings').show();
        }

    	$( "#buy_music_dialog" ).dialog({width: 570, modal: false});

        $( "#buy_music_dialog" ).find('.music_buy_btn').unbind('click');
        $( "#buy_music_dialog" ).find('.music_buy_btn').click(function() {
            errs = new Array();
            if (doLoadP)
            {
                return false;
            }
            doLoadP = 1;
            $( "#buy_music_dialog" ).find('.music_buy_btn').addClass('noactive');
            $( "#buy_music_dialog" ).find('.wait').show();
            $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
            $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': $( "#buy_music_dialog" ).find('#dialog_mid').val()},
                url:'/base/profile/PurchaseAlbum',
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
                            oErrors.ShowInOne('music_err');
                        }
                        else
                        {
                            $( "#buy_music_dialog" ).find('#music_success').html('Album is purchased').parent().show();
                            if(in_player == 1)
                            {
                                //reload tracks in player
                                for(var i in data.tracks)
                                {
                                    if($('.track_list #list').length > 0 && $('.track_list #list').find('tr[tid=' + i + ']').length > 0)
                                    {
                                        data.tracks[i] = '/' + data.tracks[i];
                                        $('.track_list #list').find('tr[tid=' + i + ']').attr('track', data.tracks[i]);
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.buy_music').replaceWith('<a href="' + data.tracks[i] + '" class="button">Download</a>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.add_music').replaceWith('<a href="' + data.tracks[i] + '" class="button">Download</a>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.pricetag').replaceWith('<span class="pricetag own">&#10004;</span>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.albumttl').attr('buyed', '1');
                                        if(typeof curTrack != "undefined" && curTrack == i)
                                        {
                                            $('#track_buttons').hide();
                                            play(data.tracks[i], curTrack);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });
        });
        $( "#buy_music_dialog" ).find('.reset_button').click(function() {
            $( "#buy_music_dialog" ).dialog('close');
        });

    },
	 PayMoreMusicAlbumBuyAlbum: function(id, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player)
    {
        oProfile.BuyMusicDialogClear();
	   //oProfile.BuyAlbumMusicDialogClear();
	   //alert('Im Here Saving Buy Album');
        $( "#buy_music_dialog" ).find('#dialog_mid').val(id);
        var in_player = typeof in_player != "undefined" ? in_player : 0;
        if(artist_url != '')
        {
            $( "#buy_music_dialog" ).find('.track_author a').attr('href', artist_url);
            $( "#buy_music_dialog" ).find('.track_author a').html(artist_band);
            $( "#buy_music_dialog" ).find('.track_album .track_genres').html(atrist_genres);
        }
        var music_url = $( "#buy_music_dialog" ).find('.track_author a').attr('href') + '/music';

        $( "#buy_music_dialog" ).find('.track_name').html( '<a href="' + music_url + '/' + id + '">' + title + '</a>');
        $( "#buy_music_dialog" ).find('.album_img a').attr('href', music_url + '/' + id);
        $( "#buy_music_dialog" ).find('.album_img img').attr('src', image);
        if(price > 0)
        {
            $( "#buy_music_dialog" ).find('.price strong').html( price );
            $( "#buy_music_dialog" ).find('.price').show();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Buy');
        }
        else
        {
            $( "#buy_music_dialog" ).find('.price').hide();
            $( "#buy_music_dialog" ).find('.music_buy_btn').val('Add');
        }
        if(tracks > 0)
        {
            $( "#buy_music_dialog" ).find('.track_album .track_count').html( tracks + ' Songs');
        }
        //$( "#buy_music_dialog" ).find('.track_album').show();
        if(1*savings > 0)
        {
            $( "#buy_music_dialog" ).find('#track_savings .red').html( savings);
            $( "#buy_music_dialog" ).find('#track_savings').show();
        }

    	$( "#buy_music_dialog" ).dialog({width: 570, modal: true});

        $( "#buy_music_dialog" ).find('.music_buy_btn').unbind('click');
        $( "#buy_music_dialog" ).find('.music_buy_btn').click(function() {
            errs = new Array();
            if (doLoadP)
            {
                return false;
            }
            doLoadP = 1;
            $( "#buy_music_dialog" ).find('.music_buy_btn').addClass('noactive');
            $( "#buy_music_dialog" ).find('.wait').show();
            $( "#buy_music_dialog" ).find('#music_success').html('').parent().hide();
            $( "#buy_music_dialog" ).find('#music_err').html('').parent().hide();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': $( "#buy_music_dialog" ).find('#dialog_mid').val()},
                url:'/base/profile/PurchaseAlbum',
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
                            oErrors.ShowInOne('music_err');
                        }
                        else
                        {
                            $( "#buy_music_dialog" ).find('#music_success').html('Album is purchased').parent().show();
                            if(in_player == 1)
                            {
                                //reload tracks in player
                                for(var i in data.tracks)
                                {
                                    if($('.track_list #list').length > 0 && $('.track_list #list').find('tr[tid=' + i + ']').length > 0)
                                    {
                                        data.tracks[i] = '/' + data.tracks[i];
                                        $('.track_list #list').find('tr[tid=' + i + ']').attr('track', data.tracks[i]);
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.buy_music').replaceWith('<a href="' + data.tracks[i] + '" class="button">Download</a>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.add_music').replaceWith('<a href="' + data.tracks[i] + '" class="button">Download</a>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.pricetag').replaceWith('<span class="pricetag own">&#10004;</span>');
                                        $('.track_list #list').find('tr[tid=' + i + ']').find('.albumttl').attr('buyed', '1');
                                        if(typeof curTrack != "undefined" && curTrack == i)
                                        {
                                            $('#track_buttons').hide();
                                            play(data.tracks[i], curTrack);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });
        });
        $( "#buy_music_dialog" ).find('.reset_button').click(function() {
            $( "#buy_music_dialog" ).dialog('close');
        });

    }
	
}

var tm = 0;
var oProfile = new Profile();
doLoadP = 0; 