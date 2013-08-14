function Popup()
{

}


Popup.prototype =
{
    __construct:function ()
    {
        $(document).ready(function ()
        {

        });
    },	
	InitPurchase: function(){		
	 $("body").delegate(".commentAppend","click",function(){				
		oPopup.commentAppendinginFeed($(this).attr('wallreferId'),$(this).attr('wallId'),$(this).attr('start'),$(this).attr('commentTotals'),0);				
	  });		 
	 
	 $("body").delegate(".commentAppendinginFeed_Wall_One","click",function(){				
		oPopup.commentAppendinginFeed_Wall_One($(this).attr('wallreferId'),$(this).attr('wallId'),$(this).attr('start'),$(this).attr('commentTotals'),0);				
	  });		  
	 $("body").delegate(".dialogConfirmation","click",function(){							   									   
		oPopup.dialogConfirmation();
		});				
	 $("body").delegate(".share","click",function(){							   
		oPopup.Share_Dialog_Box($(this).attr('mid'),$(this).attr('albumtitle'));
		});
	 $("body").delegate(".shareVideo","click",function(){							   									
		oPopup.shareVideo($(this).attr('mid'),$(this).attr('albumtitle'));
		});		
	 $("body").delegate(".shareEvents","click",function(){							
		oPopup.shareEvents($(this).attr('mid'),$(this).attr('albumtitle'));
		});	
	 $("body").delegate(".fbShare","click",function(){																							
		oPopup.fbShare($(this).attr('RedirectUrl'),$(this).attr('fbLink'),$(this).attr('Picture'),$(this).attr('DialogTitle'),$(this).attr('Title'),$(this).attr('Description'));					

		});			
	 $("body").delegate(".commentAppendinginFeed","click",function(){
		oPopup.commentAppendinginFeed($(this).attr('mid'),$(this).attr('albumtitle'));
		});	
	//Bonus	 	 
	 $("body").delegate(".bonusalbum","click",function(){																	
			var imgsrc = '/'+$(this).attr('image');
            oPopup.BonusAlbum( $(this).attr('mid'), $(this).attr('filename') , $(this).attr('price'), $(this).attr('tracks'), $(this).attr('savings'), imgsrc, '', '', '' );
        });	 
	//Bonus	 
	 
	 $("body").delegate(".buy_albumTXT","click",function(){																	
			var imgsrc = '/'+$(this).attr('image');
            oPopup.MusicAlbum( $(this).attr('mid'), $(this).attr('filename') , $(this).attr('price'), $(this).attr('tracks'), $(this).attr('savings'), imgsrc, '', '', '' );
        });
	//Video 	
	 $("body").delegate(".paymore_buy_videoAJAXPOPUP","click",function(){														
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
            if(typeof imgsrc != "undefined" && imgsrc != null)
            {
                imgsrc = imgsrc.replace('/x_', '/m_');
            }
            else
            {
                imgsrc = '';
            }
			var GetImage	=	$(this).attr('Myimage');			
			var GetPrice	=	$(this).attr('Myprice');						
			if(GetPrice==0) 
			{
				imgsrc	=	"http://i.ytimg.com/vi/"+GetImage+"/0.jpg";
			}
			else
			{
				imgsrc	=	subDomain+"video/thumbnail/"+$(this).attr('UserId')+"/"+GetImage+".jpg";				
			}		

            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oPopup.BuyVideo( $(this).attr('mid'), ttl, $(this).attr('price'), imgsrc );
        
	});
	$('.photo_AJAXPOPUP').click(function() {			
        oPopup.BuyPhoto($(this).attr('pId'),$(this).attr('photoAlbumName'),$(this).attr('pUserId'),$(this).attr('url'),$(this).attr('photoId'),$(this).attr('photoPrice'),$(this).attr('artistName'),$(this).attr('title'),$(this).attr('image'));
		});
	$('.IndexVideos').click(function() {
	
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
            if(typeof imgsrc != "undefined" && imgsrc != null)
            {
                imgsrc = imgsrc.replace('/x_', '/m_');
            }
            else
            {
                imgsrc = '';
            }
			var GetImage	=	$(this).attr('Myimage');			
			var GetPrice	=	$(this).attr('Myprice');						
			if(GetPrice==0) 
			{
				imgsrc	=	"http://i.ytimg.com/vi/"+GetImage+"/0.jpg";
			}
			else
			{
				imgsrc	=	subDomain+"video/thumbnail/"+$(this).attr('UserId')+"/"+GetImage+".jpg";				
			}		

            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oPopup.IndexVideo( $(this).attr('userid'),$(this).attr('mid'), ttl, $(this).attr('price'), imgsrc );       
	
	});
	//index add video
		$('body').delegate('click',  '.Indexadd_video', function() {		
            
			var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
			
            if(typeof imgsrc != "undefined" && imgsrc != null)
            {
                imgsrc = imgsrc.replace('/x_', '/m_');
            }
            else
            {
                imgsrc = '';
            }
			var GetImage	=	$(this).attr('Myimage');
			var GetPrice	=	$(this).attr('Myprice');						
			if(GetPrice==0) 
			{
				imgsrc	=	"http://i.ytimg.com/vi/"+GetImage+"/0.jpg";
			}
			else
			{
				imgsrc	=	subDomain+"video/thumbnail/"+$(this).attr('UserId');+"/"+GetImage+".jpg";				
			}
			
            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oPopup.Indexadd_video( $(this).attr('userid'),$(this).attr('mid'), ttl, 0, imgsrc );
        });
	//Index Music 
	 $('.IndexMusic').click(function() {
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
			var imgsrc = '/'+$(this).attr('image');
            oPopup.IndexMusic( $(this).attr('mid'),$(this).attr('userid'), $(this).attr('filename') , $(this).attr('price'), $(this).attr('tracks'), $(this).attr('savings'), imgsrc, '', '', '' );        									 
		});	
	//IndexAddAlbum	 	
	 $('.IndexAddAlbum').click(function() {
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
			imgsrc = '/'+$(this).attr('image');        										
            oPopup.IndexAddAlbum( $(this).attr('mid'),$(this).attr('userid'),$(this).attr('filename'), 0, $(this).attr('tracks'), 0, imgsrc, '', '', '' );
		});		
	 // Free Dialog Popup
    $( "body" ).delegate(".Freeadd_album", "click", function(){										   
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
			imgsrc = subDomain+'track/images/'+$(this).attr('userid')+'/m_'+$(this).attr('image');
			oPopup.FreeAddAlbum( $(this).attr('mid'),$(this).attr('userid'),$(this).attr('filename'), 0, $(this).attr('tracks'), 0, imgsrc, '', '', '' );
        });
		$('body').on('click',  '.add_music', function() {
			var imgsrc = ($(this).attr('trackImage'));
            imgsrc = imgsrc.replace('/x_', '/m_');
            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oPopup.FreeAddMusic( $(this).attr('mid') );
        });
	//Free Video
		$('body').on('click',  '.nCadd_video', function() {		
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
            if(typeof imgsrc != "undefined" && imgsrc != null)
            {
                imgsrc = imgsrc.replace('/x_', '/m_');
            }
            else
            {
                imgsrc = '';
            }
			var GetImage	=	$(this).attr('Myimage');
			var GetPrice	=	$(this).attr('Myprice');						
			if(GetPrice==0) 
			{
				imgsrc	=	"http://i.ytimg.com/vi/"+GetImage+"/0.jpg";
			}
			else
			{
				imgsrc	=	subDomain+"video/thumbnail/"+$(this).attr('UserId');+"/"+GetImage+".jpg";				
			}
			
            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oPopup.ccBuyVideo( $(this).attr('mid'), ttl, 0, imgsrc );
        });			
		
	 
	//Events		
    $( "body" ).delegate(".BuyEvents", "click", function(){	
			var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
			if(!ttl && $('.ttl').length == 1)
            {
                ttl = $('.ttl').html();
            }
			var imgsrc = ($(this).parent().parent().find('.event-artist img').length > 0) ? $(this).parent().parent().find('.event-artist img').attr('src') : '';
			var artist_url = ($(this).parent().parent().find('.event-artist a').length > 0) ? $(this).parent().parent().find('.event-artist a').attr('href') : '';
			var artist_band = ($(this).parent().parent().find('.event-artist a').length > 0) ? $(this).parent().parent().find('.event-artist a').attr('title') : '';
			oPopup.BuyEvent( $(this).attr('mid'), ttl, $(this).attr('price'), imgsrc, artist_url, artist_band );
        
		});

	//IndexEvents
	 $('.IndexEvents').click(function() { 
			var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
			if(!ttl && $('.ttl').length == 1)
            {
                ttl = $('.ttl').html();
            }
			var imgsrc = ($(this).parent().parent().find('.event-artist img').length > 0) ? $(this).parent().parent().find('.event-artist img').attr('src') : '';
			var artist_url = ($(this).parent().parent().find('.event-artist a').length > 0) ? $(this).parent().parent().find('.event-artist a').attr('href') : '';
			var artist_band = ($(this).parent().parent().find('.event-artist a').length > 0) ? $(this).parent().parent().find('.event-artist a').attr('title') : '';
			oPopup.IndexEvents( $(this).attr('mid'),$(this).attr('userid'), ttl, $(this).attr('price'), imgsrc, artist_url, artist_band );
        
		});
	//Events	
	 $('.MailToViewers').click(function() { 
			var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
			if(!ttl && $('.ttl').length == 1)
            {
                ttl = $('.ttl').html();
            }
			var imgsrc = ($(this).parent().parent().find('.event-artist img').length > 0) ? $(this).parent().parent().find('.event-artist img').attr('src') : '';
			var artist_url = ($(this).parent().parent().find('.event-artist a').length > 0) ? $(this).parent().parent().find('.event-artist a').attr('href') : '';
			var artist_band = ($(this).parent().parent().find('.event-artist a').length > 0) ? $(this).parent().parent().find('.event-artist a').attr('title') : '';
			oPopup.MailToViewer( $(this).attr('mid'), ttl, imgsrc, artist_url, artist_band );
        
		});
	 
	



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
		oPopup.buyalbumPlayer( $(obj).attr('mid'), ttl, $(obj).attr('price'), $(obj).attr('tracks'), $(obj).attr('savings'), imgsrc, artist_url, artist_band, artist_genres, 1 );	   		// something problem to show saving price 
    },
	buyalbumPlayer:function(id, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player)
	{		
		$("#MusicAlbum_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confirm your purchase',
    	draggable: false,
	    width : 650,
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
				$( "#MusicAlbum_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
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
						    //document.location = '/payment/music/'+trackId+'?payMore='+getprice;	
							document.location = '/base/payment/checkOut/?id='+trackId+'&ptype=musicAlbum&payMore='+getprice;								
					} else {
							$( "#MusicAlbum_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#MusicAlbum_Dialog" ).find('#music_err').html('Only numbers allowed... :( ').parent().show();
					}
				
			}
			});
		
	},
	
	
	MusicTrack:function(id)
	{	
	$("#MusicTrack_Dialog").dialog({
    autoOpen: false,
    position: 'center' ,
    title: 'Please confirm your purchase',
    draggable: false,
    width : 650,
    //height : auto, 
    resizable : false,
    modal : true,
	});
	$("#MusicTrack_Dialog").dialog("open");		
    $("#MusicTrack_Dialog").load('/Base/Popup/MusicTrack/?id='+id, function() {});			
    $( "#MusicTrack_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#MusicTrack_Dialog" ).dialog('close');
	});		
    $( "#MusicTrack_Dialog" ).delegate(".music_buy_btn", "click", function(){
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#MusicTrack_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
			}else{
				var intRegex = /^\d+$/;
				var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
				var str = getprice;
				if(intRegex.test(str) || floatRegex.test(str)) {
					if(parseFloat(getprice)>=parseFloat(dialog_price)){
							doLoadP = 1;
							$( "#MusicTrack_Dialog" ).find('.music_buy_btn').addClass('noactive');
							$( "#MusicTrack_Dialog" ).find('.wait').show();
							$( "#MusicTrack_Dialog" ).find('#music_success').html('').parent().hide();
							$( "#MusicTrack_Dialog" ).find('#music_err').html('').parent().hide();
							var trackId		=	$( "#MusicTrack_Dialog" ).find('#dialog_mid').val();
							/*
							var Url  = window.location.hostname+'/payment/musicTrack/'+trackId+'?payMore='+getprice;
							window.open(Url,'_blank');	
*/
							window.opener.location.href = '/base/payment/checkOut/?id='+trackId+'&ptype=musicTrack&payMore='+getprice;
							//document.location = '/base/payment/checkOut/?id='+trackId+'&ptype=event&payMore='+getprice;							
							
					        self.close();							
							
					} else {
							$( "#MusicTrack_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#MusicTrack_Dialog" ).find('#music_err').html('Only numbers allowed... :( ').parent().show();
					}
				
			}

		
		
	});		
	
	
	},
	    InitAddMusic: function(obj,id)
    {
		var imgsrc = ($(this).parent().parent().find('img').length > 0) ? $(obj).parent().parent().find('img').attr('src') : $(obj).parent().parent().parent().find('img').attr('src');
        imgsrc = imgsrc.replace('/x_', '/m_');
        var ttl = $(obj).parent().parent().find('.ttl').html();

        var artist_url = $(obj).parent().parent().find('.artist').attr('src');
        var artist_band = $(obj).parent().parent().find('.artist').html();
        var artist_genres = $(obj).parent().parent().find('.artist').attr('genres');				
        //oProfile.BuyMusic( $(obj).attr('mid'), ttl, $(obj).attr('price'), imgsrc, artist_url, artist_band, artist_genres, 1 );
       // oPopup.addMusic( $(obj).attr('mid'), ttl, 0, imgsrc, '', $(obj).attr('artist_band'), $(obj).attr('artist_genres') );		
        oPopup.FreeAddMusic(id);
	   

    },	

	MusicTrackPlayer:function(id)
	{
	$("#MusicTrack_Dialog").dialog({
    autoOpen: false,
    position: 'center' ,
    title: 'Please confirm your purchase',
    draggable: false,
    width : 650,
    //height : auto, 
    resizable : false,
    modal : true,
	//	
	buttons: {
			'Cancel' : {
				 "text":'Cancel', "class": 'button bgrey', "click": function() {
			 		$(this).dialog('close');
			 	}
			 },
		'Checkout': {
				"text":'Checkout', "class":'button wblue music_buy_btn', "click":function(){
					var getprice		=	$("#getprice").val();
					var dialog_price	=	$("#dialog_price").val();
					var price			=	$("#price").val();										
					var dialog_mid		=	$( "#MusicTrack_Dialog" ).find('#dialog_mid').val();
					var trackId			=	$( "#MusicTrack_Dialog" ).find('#dialog_mid').val();
					oPopup.MusicTrackJqueryDialog(getprice,dialog_price,trackId);
					},
			}
			}
	//
	
	});

	
	$("#MusicTrack_Dialog").dialog("open");		
 //   $("#MusicTrack_Dialog").load('/Base/Popup/MusicTrack/?id='+id, function() {});			
		//start
	    $.getJSON('/Base/Popup/MusicTrack/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#MusicTrack_Dialog").html(response.message);
				}
				 
		});						
		//end
 
    
	$( "#MusicTrack_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#MusicTrack_Dialog" ).dialog('close');
	});		

	
	$( "#MusicTrack_Dialog" ).delegate(".music_buy_btnOLD", "click", function(){

		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice=='')
		{
				$( "#MusicTrack_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
		}
		else
		{
				var intRegex = /^\d+$/;
				var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
				var str = getprice;
				if(intRegex.test(str) || floatRegex.test(str)) 
				{
					if(parseFloat(getprice)>=parseFloat(dialog_price))
					{
							doLoadP = 1;
							$( "#MusicTrack_Dialog" ).find('.music_buy_btn').addClass('noactive');
							$( "#MusicTrack_Dialog" ).find('.wait').show();
							$( "#MusicTrack_Dialog" ).find('#music_success').html('').parent().hide();
							$( "#MusicTrack_Dialog" ).find('#music_err').html('').parent().hide();
							var trackId		=	$( "#MusicTrack_Dialog" ).find('#dialog_mid').val();
					        
							//window.location.href = '/payment/musicTrack/'+trackId+'?payMore='+getprice;						
							window.location.href = '/base/payment/checkOut/?id='+trackId+'&ptype=musicTrack&payMore='+getprice;							
							
					      

					} 
					else 
					{
							$( "#MusicTrack_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 					}

				}
				else
				{
						  $( "#MusicTrack_Dialog" ).find('#music_err').html('Only numbers allowed... :( ').parent().show();
				}
				
			}

		
		
	});			
			
	},
	MusicTrackJqueryDialog:function(getprice,dialog_price,trackId) {

		if(getprice=='')
		{
				$( "#MusicTrack_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
		}
		else
		{
				var intRegex = /^\d+$/;
				var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
				var str = getprice;
				if(intRegex.test(str) || floatRegex.test(str)) 
				{
					if(parseFloat(getprice)>=parseFloat(dialog_price))
					{
							doLoadP = 1;
							$( "#MusicTrack_Dialog" ).find('.music_buy_btn').addClass('noactive');
							$( "#MusicTrack_Dialog" ).find('.wait').show();
							$( "#MusicTrack_Dialog" ).find('#music_success').html('').parent().hide();
							$( "#MusicTrack_Dialog" ).find('#music_err').html('').parent().hide();
							var trackId		=	$( "#MusicTrack_Dialog" ).find('#dialog_mid').val();
					        
							//window.location.href = '/payment/musicTrack/'+trackId+'?payMore='+getprice;
							window.location.href = '/base/payment/checkOut/?id='+trackId+'&ptype=musicTrack&payMore='+getprice;							
							

					} 
					else 
					{
							$( "#MusicTrack_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 					}

				}
				else
				{
						  $( "#MusicTrack_Dialog" ).find('#music_err').html('Only numbers allowed... :( ').parent().show();
				}
				
			}
			},
	BonusAlbum:function(id, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player)
	{
			
		$("#MusicAlbum_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'You cannot buy bonus track separately! Buy entire album to get bonus track(s)',
    	draggable: false,
	    width : 650,
		height : 100, 
	    resizable : false,
	    modal : true,
		//	
		buttons: {
			'Cancel' : {
					 "text":'Cancel', "class": 'button bgrey', "click": function() {
						$(this).dialog('close');
					}
				 }
			
				}
		//
		
		});

		$("#MusicAlbum_Dialog").dialog("open");			
	    
		//$("#MusicAlbum_Dialog").load('/Base/Popup/MusicAlbum/?id='+id, function() {});			
		//start
		/*
	    $.getJSON('/Base/Popup/BonusAlbum/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#MusicAlbum_Dialog").html(response.message);
				}
				 
		});						
		*/
		//end
		
    	
		$( "#MusicAlbum_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#MusicAlbum_Dialog" ).dialog('close');
		});	
		
		
    	$( "#MusicAlbum_Dialog" ).delegate(".musicalbum_buy_btnOLD", "click", function(){
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#MusicAlbum_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
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
						    //document.location = '/payment/music/'+trackId+'?payMore='+getprice;												
							document.location = '/base/payment/checkOut/?id='+trackId+'&ptype=musicAlbum&payMore='+getprice;															
					} else {
							$( "#MusicAlbum_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#MusicAlbum_Dialog" ).find('#music_err').html('Only numbers allowed... :( ').parent().show();
					}
				
			}
			});
		
	},
	MusicAlbum:function(id, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player)
	{	
		$("#MusicAlbum_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confirm your purchase',
    	draggable: false,
	    width : 650,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		//	
		buttons: {
				'Cancel' : {
					 "text":'Cancel', "class": 'button bgrey', "click": function() {
						$(this).dialog('close');
					}
				 },
			'Checkout': {
					"text":'Checkout', "class":'button wblue musicalbum_buy_btn', "click":function(){						
						var getprice		=	$("#getprice").val();
						var dialog_price	=	$("#dialog_price").val();	
						var dialog_mid		=	$( "#MusicTrack_Dialog" ).find('#dialog_mid').val();
						var trackId			=	$( "#MusicTrack_Dialog" ).find('#dialog_mid').val();
						oPopup.MusicAlbumJqueryDialog(getprice,dialog_price,trackId);

						},
				}
				}
		//
		
		});

		$("#MusicAlbum_Dialog").dialog("open");			
	    
		//$("#MusicAlbum_Dialog").load('/Base/Popup/MusicAlbum/?id='+id, function() {});			
		//start
	    $.getJSON('/Base/Popup/MusicAlbum/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#MusicAlbum_Dialog").html(response.message);
				}
				 
		});						
		//end
		
    	
		$( "#MusicAlbum_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#MusicAlbum_Dialog" ).dialog('close');
		});	
		
		
    	$( "#MusicAlbum_Dialog" ).delegate(".musicalbum_buy_btnOLD", "click", function(){
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#MusicAlbum_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
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
						    //document.location = '/payment/music/'+trackId+'?payMore='+getprice;												
							document.location = '/base/payment/checkOut/?id='+trackId+'&ptype=musicAlbum&payMore='+getprice;															
					} else {
							$( "#MusicAlbum_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#MusicAlbum_Dialog" ).find('#music_err').html('Only numbers allowed... :( ').parent().show();
					}
				
			}
			});
		},
	MusicAlbumJqueryDialog:	function(getprice,dialog_price,dialog_mid) {		
		if(getprice==''){
				$( "#MusicAlbum_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
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
						    //document.location = '/payment/music/'+trackId+'?payMore='+getprice;												
							document.location = '/base/payment/checkOut/?id='+trackId+'&ptype=musicAlbum&payMore='+getprice;															
							
					} else {
							$( "#MusicAlbum_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#MusicAlbum_Dialog" ).find('#music_err').html('Only numbers allowed... :( ').parent().show();
					}
				
			}
					
		
		},
    ccBuyVideo: function(id, title, price, image)
    {
		$("#Video_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confirm your purchase',
    	draggable: false,
	    width : 650,
	    resizable : false,
	    modal : true,
		buttons: {
		'Cancel' : {
				 "text":'Cancel', "class": 'button bgrey', "click": function() {
			 		$(this).dialog('close');
			 	}
			 },
		'Add': {
				"text":'Add', "class":'button wblue',  "click":function(){	
					var id = $( "#Video_Dialog" ).find('#dialog_mid').val();					
					oPopup.IndexYoutubeAdd(id);
					}
			}}				
		
		});
		$("#Video_Dialog").dialog("open");				
	    
	    $.getJSON('/Base/Popup/addVideo/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#Video_Dialog").html(response.message);
				}
				 
		});						
    	$( "#Video_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Video_Dialog" ).dialog('close');
		});	
        



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
                            $( "#buy_video_dialog" ).find('#Video_AlbumImage').html('').parent().hide();
							/*
                            $( "#buy_video_dialog" ).find('#Video_AlbumTrackAuthor').html('').parent().hide();							
                            $( "#buy_video_dialog" ).find('#Video_Album_Buy').html('').parent().hide();									
							*/
                            $( "#add_success" ).css('display', 'block');
                            $( "#add_success" ).html('');	
							$( "#buy_video_dialog" ).find('#hideSuccess').css('display', 'none');
							$( "#buy_video_dialog" ).find('#hideSuccess').html('<input class="button reset_button" type="reset" value="Cancel">');								
							

							
							
							if(data.Status==1)
								{
                            document.location = '/fan/video?id='+$( "#buy_video_dialog" ).find('#dialog_vid').val();
								}
							if(data.Status==2)
								{
                            document.location = '/artist/video?id='+$( "#buy_video_dialog" ).find('#dialog_vid').val();
								}	
							/*
							$( "#buy_video_dialog" ).delay(2000);				
							$( "#buy_video_dialog" ).dialog('close');
							*/
							
								
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });


//		 document.location = '/payment/videopayment/'+ $( "#buy_video_dialog" ).find('#dialog_vid').val();

		

        });
        $( "#buy_video_dialog" ).find('.reset_button').click(function() {
            $( "#buy_video_dialog" ).dialog('close');
        });
    
	},		
	BuyVideo:function(id, title, price, image)
	{
		$("#buy_video_dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confirm your purchase',
    	draggable: false,
	    width : 650,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		buttons: {
		'Cancel' : {
				 "text":'Cancel', "class": 'button bgrey', "click": function() {
			 		$(this).dialog('close');
			 	}
			 },
		'CheckOut': {
				"text":'CheckOut', "class":'button wblue',  "click":function(){
					oPopup.VideoDialog();
					}
			}}				
		
		});
		$("#buy_video_dialog").dialog("open");				
	    //$("#buy_video_dialog").load('/Base/Popup/video/?id='+id, function() {});					
		//start
	    $.getJSON('/Base/Popup/video/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#buy_video_dialog").html(response.message);
				}
				 
		});						
		//end
		
		
    	$( "#buy_video_dialog" ).delegate(".reset_button", "click", function(){
         $( "#buy_video_dialog" ).dialog('close');
		});	
    	$( "#buy_video_dialog" ).delegate(".video_buy_btn", "click", function(){
																		  });
	},
	BuyPhoto:function(id,albumName,userId,url,photoId,photoPrice,artist_url,title,image)
	{
		$("#Photo_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confirm your purchase',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#Photo_Dialog").dialog("open");				
	   // $("#Photo_Dialog").load('/Base/Popup/photo/?id='+id, function() {});			
		//start
	    $.getJSON('/Base/Popup/photo/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#Photo_Dialog").html(response.message);
				}
				 
		});						
		//end		
	   
    	$( "#Photo_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Photo_Dialog" ).dialog('close');
		});	
    	$( "#Photo_Dialog" ).delegate(".photo_buy_btn", "click", function(){ 
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#Photo_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
			}else{
				var intRegex = /^\d+$/;
				var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
				var str = getprice;
				if(intRegex.test(str) || floatRegex.test(str)) {
					if(parseFloat(getprice)>=parseFloat(dialog_price)){
							doLoadP = 1;
							$( "#Photo_Dialog" ).find('.music_buy_btn').addClass('noactive');
							$( "#Photo_Dialog" ).find('.wait').show();
							$( "#Photo_Dialog" ).find('#music_success').html('').parent().hide();
							$( "#Photo_Dialog" ).find('#music_err').html('').parent().hide();
							var trackId		=	$( "#Photo_Dialog" ).find('#dialog_mid').val();
						    document.location = '/payment/photopayment/'+trackId+'?payMore='+getprice;												
					} else {
							$( "#Photo_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#Photo_Dialog" ).find('#music_err').html('Only numbers allowed... :( ').parent().show();
					}				
			}
			});
	},
	BuyEvent:function(id)
	{		
		$("#Event_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confirm your purchase',
    	draggable: false,
	    width : 650,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		buttons: {
		'Cancel' : {
				 "text":'Cancel', "class": 'button bgrey', "click": function() {
			 		$(this).dialog('close');
			 	}
			 },
		'CheckOut': {
				"text":'CheckOut', "class":'button wblue',  "click":function(){
				$('body').addClass('loading');
				oPopup.BuyEventDialog();
				}
			}				
		}
		});
		$("#Event_Dialog").dialog("open");				
	    //$("#Event_Dialog").load('/Base/Popup/Event/?id='+id, function() {});			
		//start
	    $.getJSON('/Base/Popup/Event/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#Event_Dialog").html(response.message);
				}
				 
		});						
		//end		

	
	},
	BuyEventDialog:function(){
 
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	$( "#Event_Dialog" ).find('#dialog_mid').val();	
		if(getprice==''){
				$( "#Event_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
			}else{
				var intRegex = /^\d+$/;
				var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
				var str = getprice;
				if(intRegex.test(str) || floatRegex.test(str)) {
					if(parseFloat(getprice)>=parseFloat(dialog_price)){
							doLoadP = 1;
							$( "#Event_Dialog" ).find('.music_buy_btn').addClass('noactive');
							$( "#Event_Dialog" ).find('.wait').show();
							$( "#Event_Dialog" ).find('#music_success').html('').parent().hide();
							$( "#Event_Dialog" ).find('#music_err').html('').parent().hide();
							var trackId		=	$( "#Event_Dialog" ).find('#dialog_mid').val();
						    //document.location = '/payment/eventpayment/'+trackId+'?payMore='+getprice;								
							document.location = '/base/payment/checkOut/?id='+trackId+'&ptype=event&payMore='+getprice;								
							
					} else {
							$( "#Event_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#Event_Dialog" ).find('#music_err').html('Only numbers allowed ! ').parent().show();
					}				
			}
					
		},
	MailToViewer:function(id)
	{
		var event_id =id;
		$( "#MailToViewer_Dialog" ).find('#subject_err').html('');
		$( "#MailToViewer_Dialog" ).find('#message_err').html('');		
		
	    $("#MailToViewer_Dialog").load('/Base/Popup/MailToViewer', function() {
		
			$("#MailToViewer_Dialog").dialog({
				autoOpen: false,
				position: 'center' ,
				title: 'Email to viewers ',
				draggable: false,
				width : 570,
				//height : auto, 
				resizable : false,
				dialogClass: 'mail-dialog',
				modal : true,
				buttons: {
					'Send' : {
						 "text":'Send', "class": 'button wblue', "click": function() {
						oPopup.MailSendDialog(event_id);
						}
					 },
					'Cancel' : {
						 "text":'Cancel', "class": 'button bgrey', "click": function() {
							$(this).dialog('close');
						}
					 }
					 
					}
				
				});
		
			$("#MailToViewer_Dialog").dialog("open");
		
		});			
    	$( "#MailToViewer_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#MailToViewer_Dialog" ).dialog('close');
		});	
	},
	MailSendDialog:function(event_id){

			var subject		=	$( "#MailToViewer_Dialog" ).find("#subject").val();
			var message	=	$( "#MailToViewer_Dialog" ).find("#message").val();	
			var er =0;

			$( "#MailToViewer_Dialog" ).find('#subject_err').html('').removeClass('error').hide();
			$( "#MailToViewer_Dialog" ).find('#message_err').html('').removeClass('error').hide();
			
			if(subject=='')
			{
				$( "#MailToViewer_Dialog" ).find('#subject_err').html('Please Type Subject').addClass('error').show();
				er = 1;
			}			
			if(message=='')
			{
				$( "#MailToViewer_Dialog" ).find('#message_err').html('Please Type Message').addClass('error').show();
				er = 1;			
			}
			
			if(!er)
			{
				$.ajax({
						type:'POST',
						dataType:'json',
						data:'id='+event_id+'&subject='+subject+'&message='+message,
						url:'/artist/mailtoviewers',
						success:function(data)
						{
							if(data.q=='ok')
							{
								if(data.data ==1)
								{	
									$('#mContent').hide();
									$( "#MailToViewer_Dialog" ).css('background-image', '');
									$( "#MailToViewer_Dialog" ).find('#mail_send').html('Your email has been sent.').parent().show();																
									$('.mail-dialog .wblue').text('Send').css('display','none');			
								}
								if(data.data ==2)
								{
									$( "#MailToViewer_Dialog" ).find('#mail_send').html('Email Not Send').parent().show();
								}
							}
						}
					});
			}
		 		
		},
	whatiscvv:function(){
		
		$(function() {
	   	$("#Whatiscvv_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Help::what is cvv ?',
    	draggable: false,
	    width : 360,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#Whatiscvv_Dialog").dialog("open");		
		  });

	},
	connect:function(id,status){
		$("#Connect_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Follow',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		dialogClass: 'my-dialog',
		buttons: {
			
		'Follow': {
				"text":'Follow', "class":'button wblue',  "click":function(){
				$('body').addClass('loading');
				var ConnectId	=	$("#Connect_Dialog").find("#ConnectId").val();
				var ConnectName	=	$("#Connect_Dialog").find("#ConnectName").val();
				var ConnectUrl	=	$("#Connect_Dialog").find("#ConnectUrl").val();				
				oUsers.ConnectFollow(ConnectId,ConnectName,ConnectUrl);				
				}
			}				
		}		
		});			
			
		
		$("#Connect_Dialog").dialog("open");	
		if(status == 2){
			$('.my-dialog .wblue').text('Connect');	
			$('.my-dialog .ui-dialog-title').text('Connect');
		} else {
			$('.my-dialog .wblue').text('Follow');	
			$('.my-dialog .ui-dialog-title').text('Follow');
			
		}
	    //$("#Connect_Dialog").load('/Base/Popup/connect/?id='+id, function() {});			
		//start
	    $.getJSON('/Base/Popup/connect/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#Connect_Dialog").html(response.message);
				}
				 
		});						
		//end		
    	/*$( "#Connect_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Connect_Dialog" ).dialog('close');
		});	*/
	},
	PlayerBuyMusicTrack:function(id){
		alert("im here");
		},
	connectinplayer:function(id,status){
		//start		
		$("#Connectinplayer_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Follow',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		dialogClass: 'my-dialog',
		buttons: {
			
		'Follow': {
				"text":'Follow', "class":'button wblue',  "click":function(){
				$('body').addClass('loading');
				var ConnectId	=	$("#Connectinplayer_Dialog").find("#ConnectId").val();
				var ConnectName	=	$("#Connectinplayer_Dialog").find("#ConnectName").val();
				var ConnectUrl	=	$("#Connectinplayer_Dialog").find("#ConnectUrl").val();				
				oUsers.ConnectFollow(ConnectId,ConnectName,ConnectUrl);				
				}
			}				
		}		
		});		
				
		$("#Connectinplayer_Dialog").dialog("open");	
		if(status == 2){
			$('.my-dialog .wblue').text('Connect');	
			$('.my-dialog .ui-dialog-title').text('Connect');
		} else {
			$('.my-dialog .wblue').text('Follow');	
			$('.my-dialog .ui-dialog-title').text('Follow');
			
		}
		//$("#Connectinplayer_Dialog").load('/Base/Popup/connectinplayer/?id='+id, function() {});			
		//start
	    $.getJSON('/Base/Popup/connectinplayer/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#Connectinplayer_Dialog").html(response.message);
				}
				 
		});						
		//end				
		
		//end
		/*
		$("#Connectinplayer_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Connect',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#Connectinplayer_Dialog").dialog("open");				
		$("#Connectinplayer_Dialog").load('/Base/Popup/connectinplayer/?id='+id, function() {});			
    	$( "#Connectinplayer_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Connectinplayer_Dialog" ).dialog('close');
		});	
		*/
	},
	connectinvideo:function(id,status){
		$("#connectinvideo_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Follow',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		dialogClass: 'my-dialog',
		buttons: {
			
		'Follow': {
				"text":'Follow', "class":'button wblue',  "click":function(){
				$('body').addClass('loading');
				var ConnectId	=	$("#connectinvideo_Dialog").find("#ConnectId").val();
				var ConnectName	=	$("#connectinvideo_Dialog").find("#ConnectName").val();
				var ConnectUrl	=	$("#connectinvideo_Dialog").find("#ConnectUrl").val();				
				oUsers.ConnectFollow(ConnectId,ConnectName,ConnectUrl);				
				}
			}				
		}		
		});			
			
		
		$("#connectinvideo_Dialog").dialog("open");	
		if(status == 2){
			$('.my-dialog .wblue').text('Connect');	
			$('.my-dialog .ui-dialog-title').text('Connect');
		} else {
			$('.my-dialog .wblue').text('Follow');	
			$('.my-dialog .ui-dialog-title').text('Follow');			
		}
		//$("#connectinvideo_Dialog").load('/Base/Popup/connectinvideo/?id='+id, function() {});			
		//start
	    $.getJSON('/Base/Popup/connectinvideo/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#connectinvideo_Dialog").html(response.message);
				}
				 
		});						
		//end				
		},
	connectinphoto:function(id){

		$("#connectinphoto_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Connect',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#connectinphoto_Dialog").dialog("open");				
//		$("#connectinphoto_Dialog").load('/Base/Popup/connectinphoto/?id='+id, function() {});			
		//start
	    $.getJSON('/Base/Popup/connectinphoto/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#connectinphoto_Dialog").html(response.message);
				}
				 
		});						
		//end				

    	$( "#connectinphoto_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#connectinphoto_Dialog" ).dialog('close');
		});				
		},
	connectinevent:function(id,status){

		$("#connectinevent_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Follow',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		dialogClass: 'my-dialog',
		buttons: {
			
		'Follow': {
				"text":'Follow', "class":'button wblue',  "click":function(){
				$('body').addClass('loading');
				var ConnectId	=	$("#connectinevent_Dialog").find("#ConnectId").val();
				var ConnectName	=	$("#connectinevent_Dialog").find("#ConnectName").val();
				var ConnectUrl	=	$("#connectinevent_Dialog").find("#ConnectUrl").val();				
				oUsers.ConnectFollow(ConnectId,ConnectName,ConnectUrl);				
				}
			}				
		}		
		});			
			
		
		$("#connectinevent_Dialog").dialog("open");	
		if(status == 2){
			$('.my-dialog .wblue').text('Connect');	
			$('.my-dialog .ui-dialog-title').text('Connect');
		} else {
			$('.my-dialog .wblue').text('Follow');	
			$('.my-dialog .ui-dialog-title').text('Follow');
			
		}
		//$("#connectinevent_Dialog").load('/Base/Popup/connectinevent/?id='+id, function() {});							
		//start
	    $.getJSON('/Base/Popup/connectinevent/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#connectinevent_Dialog").html(response.message);
				}
				 
		});						
		//end				
		
		},
	IndexVideo:function(userid,id, title, price, image){
		$("#Video_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confirm your purchase',
    	draggable: false,
	    width : 650,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#Video_Dialog").dialog("open");		
	    //$("#Video_Dialog").load('/Base/Popup/indexvideo/?userid='+userid+'&id='+id, function() {});			
		//start
	    $.getJSON('/Base/Popup/indexvideo/?userid='+userid+'&id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#Video_Dialog").html(response.message);
				}
				 
		});						
		//end		
    	$( "#Video_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Video_Dialog" ).dialog('close');
		});	
    	$( "#Video_Dialog" ).delegate(".video_buy_btn", "click", function(){ 
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#Video_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
			}else{
				var intRegex = /^\d+$/;
				var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
				var str = getprice;
				if(intRegex.test(str) || floatRegex.test(str)) {
					if(parseFloat(getprice)>=parseFloat(dialog_price)){
							doLoadP = 1;
							$( "#Video_Dialog" ).find('.music_buy_btn').addClass('noactive');
							$( "#Video_Dialog" ).find('.wait').show();
							$( "#Video_Dialog" ).find('#music_success').html('').parent().hide();
							$( "#Video_Dialog" ).find('#music_err').html('').parent().hide();
							var trackId		=	$( "#Video_Dialog" ).find('#dialog_mid').val();
						    //document.location = '/payment/videopayment/'+trackId+'?payMore='+getprice;	
							document.location = '/base/payment/checkOut/?id='+trackId+'&ptype=video&payMore='+getprice;							
					} else {
							$( "#Video_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#Video_Dialog" ).find('#music_err').html('Only numbers allowed... :( ').parent().show();
					}				
			}
			});		
		},
	Indexadd_video: function(userid,id, title, price, image){
		$("#Indexadd_video").dialog({
			autoOpen: false,
			position: 'center' ,
			title: 'Please confirm your purchase',
			draggable: false,
			width : 650,
			//height : auto, 
			resizable : false,
			modal : true,
		});
		$("#Indexadd_video").dialog("open");
		$( "#Indexadd_video" ).delegate(".reset_button", "click", function(){
         $( "#Indexadd_video" ).dialog('close');
		});	
    	$( "#Indexadd_video" ).delegate(".video_add_btn", "click", function(){});
	    //$("#Indexadd_video").load('/Base/Popup/indexaddvideo/?userid='+userid+'&id='+id, function() {});
		//start
	    $.getJSON('/Base/Popup/indexaddvideo/?userid='+userid+'&id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$( "#Indexadd_video" ).html(response.message);
				}
				 
		});						
		//end				
		},
		
	IndexYoutubeAdd:function(id)
		{		
            errs = {};
			var doLoadP = 0;
            if (doLoadP)
            {
                return false;
            }
            doLoadP = 1;
            $( "#Video_Dialog" ).find('.video_buy_btn').addClass('noactive');
            $( "#Video_Dialog" ).find('.wait').show();
            $( "#Video_Dialog" ).find('#video_success').html('').parent().hide();
            $( "#Video_Dialog" ).find('#video_err').html('').parent().hide();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{ 'id': id },
                url:'/base/profile/PurchaseVideo',
                success:function (data)
                {
                    doLoadP = 0;
                    $( "#Video_Dialog" ).find('.video_buy_btn').removeClass('noactive');
                    $( "#Video_Dialog" ).find('.wait').hide();
                    if (data.q == 'ok')
                    {
                        if(data.errs.length > 0)
                        {
                            errs = data.errs;
                            $( "#Video_Dialog" ).find( "#add_error" ).css('display', 'block');							
							$( "#Video_Dialog" ).find( "#add_error" ).addClass('error');
                            $( "#Video_Dialog" ).find( "#add_error" ).html('<b>Alert:</b> Video already added in your list');
							$( "#Video_Dialog" ).find( "#Indexadd_video" ).find('#hideSuccess').html('&nbsp;');
							//$( ".ui-dialog-buttonset .button wblue" ).css('display', 'block');
                        }
                        else
                        {							
                            $( "#Video_Dialog" ).find( "#add_success" ).css('display', 'block');
							$( "#Video_Dialog" ).find( "#add_success" ).addClass('good');							
                            $( "#Video_Dialog" ).find( "#add_success" ).html('<b>Success:</b> Video added in your list');													
							$( "#Video_Dialog" ).find('#hideSuccess').html('&nbsp;');								
							//$( ".ui-dialog-buttonset .button wblue " ).css('display', 'block');
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });

		},
	IndexMusic:function(id,userid, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player) {	
		$("#MusicAlbum_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confirm your purchase',
    	draggable: false,
	    width : 650,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#MusicAlbum_Dialog").dialog("open");		
	    //$("#MusicAlbum_Dialog").load('/Base/Popup/indexmusicalbum/?id='+id+'&userid='+userid, function() {});			
		//start
	    $.getJSON('/Base/Popup/indexmusicalbum/?id='+id+'&userid='+userid, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#MusicAlbum_Dialog").html(response.message);
				}
				 
		});						
		//end				
    	$( "#MusicAlbum_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#MusicAlbum_Dialog" ).dialog('close');
		});	
    	$( "#MusicAlbum_Dialog" ).delegate(".musicalbum_buy_btn", "click", function(){
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#MusicAlbum_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
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
						    //document.location = '/payment/music/'+trackId+'?payMore='+getprice;		
							document.location = '/base/payment/checkOut/?id='+trackId+'&ptype=musicAlbum&payMore='+getprice;															
					} else {
							$( "#MusicAlbum_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#MusicAlbum_Dialog" ).find('#music_err').html('Only numbers allowed... :( ').parent().show();
					}
				
			}
			});			

		},
	IndexAddAlbum:function(id,userid, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player){
		$("#IndexAddAlbum").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Free',
    	draggable: false,
	    width : 650,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#IndexAddAlbum").dialog("open");				
	   // $("#IndexAddAlbum").load('/Base/Popup/indexaddmusicalbum/?userid='+userid+'&id='+id, function() {});			
		//start
	    $.getJSON('/Base/Popup/indexaddmusicalbum/?userid='+userid+'&id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#IndexAddAlbum").html(response.message);
				}
				 
		});						
		//end			   
    	$( "#IndexAddAlbum" ).delegate(".reset_button", "click", function(){
         $( "#IndexAddAlbum" ).dialog('close');
		});	
    	$( "#IndexAddAlbum" ).delegate(".MusicAlbum_add_btn", "click", function(){		
		});						
	},
	// dialog popup free
	FreeAddAlbum:function(id,userid, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player){
		$("#IndexAddAlbum").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Free',
    	draggable: false,
	    width : 650,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		buttons: {
		'Cancel' : {
				 "text":'Cancel', "class": 'button bgrey', "click": function() {
			 		$(this).dialog('close');
			 	}
			 },
		'Add': {
				"text":'Add', "class":'button wblue',  "click":function(){
				$('body').addClass('loading');				
				oPopup.FreeIndexAddAlbumDialog();
				//$(this).dialog('close');				
				}
			}				
		}
		});
		$("#IndexAddAlbum").dialog("open");				
	    //$("#IndexAddAlbum").load('/Base/Popup/indexaddmusicalbum/?userid='+userid+'&id='+id, function() {});	
		//start
	    $.getJSON('/Base/Popup/indexaddmusicalbum/?userid='+userid+'&id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#IndexAddAlbum").html(response.message);
				}
				 
		});						
		//end				
		
    	$( "#IndexAddAlbum" ).delegate(".reset_button", "click", function(){
         $( "#IndexAddAlbum" ).dialog('close');
		});	
    	$( "#IndexAddAlbum" ).delegate(".MusicAlbum_add_btn", "click", function(){		
		});						
	},	
	FreeAddMusic:function(id){
		$("#IndexAddAlbum").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Free',
    	draggable: false,
	    width : 650,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		buttons: {
		'Cancel' : {
				 "text":'Cancel', "class": 'button bgrey', "click": function() {
			 		$(this).dialog('close');
			 	}
			 },
		'Add': {
				"text":'Add', "class":'button wblue',  "click":function(){
				$('body').addClass('loading');
				//deletePhotoAlbum();
				oPopup.FreeAddTrackDialog();

				$(this).dialog('close');				
				}
			}				
		}
		});
		$("#IndexAddAlbum").dialog("open");				
	    //$("#IndexAddAlbum").load('/Base/Popup/FreeMusicTrack/?id='+id, function() {});			
		//start
	    $.getJSON('/Base/Popup/FreeMusicTrack/?id='+id, function(response) {
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#IndexAddAlbum").html(response.message);
				}
				 
		});						
		//end		

    	$( "#IndexAddAlbum" ).delegate(".reset_button", "click", function(){
         $( "#IndexAddAlbum" ).dialog('close');
		});	
    	$( "#IndexAddAlbum" ).delegate(".MusicAlbum_add_btn", "click", function(){		
		});						
	},
	FreeAddTrackDialog:function() {

            errs = new Array();
            if (doLoadP)
            {
                return false;
            }

            doLoadP = 1;
            $( "#IndexAddAlbum" ).find('.music_buy_btn').addClass('noactive');
            $( "#IndexAddAlbum" ).find('.wait').show();
            $( "#IndexAddAlbum" ).find('#music_success').html('').parent().hide();
            $( "#IndexAddAlbum" ).find('#music_err').html('').parent().hide();
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': $( "#IndexAddAlbum" ).find('#dialog_mid').val()},
                url:'/base/profile/PurchaseMusic',
                success:function (data)
                {
                    doLoadP = 0;
                    $( "#IndexAddAlbum" ).find('.music_buy_btn').removeClass('noactive');
                    $( "#IndexAddAlbum" ).find('.wait').hide();
                    if (data.q == 'ok')
                    {
                        if(data.errs.length > 0)
                        {
                            errs = data.errs;
                            oErrors.ShowInOne('music_err');
                        }
                        else
                        {
                            $( "#IndexAddAlbum" ).find('#music_success').html('Track is Added').parent().show();
							var FFree = $( "#buy_music_dialog" ).find('#dialog_mid').val();
		                    $( "#FFree_"+FFree ).hide();	
							
							if(data.Download){
								window.location.href = data.Download;
							}
                            $( "#IndexAddAlbum" ).find('#hideSuccess').hide();							
                            if(in_player == 1)
                            {
                                var mid = $( "#IndexAddAlbum" ).find('#dialog_mid').val();
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
				//var trackId		=	$( "#buy_music_dialog" ).find('#dialog_mid').val();
			    //document.location = '/payment/musicTrack/'+trackId;
		
        		
		},
	FreeIndexAddAlbumDialog:function()	{	
            errs = new Array();
            if (doLoadP)
            {
                return false;
            }
            doLoadP = 1;
            $( "#IndexAddAlbum" ).find('.music_buy_btn').addClass('noactive');
            $( "#IndexAddAlbum" ).find('.wait').show();
            $( "#IndexAddAlbum" ).find('#music_success').html('').parent().hide();
            $( "#IndexAddAlbum" ).find('#music_err').html('').parent().hide();
			
//             document.location = '/payment/checkOut/id?10&typess=454';
			  //     document.location = '/payment/music/'+id;
			  
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': $( "#IndexAddAlbum" ).find('#dialog_mid').val()},
                url:'/base/profile/PurchaseAlbum',
                success:function (data)
                {
                    doLoadP = 0;
                    $( "#IndexAddAlbum" ).find('.music_buy_btn').removeClass('noactive');
                    $( "#IndexAddAlbum" ).find('.wait').hide();
                    if (data.q == 'ok')
                    {
                        if(data.errs.length > 0)
                        {
                            errs = data.errs;
                            oErrors.ShowInOne('music_err');
						   $( "#IndexAddAlbum" ).find('#add_success').html('<p class="error">The album has no songs</p>').show();														
                        }
                        else
                        {

                            $( "#IndexAddAlbum" ).find('#add_success').html('<p class="alert_success good">Album is Added</p>').show();										
							var MFreeId = $( "#IndexAddAlbum" ).find('#dialog_mid').val();														
							$("#MFree_"+MFreeId).removeClass();							
							$("#MFree_"+MFreeId).addClass("button wblue");																					
							$("#MFree_"+MFreeId).hide();							
							$("#UFree_"+MFreeId).show();														
							$("#UFree_"+MFreeId).addClass("button wblue");																												
							
							if(data.Download){
								window.location.href = data.Download;
							}

                            $( "#IndexAddAlbum" ).find('#hideSuccess').hide();							
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
                    else if(data.errs)
                    {
                     // document.location = '/base/user/login';
					  $( "#IndexAddAlbum" ).find('#add_success').html('<p class="error">The album has no songs</p>').show();							
                    }

                }
            });			  
			
			return false;
			
        
		},
		VideoDialog:function(){
				$('body').addClass('loading');
				//deletePhotoAlbum();
				//oPopup.FreeIndexAddAlbumDialog();
				//Start
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	$( "#Video_Dialog" ).find('#dialog_mid').val();	
		if(getprice==''){	
				$( "#buy_video_dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
			}else{
				var intRegex = /^\d+$/;
				var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
				var str = getprice;
				if(intRegex.test(str) || floatRegex.test(str)) {
					if(parseFloat(getprice)>=parseFloat(dialog_price)){
							doLoadP = 1;
							$( "#buy_video_dialog" ).find('.music_buy_btn').addClass('noactive');
							$( "#buy_video_dialog" ).find('.wait').show();
							$( "#buy_video_dialog" ).find('#music_success').html('').parent().hide();
							$( "#buy_video_dialog" ).find('#music_err').html('').parent().hide();
							var trackId		=	$( "#buy_video_dialog" ).find('#dialog_mid').val();
						    //document.location = '/payment/videopayment/'+trackId+'?payMore='+getprice;												
							document.location = '/base/payment/checkOut/?id='+trackId+'&ptype=video&payMore='+getprice;														
					} else {
							$( "#buy_video_dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#buy_video_dialog" ).find('#music_err').html('Only numbers allowed... :( ').parent().show();
					}				
			}
							
				//End
				$(this).dialog('close');				
							
			
			},
		
	IndexMusicAlbumPopup:function(id){

            errs = new Array();
            if (doLoadP)
            {
                return false;
            }
            doLoadP = 1;			
            $.ajax({
                type:'POST',
                dataType:'json',
                data:{ 'id': id },
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
                            $( "#add_error" ).css('display', 'block');							
							$( "#add_error" ).addClass('error');
                            $( "#add_error" ).html('<b>Alert:</b> Music Album already added in your list');			
							$( "#IndexAddAlbum" ).find('#hideSuccess').html('<input class="button reset_button"  type="reset" value="Close"  />');					
                        }
                        else
                        {							
                            $( "#add_success" ).css('display', 'block');
							$( "#add_success" ).addClass('alert_success good');							
                            $( "#add_success" ).html('<b>Success:</b> Music Album  added in your list');	
							$( "#IndexAddAlbum" ).find('#hideSuccess').html('<input class="button reset_button"  type="reset" value="Close"  />');
								
                        }
                    }
                    else if(data.q == 'err')
                    {
                        document.location = '/base/user/login';
                    }
                }
            });		  
			
			return false;		
        
		},
	IndexEvents:function(id,userid,status){
		$("#Event_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confirm your purchase',
    	draggable: false,
	    width : 650,
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
		'Checkout': {
				"text":'Checkout', "class":'button wblue',  "click":function(){
				$('body').addClass('loading');
					oPopup.IndexEventsDialog();		
				}
			}				
		}		
		});
		$("#Event_Dialog").dialog("open");				
	    $.getJSON('/Base/Popup/indexevent/?userid='+userid+'&id='+id, function(response) {
				 checkResponseRedirect(response);
				if(response.message){
			$("#Event_Dialog").html(response.message);
				}
			 if(response.button==3){
					$('.my-dialog .wblue').text('OK').css('display','none');	
					$('.my-dialog .ui-dialog-title').text('Sorry!');
					
					return;
					
					}
					
			if(!response.follow){					
				//$('.my-dialog .wblue').text('Connect');	
				//$('.my-dialog .ui-dialog-title').text('Connect');
				if(status == 2){
					$('.my-dialog .wblue').text('Connect');	
					$('.my-dialog .ui-dialog-title').text('Connect');
				} else if(status == 1) {
					$('.my-dialog .wblue').text('Follow');	
					$('.my-dialog .ui-dialog-title').text('Follow');					
				} 				
			}
		});			
    	$( "#Event_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Event_Dialog" ).dialog('close');
		});		
	
		},
		IndexEventsDialog:function()
		{ 
		if($('.my-dialog .wblue').text() == 'Connect' || $('.my-dialog .wblue').text() == 'Follow'){
			var ConnectId	=	$("#Event_Dialog").find("#ConnectId").val();
			var ConnectName	=	$("#Event_Dialog").find("#ConnectName").val();
			var ConnectUrl	=	$("#Event_Dialog").find("#ConnectUrl").val();				
			oUsers.ConnectFollow(ConnectId,ConnectName,ConnectUrl);				
			return;
		}
		
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	$( "#Event_Dialog" ).find('#dialog_mid').val();	
		if(getprice==''){
				$( "#Event_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
			}else{
				var intRegex = /^\d+$/;
				var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;							
				var str = getprice;
				if(intRegex.test(str) || floatRegex.test(str)) {
					if(parseFloat(getprice)>=parseFloat(dialog_price)){
							doLoadP = 1;
							$( "#Event_Dialog" ).find('.music_buy_btn').addClass('noactive');
							$( "#Event_Dialog" ).find('.wait').show();
							$( "#Event_Dialog" ).find('#music_success').html('').parent().hide();
							$( "#Event_Dialog" ).find('#music_err').html('').parent().hide();
							var trackId		=	$( "#Event_Dialog" ).find('#dialog_mid').val();
						    //document.location = '/payment/eventpayment/'+trackId+'?payMore='+getprice;	
							document.location = '/base/payment/checkOut/?id='+trackId+'&ptype=event&payMore='+getprice;															
					} else {
							$( "#Event_Dialog" ).find('#music_err').html('Please provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#Event_Dialog" ).find('#music_err').html('Only numbers allowed... :( ').parent().show();
					}				
			}
						
		},
		
		Share_Dialog_Box:function(id,shareTitle){
		$("#Share_Dialog_Box").dialog({
			autoOpen: false,
			position: 'center' ,
			title: 'Share Music',
			draggable: false,
			width : 600,
			height : 290,
			resizable : false,
			modal : true,
		});
		$("#Share_Dialog_Box").dialog("open");
		$("#Share_Dialog_Box").dialog("open");		
		$("#Share_Dialog_Box" ).delegate(".reset_button", "click", function(){
         $("#Share_Dialog_Box" ).dialog('close');
		});	
    	$("#Share_Dialog_Box" ).delegate(".video_add_btn", "click", function(){});		
/*	    $("#Share_Dialog_Box").load('/Base/Popup/share/?id='+id, function() {
		 try{
        	FB.XFBML.parse(); 
		    }catch(ex){}
																		  
		});			
*/	

		//start
	    $.getJSON('/Base/Popup/share/?id='+id, function(response) {

		 try{
        	FB.XFBML.parse(); 
		    }catch(ex){}
																		  
																
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#Share_Dialog_Box").html(response.message);
				}
				 
		});						
		//end				
			},
		shareVideo:function(id,shareTitle){
		$("#ShareVideo_Dialog_Box").dialog({
			autoOpen: false,
			position: 'center' ,
			title: 'Share Video',
			draggable: false,
			width : 650,
			resizable : false,
			modal : true,
		});
		$("#ShareVideo_Dialog_Box").dialog("open");
		$("#ShareVideo_Dialog_Box").dialog("open");		
		$("#ShareVideo_Dialog_Box").delegate(".reset_button", "click", function(){
         $("#ShareVideo_Dialog_Box").dialog('close');
		});	
    	$("#ShareVideo_Dialog_Box").delegate(".video_add_btn", "click", function(){});	
		
/*	    $("#ShareVideo_Dialog_Box").load('/Base/Popup/ShareVideo/?id='+id, function() {
		 try{
        	FB.XFBML.parse(); 
		    }catch(ex){}
																		  
		});	*/
		//start
	    $.getJSON('/Base/Popup/ShareVideo/?id='+id, function(response) {

		 try{
        	FB.XFBML.parse(); 
		    }catch(ex){}																	  
																
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#ShareVideo_Dialog_Box").html(response.message);
				}
				 
		});						
		//end		
		},
		shareEvents:function(id,shareTitle){
		
		$("#shareEvents_Dialog_Box").dialog({
			autoOpen: false,
			position: 'center' ,
			title: 'Share Event',
			draggable: false,
			width : 600,
			height : 290,
			resizable : false,
			modal : true,
		});
		$("#shareEvents_Dialog_Box").dialog("open");
		$("#shareEvents_Dialog_Box").dialog("open");		
		$("#shareEvents_Dialog_Box").delegate(".reset_button", "click", function(){
         $("#shareEvents_Dialog_Box").dialog('close');
		});	
    	$("#shareEvents_Dialog_Box").delegate(".video_add_btn", "click", function(){});		
/*	    $("#shareEvents_Dialog_Box").load('/Base/Popup/shareEvents/?id='+id, function() {
		 try{
        	FB.XFBML.parse(); 
		    }catch(ex){}
																		  
		});	
*/
		//start
	    $.getJSON('/Base/Popup/shareEvents/?id='+id, function(response) {

		 try{
        	FB.XFBML.parse(); 
		    }catch(ex){}																		  
																	  
				 checkResponseRedirect(response);																			   
			if(response.message){
			$("#shareEvents_Dialog_Box").html(response.message);
				}
				 
		});						
		//end		
			},
		fbShare:function(RedirectUrl,fbLink,Picture,DialogTitle,Title,Description){
			
			        var obj = {
          method: 'feed',
          redirect_uri: RedirectUrl,
          link: fbLink,
          picture: Picture,
          name: DialogTitle,
          caption: Title,
          description: Description
        };

        function callback(response) {
          document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
        }

        FB.ui(obj, callback);
      
			
			},
		commentAppendinginFeed:function(cmttype,wallId,start,limit,isFancyBox){		
            errs = new Array();         	
			//start
			var lateCmntId = $('#latestComment_'+wallId+' .commentsDisplay:first').attr('id').split('_')[1];
				$.ajax({
					 type:'POST',
					 dataType:'json',
					 data:{'cmttype':cmttype,'wallId': wallId, 'fancybox': isFancyBox ,'start':start,'limit':limit,'lateCmntId':lateCmntId},
					 url:'/base/profile/SeeMoreComments',
					 dataType: 'json',
					 success: function(data){
						 if (data.q == 'ok')
						{							
							/*
							if(isFancyBox){
								$('#popupComment_'+wallId).html('');
								$('#popupComment_'+wallId).html(data.fancyComment);
							} 
							*/								
							$('#latestComment_'+wallId).prepend(data.comment);
							$('#viewAll_'+wallId).hide();
							$('#popupviewAll_'+wallId).hide();							

						}
						else if(data.q == 'err')
						{
							$('#err_mesg').html( data.msg );
						}
					}
				})
						
			//end

		},
		commentAppendinginFeed_Wall_One:function(cmttype,wallId,start,limit,isFancyBox,Prepend){
            errs = new Array();    
			var lateCmntId = $('#popupComment_'+wallId+' .commentsDis:first').attr('id').split('_')[1];			
			//start				
				$.ajax({
					 type:'POST',
					 dataType:'json',
					 data:{'cmttype':cmttype,'wallId': wallId, 'fancybox': isFancyBox ,'start' : start ,'limit':limit,'lateCmntId':lateCmntId},
					 url:'/base/profile/SeeMoreWallComments',
					 dataType: 'json',
					 success: function(data){
						 if (data.q == 'ok')
						{							
							/*
							if(isFancyBox){
								$('#popupComment_'+wallId).html('');
								$('#popupComment_'+wallId).html(data.fancyComment);
							} 
							*/
							$('#popupComment_'+wallId).prepend(data.comment);
							$('#popupviewAll_'+wallId).hide();	
							if($('.storyContent div.slimScrollDiv').length == 0){
									box = $('.AlbumPOP').find('.scrollArea');
									divHeight = box.height();
									scrollHeight = $('#popBox .Lpic').height() - 100;
									if(divHeight >= scrollHeight){
										$(box).slimScroll({ height: scrollHeight });
										var curHeight = $('.slimScrollBar').css('height');
										$('.slimScrollBar').css({top: scrollHeight - curHeight});
									}
								}							

						}
						else if(data.q == 'err')
						{
							$('#err_mesg').html( data.msg );
						}
					}
				})
						
			//end

					
			},
	dialogConfirmation:function()
		{

		}
			
	
		
	}

var tm = 0;
var oPopup = new Popup();
doLoadP = 0;