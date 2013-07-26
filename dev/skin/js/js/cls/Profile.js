function Profile()
{

}


Profile.prototype =
{
    __construct:function ()
    {
        $(document).ready(function ()
        {
			$('body').on('click', 'a.group1', function(e){
				e.preventDefault();
				var url = $(this).attr('href');
				$.ajax({
					type	: "POST",
					cache	: false,
					url		: url,
					data :{'ajaxMode': 1},
					success: function(data) {
						
						$.fancybox(data);
					}
				});
			});
        });
    },
    EditEvent: function() 
    {
        var er = 0;
        errs = {};		
        $('#err_Location, #err_EventDate, #err_EventTime, #err_Title, #err_Duration, #err_Image, #err_Price').html('');
		if($('#moreYes').is(":checked"))
		{
			if($("#Duration").val()=='')
			{
				errs['Duration'] = 'Please specify event duration if above 2 hours';
				er = 1;
			}
		}
		if($('#moreNo').is(":checked"))
		{
			var va = $("#minutes").text();
			$("#Duration").prepend("<option value="+va+" selected='selected'></option>");
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
		
		if($('#event_image').attr('src') == '/i/nophoto.jpg')
		{
			$('#image_err').removeClass('error').html( '' );
			errs['Image'] = 'Please upload event image ' ;
			er = 1;
		}
/*		if($('input[name=fm[EventType]]:radio:checked').val() >1)
		{*/
			var price = parseFloat($("#Price").val());

			if (price<0.99)
			{
				errs['Price'] = 'Please add price or select free checkbox.';
				er = 1;
			}			
	//	}
		if (er)
        {
        	oErrors.Show();
        } 
        else
        {
			var param = "&x1="+$('#x1').val()+"&y1="+$('#y1').val()+"&x2="+$('#x2').val()+"&y2="+$('#y2').val()+"&w="+$('#w').val()+"&h="+$('#h').val();
        	$('#event_form').submit();
        }
       
    },

	DurationSlide: function() {
		$("#slideTr").show();
		$("#moreTr").show();
		$("#moreTime").hide();
		
		
		var steps = [15, 30, 45, 60, 75, 90, 105, 120];
		$("#minutes").text(15);
			
		$("#slider").slider({
			range: "min",
			value: 0,
			min: 15,
			max: 120,
			step: 15,
			slide: function(event, ui) {
				$("#minutes").text(ui.value);
			}
		});
		$("#moreYes").click(function(){
			$("#moreTime").show();
			$("#moreTimeMsg").show();
			$("#slideTr").hide();
		});
		$("#moreNo").click(function(){
			$("#moreTime").hide();
			$("#moreTimeMsg").hide();
			$("#Duration").val('');
			$("#slideTr").show();
		});		
	},
	
	SelectMusicTrack: function()
	{
		var checkAllTrack = $('#selectAllTrack').prop('checked');
		$('.tracks').prop('checked', checkAllTrack);
	},
	
    EditTrack: function()
	{	
        $('#err_Title, #err_Track, #err_Price').html('');
		//alert($('#rand_id').val());
        errs = {};  
        var er = 0;
        
        if (jQuery.trim($("#Title").val()) == "")
        {
            errs['Title'] = 'Please specify track title';
            er = 1;
        }
		
		var u_track = $('#track').html();	
		if(u_track == 'No File')
		{
            errs['Track'] = 'Please upload track';
            er = 1;			
		} 

		var price = parseFloat($("#Price").val());
		
		if($('#PriceFree').prop('checked') || $('#PriceFree1').prop('checked')) 
		{
			
		} 
		else 
		{
			eval("var stringvar=/^[+-]?[0-9]*(\\.[0-9]{0,5})?$/");
						
			if(!stringvar.test(price))
			{
					errs['Price'] = 'Price must be number!';
					er = 1;
			}			
			else if( price<0.50 || isNaN(price))
			{
				
					errs['Price'] = 'Price must be greater then $0.50.';
					er = 1;
			}
		}
        if (er)
        {
					
            oErrors.Show();
        } 
        else
        {
			var formData = $('#track_form').serialize();
			var Genres = escape($('#Genre').val());
				$.ajax({
				url: '/base/artist/SaveTrack?Genres='+Genres,
				type:'post',
				data: formData,
				dataType:'json',
				success: function(response){
					checkResponseRedirect(response);
					$('.noBar').hide();
					$('.hideTr').show();
					$('#trackTable').append(response.message);
					$('#rand_id').val(response.rand_id);
					$('#Title').val('');
					$('#track').html('No File');
					$('#track_preview').html('No File');
					$('#Price').val('0.00');
					$('#PriceFree1').prop('checked', false);
					$('#PriceFree').prop('checked', false);
					
					if($('#Price').val()> 0 || $('#PriceFree1').prop('checked'))
					{
						$('#PriceFree').hide();
					}
					$('#albumPrice').html(response.price);
					$('#trackCount').html(response.trackCount);
					if(response.price)
					{
						$('.PriceFreeTag').hide();
					}
				}
			});
        }
             
    },
	
	CheckFree: function(){
		if($('#PriceFree').attr('checked')){
			$('#Price').val('').attr('disabled',true);
		}
		else
		{	
			$('#Price').val('0.00').removeAttr('disabled');
		}
	},
	
	CheckFree1: function(){
		if($('#PriceFree1').attr('checked')){
			$('#Price').val('').attr('disabled',true);
		}
		else
		{	
			$('#Price').val('0.00').removeAttr('disabled');
		}
	},

    EditAlbum: function()
	{
		$('#err_Title, #err_DateRelease, #err_Price, #err_Image, #err_Genre').html('');
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
		
		var textLength =($("#Descr").val().length);
		if(textLength > 200)
		{
			errs['Descr'] = 'The Description should be not more than 200 characters';
			$('#Note').hide();
			er = 1;
		}		
		
		if (jQuery.trim($("#Genre").val()) == "")
        {
            errs['Genre'] = 'Please Select Genre';
            er = 1;
        }
		if($('#Type_Single').prop('checked'))
		{
			var u_track = $('#track').html();	
			if(u_track == 'No file')
			{
				errs['track'] = 'Please upload track';
				er = 1;			
			} 
		}
		
		if($('#album_image').attr('src') == '/si/placeholder.gif')
		{
			$('#image_err').removeClass('error').html( '' );
			errs['Image'] = 'Please upload image ' ;
			er = 1;
		}
		
		if($('#Price').is(':visible') || $("#PriceFree").is(':visible')) {
			var price = parseFloat($("#Price").val());
			//var PriceFree = $("#PriceFree").val();
			if($("#PriceFree").prop('checked') == false)
			{
				if( price<0.50 || isNaN(price))
				{
					
						errs['Price'] = 'Price must be greater then $0.50.';
						er = 1;
				}
			}
		}
        if (er)
        {
			
            oErrors.Show();
			
        } 
        else
        {
			/*
			if($('#Active').prop('checked') == false){
				if(!confirm('Are you sure you dont want to publish?'))
				{
					return;
				}
			}
			*/
            $('#album_form').submit();
        } 
        
    },
    
    
    EditVideo: function() {

        $('#err_Title, #err_Price, #VideoLink').html('');
        errs = {};  
        var er = 0;
        
        if (jQuery.trim($("#Title").val()) == "")
        {
            errs['Title'] = 'Please specify video title';
            er = 1;
        }
        if (jQuery.trim($("#VideoDate").val()) == "")
        {
            errs['VideoDate'] = 'Please specify release date';
            er = 1;
        }		
		if($('input[name=fm[VideoType]]:radio:checked').val() !=3)
		{
			var price = parseFloat($("#Price").val());
			
			if($("#PriceFree").prop('checked') == false)
			{			
				if (price<0.99)
				{
					errs['Price'] = 'Please add price or select free checkbox.';
					er = 1;
				}
			}
		}
		else
		{
			if ($("#VideoLink").val() == "")
			{
				errs['VideoLink'] = 'Please specify video link';
				er = 1;
			}
		}
		
        if (er)
        {
            oErrors.Show();
        } 
        else
        {
			if($("#Active").prop('checked') == false){
				
				//start			
				oProfile.videoDialogbox();	
				return;				
				//end
				/*
				if(!confirm('Are you sure you dont want to publish?'))
				{
					return;
				}
				*/
			}			
            $('#video_form').submit();
        }
             
    },
	videoDialogbox:function(){
		
		$("#dialog-video-publish").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Video Publish',
    	draggable: false,
	    width : 350,
		dialogClass: 'my-dialog',
	    //height : auto, 
	    resizable : false,
	    modal : true,
		buttons: {
		'Cancel' : {
				 "text":'Cancel', "class": 'button bgrey', "click": function() {
			 		$(this).dialog('close');
			 	}
			 },
		'Ok': {
				"text":'Ok', "class":'button wblue',  "click":function(){
				//deletePhotoAlbum();
				//oPopup.FreeAddTrackDialog();
				//$(this).dialog('close');	
	            $('#video_form').submit();				
				}
			}				
		}		
		});
		$("#dialog-video-publish").dialog("open");				

	    $("#dialog-video-publish").load('/Base/Popup/videoFocusPublish', function() {			 
		});			
    	$( "#dialog-video-publish" ).delegate(".reset_button", "click", function(){
         $( "#dialog-video-publish" ).dialog('close');
		});		
	
		
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
		if($("#Active").prop('checked') == false){
				//start			
				oProfile.videoDialogbox();	
				return;				
				//end
			
			/*
			if(!confirm('Are you sure you dont want to publish?'))
			{
				return;
			}
			*/
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

		$('#err_Title, #err_AlbumTitle, #err_Image, #err_Price').html('');
        errs = {};
        var er = 0;

		if(jQuery.trim($("#AlbumId").val()) == 0)
		{
            if(jQuery.trim($("#AlbumTitle").val()) == "")
            {
                errs['AlbumTitle'] = 'Please specify name for new album';
                er = 1;
            }			
		}
/*        if(jQuery.trim($("#PhotoDate").val()) == "")
        {
	            errs['PhotoDate'] = 'Please specify photo date';
                er = 1;
        }*/			
		if($('#photo_image').attr('src') == '/i/nophoto.jpg')
		{
			errs['Image'] = 'Please upload image ' ;
			er = 1;
		}
		var price = parseFloat($("#Price").val());
		if($("#PriceFree").prop('checked') == false)
		{
			if (price<0.99)
			{
				errs['Price'] = 'Please add price or select free checkbox.';
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

    EditSlide: function() {
		$('#err_Title, #err_Image').html('');
        errs = {};
        var er = 0;
		
		if($('#photo_image').attr('src') == '/i/nophoto.jpg')
		{
			errs['Image'] = 'Please upload image ' ;
			er = 1;
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

	 InitBuyAlbum: function(obj)
    {
        var imgsrc = $(obj).parent().parent().parent().find('img').attr('src');	
        imgsrc = imgsrc.replace('/x_', '/m_');
        var ttl = $(obj).parent().parent().find('.track_album a').html();
        var artist_url = $(obj).parent().parent().find('.artist').attr('src');
        var artist_band = $(obj).parent().parent().find('.artist').html();
        var artist_genres = $(obj).parent().parent().find('.artist').attr('genres');
		
        //oProfile.BuyAlbum( $(obj).attr('mid'), ttl, $(obj).attr('price'), $(obj).attr('tracks'), $(obj).attr('savings'), imgsrc, artist_url, artist_band, artist_genres, 1 );
		oProfile.buyalbumPlayer( $(obj).attr('mid'), ttl, $(obj).attr('price'), $(obj).attr('tracks'), $(obj).attr('savings'), imgsrc, artist_url, artist_band, artist_genres, 1 );	   		// something problem to show saving price 
    },
	buyalbumPlayer:function(id, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player)
	{		
		$("#MusicAlbum_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confirm your purchase',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});

		$("#MusicAlbum_Dialog").dialog("open");			
	    $("#MusicAlbum_Dialog").load('/Base/Popup/MusicAlbum/?id='+id, function() {});			
    	$( "#MusicAlbum_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#MusicAlbum_Dialog" ).dialog('close');
		});	
    	$( "#MusicAlbum_Dialog" ).delegate(".musicalbum_buy_btn", "click", function(){
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#MusicAlbum_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
			}else{
				var intRegex = /^\d+$/;
				var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
				var str = getprice;
				if(intRegex.test(str) || floatRegex.test(str)) {
					if(parseFloat(getprice)>=parseFloat(dialog_price)){
							doLoadP = 1;
							$( "#MusicAlbum_Dialog" ).find('.music_buy_btn').addClass('noactive');
							$( "#MusicAlbum_Dialog" ).find('.wait').show();
							$( "#MusicAlbum_Dialog" ).find('#music_success').html('').parent().hide();
							$( "#MusicAlbum_Dialog" ).find('#music_err').html('').parent().hide();
							var trackId		=	$( "#MusicAlbum_Dialog" ).find('#dialog_mid').val();
						    document.location = '/payment/music/'+trackId+'?payMore='+getprice;												
					} else {
							$( "#MusicAlbum_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#MusicAlbum_Dialog" ).find('#music_err').html('Only Numbers Allowed... :( ').parent().show();
					}
				
			}
			});
		
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
        window.opener.location.href='/payment/musicTrack/'+$(obj).attr('mid');
        self.close();		
	//	window.parent.document.location.href='payment/musicTrack/'+$(obj).attr('mid');
	//	parent.window.document.location = 'payment/musicTrack/'+$(obj).attr('mid');
    //  oProfile.BuyMusic( $(obj).attr('mid'), ttl, $(obj).attr('price'), imgsrc, artist_url, artist_band, artist_genres, 1 );
    },
	
    InitAddMusic: function(obj)
    {
		var imgsrc = ($(this).parent().parent().find('img').length > 0) ? $(obj).parent().parent().find('img').attr('src') : $(obj).parent().parent().parent().find('img').attr('src');
        imgsrc = imgsrc.replace('/x_', '/m_');
        var ttl = $(obj).parent().parent().find('.ttl').html();

        var artist_url = $(obj).parent().parent().find('.artist').attr('src');
        var artist_band = $(obj).parent().parent().find('.artist').html();
        var artist_genres = $(obj).parent().parent().find('.artist').attr('genres');				
        //oProfile.BuyMusic( $(obj).attr('mid'), ttl, $(obj).attr('price'), imgsrc, artist_url, artist_band, artist_genres, 1 );
        oProfile.addMusic( $(obj).attr('mid'), ttl, 0, imgsrc, '', $(obj).attr('artist_band'), $(obj).attr('artist_genres') );		

    },	
	
	/**
	* Get Popup for paymore in the player window By Lenin Kumar K	
	*/
    /**
     * Init purchase buttons
     */
    InitPurchase: function()
    {
    },

    /**
     * Init purchase buttons for guests
     */
    InitPurchaseForGuests: function()
    {
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
					checkResponseRedirect(data);
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
					checkResponseRedirect(data);
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
                    checkResponseRedirect(data);
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
						checkResponseRedirect(data);
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

			if(recording) {
				alert('Stop Recording to finish this broadcast');
				return false;
			}
			if (confirm('Do You wish to finish this broadcast?'))
            {
				oProfile.FinishEvent();
			}
			
        });
    },
	FinishEvent: function()
	{
               // var obj = $(this);
                //var id = $('.event_finish').attr('mid');
                var id = $('.Dialog_event_finish').attr('mid');				
				
				
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
                $('.event_finish').addClass('noactive');
                $('.event_finish').parent().find('.wait').show();

                $.ajax({
                    type:'POST',
                    dataType:'json',
                    data:{'id': id},
                    url:'/base/artist/EventFinish',
                    success:function (data)
                    {
						checkResponseRedirect(data);
                        doLoadP = 0;
                        $('.event_finish').removeClass('noactive');
                        $('.event_finish').parent().find('.wait').hide();
                        if (data.q == 'ok')
                        {
							//oProfile.ViewersReport(data.id, 0, 0);							
                            document.location = '/artist/events?event_finished=' + data.id+'&id='+data.id;
                        }
                    }
                });	
	},
	ViewersReport: function(id, ajaxMode, eFinish)
	{
		$.ajax({
			type:'POST',
			dataType:'json',
			data:'id='+id+'&ajaxMode='+ajaxMode+'&event_finished='+eFinish,
			url:'/artist/events',
			success:function(data)
			{	checkResponseRedirect(data);
				if(data.q=='ok')
				{
					$('#eventBroadcast').html('');
					$('#eventBroadcast').html(data.data);
					
				}
			}
		});
	},
	
	
	
	
	
	 BuyAlbum: function(id, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player)
    {
			
    
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
			
//             document.location = '/payment/checkOut/id?10&typess=454';
			       document.location = '/payment/music/'+id;
			
			return false;
			
        });
        $( "#buy_music_dialog" ).find('.reset_button').click(function() {
            $( "#buy_music_dialog" ).dialog('close');
        });

    },
	
    /**
     * Init event buttons for guest
     */
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
						checkResponseRedirect(data);
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
				checkResponseRedirect(data);
				
                $('#settings_form').find('.wait').hide();
                $('#settings_form').find('.button').removeClass('noactive');
                doLoadP = 0;
                if (data.q == 'ok')
                {
                    $('#pass_change').html('Your password changed successfully.');
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
	
MakePrimary: function(primary)
  {
	 // var mod = n == 1 ? 'artist' : 'fan';
	   var mod = 'user';
	$.ajax({
		type:'post',
		  url:'/base/' + mod + '/makePrimaryEmail',
		dataType: 'json',
		data: { 'email': primary},
		 success:function (data)
            {
				checkResponseRedirect(data);
                $('#add_email_form').find('.wait').hide();
                $('#add_email_form').find('.button').removeClass('noactive');
                doLoadP = 0;
                if (data.q == 'ok')
                {
					$('#changed_email').html(data.data);
                    $('#add_email').html('Your Email was make primary successfully.');
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
                           
                        }
                    }
                }
            }
	})
  },
  
 DelPrimary: function(delet)
  {
	  //var mod = n == 1 ? 'artist' : 'fan';
	  var mod = 'user';
	$.ajax({
		type:'post',
		  url:'/base/' + mod + '/removeEmail',
		dataType: 'json',
		data: { 'Delemail': delet},
		 success:function (data)
            {
				checkResponseRedirect(data);
                $('#add_email_form').find('.wait').hide();
                $('#add_email_form').find('.button').removeClass('noactive');
                doLoadP = 0;
                if (data.q == 'ok')
                {
					//alert(data.data);
					$('#changed_email').html(data.data);
                    $('#add_email').html('Your alt Email was deleted successfully.');
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
                           
                        }
                    }
                }
            }
	})
  },
		
    AddEmail: function(n)
    {
		var mod = n == 1 ? 'artist' : 'fan';

		settingEmail = $('#email').val();	
		
        $('.err').html('');
        $('#add_email').html('');
        $('#add_email').parent().hide();
		if(settingEmail != ''){

        var options = {
            type:'post',
            dataType:'json',
            clearForm:false,
            resetForm:false,
            url:'/' + mod + '/profile',
            beforeSubmit:function ()
            {
				//checkResponseRedirect(data);
				
                $('#add_email_form').find('.wait').show();
                //$('#add_email_form').find('.button').addClass('noactive');
            },
            success:function (data)
            {	checkResponseRedirect(data);
				$('#error_add_email').parent().hide();					
                $('#add_email_form').find('.wait').hide();

                if (data.q == 'ok')
                {
					$('#alt_email_div').hide();
					$('#alt_save_div').hide();					
					$('#changed_email').html(data.data);
                    $('#add_email').html('Your Email was added successfully.');
                    $('#add_email').parent().show();
                    $('#add_email_form input[type=text]').val('');
                }
                else
                {	
                    if (data.q= 'err')
                    {	
						$('#errorEmail').html(data.errs);																
						$("#errorEmail").dialog({
							autoOpen: false,
							position: 'center' ,
							title: 'Change Email Error',
							draggable: false,
							width : 570,
							//height : auto, 
							resizable : false,
							modal : true,
						});
						$("#errorEmail").dialog("open");
                    }
                }
            }
        };
		}
		else
		{ 
				$('#error_add_email').parent().show();	
			    $('#error_add_email').html('Please enter email id');
			 		  
		}
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
              checkResponseRedirect(data);
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
				checkResponseRedirect(data);
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

    CheckEventOnline: function(event_id, uid)
    {
		//alert("online ajx");
        $.ajax({
            type:'POST',
            dataType:'json',
            data:{'event_id': event_id, 'uid': uid},
            url:'/base/profile/CheckEventOnline',
            success:function (data)
            {
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
					if(data.online == 1)
                    {
                        window.location.reload();
                    } 
                }
            }
        });

        setTimeout("oProfile.CheckEventOnline('"+event_id+"', '"+uid+"');", 30000);
    },
	
	CheckEventFinish: function(event_id, uid )
    {
        $.ajax({
            type:'POST',
            dataType:'json',
            data:{'event_id': event_id, 'uid': uid},
            url:'/base/profile/CheckEventOnline',
            success:function (data)
            {
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
					if(data.eventFinish == 1)
                    {
						window.location.reload();
                    } 
					else 
					{
						setTimeout("oProfile.CheckEventFinish('"+event_id+"', '"+uid+"');", 30000);
					}
                } 
            }
        });
    },

    GetViewersCount: function(event_id, more)
    {
		//alert("get viewer amnd count");
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
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
                    var s = '';
                    $('#viewers_count').html(data.count);
                    for (var i in data.list)
                    {
                        s += '<li class="viewer" vid="'+data.list[i]['Id']+'">' +
                                  '<a href="#"><span class="imgTb"><img src="' + (data.list[i]['Avatar'] != '' ? subDomain+'images/avatars/x_' + data.list[i]['Avatar'] : '/i/ph/user-48x48.png') + '" width="48" height="48" alt="" align="center" /></span></a><span class="conTxt">'+(data.list[i]['Name']).substring(0,10)+'</span><div class="clear"></div></li>';
                    }
                   
                    $('.viewers_list').html(s);
                    
                    if(time == 0)
                    {
                        $('#runtime').attr('stime', data.time);
                    }
                    $('#runtime').html(data.length);
                }
                doLoadP = 0;
            }
        });
        if(tmv != 0)
        {
            //clearTimeout(tmv);
			window.clearInterval(tmv);
        }
        //tmv = setTimeout("oProfile.GetViewersCount('"+event_id+"');", 60000);
		tmv = window.setInterval(function(){oProfile.GetViewersCount(event_id);}, 60*1000);
		
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
				checkResponseRedirect(data);
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
				checkResponseRedirect(data);
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
	SlideLinkUser: function(user, user_id)
	{
		u_name = user;
		u_id = user_id;		
		$('#link').val('/u/'+u_name+'/');
		$('#s_media').val('');
		$('#media_type').show();		
	},
	SlideLinkFunction: function(type)
	{
		fun_name = type;
		switch(type)
		{
			case 'SlideLinkVideo':
								m_type = 'video';
								break;
			case 'SlideLinkMusic':
								m_type = 'music';
								break;	
			case 'SlideLinkEvent':
								m_type = 'events';
								break;
			case 'SlideLinkPhoto':
								m_type = 'photo';
								break;								
		}
		$('#link').val('/u/'+u_name+'/'+m_type);
		if(fun_name)
		oProfile.SlideLinkSelectMedia(fun_name);
	},	
   SlideLinkSelectMedia: function(m_type)
    {
        $('#wait').show();
        $.ajax({
            type:     'POST',
            dataType: 'json',    
			data: 	  "id="+u_id,
            url:      '/base/user/'+m_type,
            success: function (data)
            {	checkResponseRedirect(data);
                if (data.q == 'ok')
                {
					$('#SlideLinkSelected').html( data.data );	
				}
                $('#wait').hide();
            }
        });
    },	
	SlideFullLink: function(id)
	{
		$('#link').val('/u/'+u_name+'/'+m_type+'/'+id);
	},	
    DeleteAvatar: function()
    {
        if(!confirm('Do you really want to delete profile picture?'))
        {
            return;
        }
        $.ajax({
            type:     'POST',
            dataType: 'json',
            url:      '/base/user/deleteavatar',
            success: function (data)
            {
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
					$('#image_edit').attr('src', '/i/ph/user-48x48.png');
                    $('#deleted').addClass('good').html("Profile Picture Deleted Successfully");
                }
            }
        });
    },		
	genresEventList:function(genresList)
	{
		var eventTime = $('#df').val();
		var eventGenre = genresList;			
		$.ajax({
            type:     'POST',
            dataType: 'json',
			data: 	  "df="+eventTime+"&genresId="+eventGenre+"&ajx=1",
            url:      '/base/index/events',
			success: function (data)
            {
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
					$('#edefault').css('display','none');
					$('#eList').css('display','');					
					$('#eList').html(data.data);
                }
            }
		});
	},
	
	CheckAlbumUpload:function()
	{
		if($('#Type_Single').prop('checked'))
		{
			$('.TrackUpload').show();
			$('.albumTitle').hide();
			$('.MusicTitle').show();
		}
		else
		{
			$('.TrackUpload').hide();
			$('.MusicTitle').hide();
			$('.albumTitle').show();
		
		}
	},
	
	
	addAlbumBuyMusicDialogClear: function()
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
	
	MusicAlbumFinalStep: function(albumId)
	{
			//alert(albumId);
		if(albumId){
			$.ajax({
				type:     'POST',
				dataType: 'json',
				data: 	  { 'albumId' : albumId },
				url:      '/artist/MusicFinalStep',
				success: function (data)
				{
						checkResponseRedirect(data);
					if (data.q == 'ok')
					{
						$('#uploadTrack').html(data.data);
					}
				}
				});
			
			}		
		
	},
	
	SaveAlbum: function()
	{
		$('#err_Title', '#err_Descr', '#err_Price').removeClass('error').html('');
		
		errs = {};
		var er = 0;
		if (jQuery.trim($("#Title").val()) == "")
        {
            errs['Title'] = 'Please specify album title';
            er = 1;
        }
				
		var textLength =($("#Descr").val().length);
		if(textLength > 200)
		{
			errs['Descr'] = 'The Description should be not more than 200 characters';
			$('#err_DescrNotify').removeClass('error').html('');
			er = 1;
		}

		var price = parseFloat($("#Price").val());
		if(price)
		{
			eval("var stringvar=/^[+-]?[0-9]*(\\.[0-9]{0,5})?$/");
			
			if(!stringvar.test(price))
			{
					errs['Price'] = 'Price must be number!';
					er = 1;
			}			
			else if( price<0.50 || isNaN(price))
			{
				
					errs['Price'] = 'Price must be greater then $0.50.';
					er = 1;
			}
		}
		
        if (er)
        {
            oErrors.Show();
			
        } else {
			 var Id = $("#id").val();
			 var Title = $("#Title").val();
			 var Price = $("#Price").val();
			 var Descr = $("#Descr").val();
			 var Genre = $("#Genre").val();
			 var DateRelease = $("#DateRelease").val();
			 var AlbumDiscountPrice = $("#albumMaxPrice").val();
			 var AlbumPrice = $("#Price").val();
				$.ajax({
				type:     'POST',
				dataType: 'json',
				data: 	  {'Id' : Id, 'Title' : Title, 'Price' : Price, 'Genre' : Genre, 'DateRelease' : DateRelease ,'Descr' : Descr, 'AlbumDiscountPrice' : AlbumDiscountPrice, 'AlbumPrice' : AlbumPrice},
				url:      '/base/artist/SaveAlbumData',
				success: function (data)
				{
					checkResponseRedirect(data);
					if(data.Error == 'Album Name Already exist')
					{
						$('#err_Title').addClass('error').html(data.Error);
					}
					if(data.priceError == 'You are not allow to reduce the album price')
					{
							 $('#PriceAlert').dialog('open');
					}
					if (data.q == 'ok')
					{
						$('#EditMusic_Album').html(data.data);
						
					}
					
					
				}
				});
            
		}
       
    },
	
	
	 TrackUpdate: function() {	
        $('#err_Title, #err_track, #err_Price').html('');
		
        errs = {};  
        var er = 0;
        
        if (jQuery.trim($("#Title").val()) == "")
        {
            errs['Title'] = 'Please specify track title';
            er = 1;
        }
		
		var u_track = $('#track').html();		
		if(u_track == 'No file')
		{
            errs['track'] = 'Please upload track';
            er = 1;			
		} 
       
		var price = parseFloat($("#Price").val());
		if($('#PriceFree').prop('checked') || $('#PriceFree1').prop('checked')) {
			
		}
		else 
		{
			eval("var stringvar=/^[+-]?[0-9]*(\\.[0-9]{0,5})?$/");
			
			if(!stringvar.test(price))
			{
					errs['Price'] = 'Price must be number!';
					er = 1;
			}			
			else if( price<0.50 || isNaN(price))
			{
				
					errs['Price'] = 'Price must be greater then $0.50.';
					er = 1;
			}			
		}
        if (er)
        {
					
            oErrors.Show();
        } 
        else
        {
			var formData = $('#track_form').serialize();
			//var Genres = new String($('#Genre').val());
			var Genres = escape($('#Genre').val());
			
			console.log(formData);
			$.ajax({
				url: '/base/artist/SaveTrack?Genres='+Genres,
				type:'post',
				data: formData,// { 'formData': formData, 'Genres' : Genres },
				dataType:'json',
				success: function(response){
				checkResponseRedirect(response);
					$('#noTrack').hide();
					$('.trackRow').html('');
					$('.trackRow').append(response.message);
					$('#successTrack').show();
					if($('#musicId').val() == 0){ 
						$('#track_form')[0].reset();
						$('#track').html('No File');
						$('#track_preview').html('No File');
						$('#PriceFree1').prop('checked', false);
						$('#PriceFree').prop('checked', false);
						if($('#Price').val()> 0 || $('#PriceFree1').prop('checked')){
							$('#PriceFree').hide();
						}
					}
					$('#albumPrice').html(response.price);
					$('#trackCount').html(response.trackCount);
				}
			});
        }
             
    },
	
	
	UserFollowRemove:function(id)
	{
		if(!confirm('Do you really want to remove this user?'))
        {
            return;
        }
		if(id)
		{
				$.ajax({
				type:     'POST',
				dataType: 'json',
				data: 	  "delete_id="+id,
				url:      '/base/user/UserFollowRemove',
				success: function (data)
				{	checkResponseRedirect(data);
					if (data.q == 'ok')
					{
						$('#u_remove').show();
						$('#delUser_'+id).remove();	
					}
				}
				});
		}
	}
	
}

var tmv = 0;
var oProfile = new Profile();
doLoadP = 0;
