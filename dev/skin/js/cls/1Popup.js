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
	$('.buy_albumTXT').click(function() {
            var imgsrc = ($(this).parent().find('img').length > 0) ? $(this).parent().find('img').attr('src') : $(this).parent().parent().find('img').attr('src');
			var imgsrc = '/'+$(this).attr('image');
            oPopup.MusicAlbum( $(this).attr('mid'), /*$(this).parent().find('.ttl').html()*/ $(this).attr('filename') , $(this).attr('price'), $(this).attr('tracks'), $(this).attr('savings'), imgsrc, '', '', '' );
        });
	//Video 
	$('.paymore_buy_videoAJAXPOPUP').click(function() {	
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
				imgsrc	=	"/files/video/thumbnail/"+$(this).attr('UserId')+"/"+GetImage+".jpg";				
			}		

            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oPopup.BuyVideo( $(this).attr('mid'), ttl, $(this).attr('price'), imgsrc );
        
	});
	//Photos	
	$('.photo_AJAXPOPUP').click(function() {			
        oPopup.BuyPhoto($(this).attr('pId'),$(this).attr('photoAlbumName'),$(this).attr('pUserId'),$(this).attr('url'),$(this).attr('photoId'),$(this).attr('photoPrice'),$(this).attr('artistName'),$(this).attr('title'),$(this).attr('image'));
		});
	//indexvideo
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
				imgsrc	=	"/files/video/thumbnail/"+$(this).attr('UserId')+"/"+GetImage+".jpg";				
			}		

            var ttl = ($(this).parent().find('.ttl').length > 0) ? $(this).parent().find('.ttl').html() : $(this).parent().parent().find('.ttl').html();
            oPopup.IndexVideo( $(this).attr('userid'),$(this).attr('mid'), ttl, $(this).attr('price'), imgsrc );       
	
	});
	//index add video
		$('body').on('click',  '.Indexadd_video', function() {		
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
				imgsrc	=	"/files/video/thumbnail/"+$(this).attr('UserId');+"/"+GetImage+".jpg";				
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
	//Events	
	 $('.BuyEvents').click(function() { 
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
	
	



	},
	MusicTrack:function(id)
	{	
    $("#MusicTrack_Dialog").load('/Base/Popup/MusicTrack/?id='+id, function() {
	$("#MusicTrack_Dialog").dialog({
    autoOpen: false,
    position: 'center' ,
    title: 'Please confrim your purchase',
    draggable: false,
    width : 570,
    //height : auto, 
    resizable : false,
    modal : true,
	});
	$("#MusicTrack_Dialog").dialog("open");
	});			
    $( "#MusicTrack_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#MusicTrack_Dialog" ).dialog('close');
	});		
    $( "#MusicTrack_Dialog" ).delegate(".music_buy_btn", "click", function(){
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#MusicTrack_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
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
						    document.location = '/payment/musicTrack/'+trackId+'?payMore='+getprice;							
					} else {
							$( "#MusicTrack_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#MusicTrack_Dialog" ).find('#music_err').html('Only Numbers Allowed... :( ').parent().show();
					}
				
			}

		
		
	});		
	
	
	},
	MusicTrackPlayer:function(id)
	{
	
    $("#MusicTrack_Dialog").load('/Base/Popup/MusicTrack/?id='+id, function() {
	$("#MusicTrack_Dialog").dialog({
    autoOpen: false,
    position: 'center' ,
    title: 'Please confrim your purchase',
    draggable: false,
    width : 570,
    //height : auto, 
    resizable : false,
    modal : true,
	});
	$("#MusicTrack_Dialog").dialog("open");
	});			
    $( "#MusicTrack_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#MusicTrack_Dialog" ).dialog('close');
	});		
    $( "#MusicTrack_Dialog" ).delegate(".music_buy_btn", "click", function(){
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#MusicTrack_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
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
					        window.opener.location.href='/payment/musicTrack/'+trackId+'?payMore='+getprice;
					        self.close();				

					} else {
							$( "#MusicTrack_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#MusicTrack_Dialog" ).find('#music_err').html('Only Numbers Allowed... :( ').parent().show();
					}
				
			}

		
		
	});			
			
	},
	MusicAlbum:function(id, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player)
	{	
	    $("#MusicAlbum_Dialog").load('/Base/Popup/MusicAlbum/?id='+id, function() {
		$("#MusicAlbum_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confrim your purchase',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#MusicAlbum_Dialog").dialog("open");
		});			
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
	BuyVideo:function(id, title, price, image)
	{
	    $("#Video_Dialog").load('/Base/Popup/video/?id='+id, function() {
		$("#Video_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confrim your purchase',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#Video_Dialog").dialog("open");
		});			
    	$( "#Video_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Video_Dialog" ).dialog('close');
		});	
    	$( "#Video_Dialog" ).delegate(".video_buy_btn", "click", function(){ 
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#Video_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
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
						    document.location = '/payment/videopayment/'+trackId+'?payMore='+getprice;												
					} else {
							$( "#Video_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#Video_Dialog" ).find('#music_err').html('Only Numbers Allowed... :( ').parent().show();
					}				
			}
			});
	},
	BuyPhoto:function(id,albumName,userId,url,photoId,photoPrice,artist_url,title,image)
	{
	    $("#Photo_Dialog").load('/Base/Popup/photo/?id='+id, function() {
		$("#Photo_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confrim your purchase',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#Photo_Dialog").dialog("open");
		});			
    	$( "#Photo_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Photo_Dialog" ).dialog('close');
		});	
    	$( "#Photo_Dialog" ).delegate(".photo_buy_btn", "click", function(){ 
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#Photo_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
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
							$( "#Photo_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#Photo_Dialog" ).find('#music_err').html('Only Numbers Allowed... :( ').parent().show();
					}				
			}
			});
	},
	BuyEvent:function(id)
	{
	    $("#Event_Dialog").load('/Base/Popup/Event/?id='+id, function() {
		$("#Event_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confrim your purchase',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#Event_Dialog").dialog("open");
		});			
    	$( "#Event_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Event_Dialog" ).dialog('close');
		});	
    	$( "#Event_Dialog" ).delegate(".event_buy_btn", "click", function(){ 
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#Event_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
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
						    document.location = '/payment/eventpayment/'+trackId+'?payMore='+getprice;												
					} else {
							$( "#Event_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#Event_Dialog" ).find('#music_err').html('Only Numbers Allowed... :( ').parent().show();
					}				
			}
			});
	
	},
	whatiscvv:function(){
		
		$(function() {
	   	$("#Whatiscvv_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Help::What Is Cvv ?',
    	draggable: false,
	    width : 360,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#Whatiscvv_Dialog").dialog("open");		
		  });

		},
	connect:function(id){
	    $("#Connect_Dialog").load('/Base/Popup/connect/?id='+id, function() {
		$("#Connect_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Connect',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#Connect_Dialog").dialog("open");
		});			
    	$( "#Connect_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Connect_Dialog" ).dialog('close');
		});	
	},
	connectinplayer:function(id){
		$("#Connectinplayer_Dialog").load('/Base/Popup/connectinplayer/?id='+id, function() {
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
		});			
    	$( "#Connectinplayer_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Connectinplayer_Dialog" ).dialog('close');
		});	
	},
	connectinvideo:function(id){
		$("#connectinvideo_Dialog").load('/Base/Popup/connectinvideo/?id='+id, function() {
		$("#connectinvideo_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Connect',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#connectinvideo_Dialog").dialog("open");
		});			
    	$( "#connectinvideo_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#connectinvideo_Dialog" ).dialog('close');
		});				
		},
	connectinphoto:function(id){
		$("#connectinphoto_Dialog").load('/Base/Popup/connectinphoto/?id='+id, function() {
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
		});			
    	$( "#connectinphoto_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#connectinphoto_Dialog" ).dialog('close');
		});				
		},
	connectinevent:function(id){
		$("#connectinevent_Dialog").load('/Base/Popup/connectinevent/?id='+id, function() {
		$("#connectinevent_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Connect',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#connectinevent_Dialog").dialog("open");
		});			
    	$( "#connectinevent_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#connectinevent_Dialog" ).dialog('close');
		});		
		},
	IndexVideo:function(userid,id, title, price, image){

	    $("#Video_Dialog").load('/Base/Popup/indexvideo/?userid='+userid+'&id='+id, function() {
		$("#Video_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confrim your purchase',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#Video_Dialog").dialog("open");
		});			
    	$( "#Video_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Video_Dialog" ).dialog('close');
		});	
    	$( "#Video_Dialog" ).delegate(".video_buy_btn", "click", function(){ 
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#Video_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
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
						    document.location = '/payment/videopayment/'+trackId+'?payMore='+getprice;												
					} else {
							$( "#Video_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#Video_Dialog" ).find('#music_err').html('Only Numbers Allowed... :( ').parent().show();
					}				
			}
			});		
		},
	Indexadd_video: function(userid,id, title, price, image){

	    $("#Indexadd_video").load('/Base/Popup/indexaddvideo/?userid='+userid+'&id='+id, function() {
		$("#Indexadd_video").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confrim your purchase',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#Indexadd_video").dialog("open");
		});			
    	$( "#Indexadd_video" ).delegate(".reset_button", "click", function(){
         $( "#Indexadd_video" ).dialog('close');
		});	
    	$( "#Indexadd_video" ).delegate(".video_add_btn", "click", function(){		
		});				
		},
	IndexYoutubeAdd:function(id)
		{
			
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
                data:{ 'id': id },
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
                            $( "#add_error" ).css('display', 'block');							
							$( "#add_error" ).addClass('alert alert_error');
                            $( "#add_error" ).html('<b>Alert:</b> Video already added in your list');							
                        }
                        else
                        {							
                            $( "#add_success" ).css('display', 'block');
							$( "#add_success" ).addClass('alert alert_success');							
                            $( "#add_success" ).html('<b>Success:</b> Video added in your list');
							/*
							if(data.Status==1)
								{
                            $( "#add_success" ).html('<a href=/fan/video?id='+id+'>more</a>');																
                            //document.location = '/fan/video?id='+$( "#buy_video_dialog" ).find('#dialog_vid').val();
								}
							if(data.Status==2)
								{
                            $( "#add_success" ).html('/artist/video?id='+id+'>more</a>');																
                            //document.location = '/artist/video?id='+$( "#buy_video_dialog" ).find('#dialog_vid').val();
								}
							*/	
								
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
	
	    $("#MusicAlbum_Dialog").load('/Base/Popup/indexmusicalbum/?id='+id+'&userid='+userid, function() {
		$("#MusicAlbum_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confrim your purchase',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#MusicAlbum_Dialog").dialog("open");
		});			
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
	IndexAddAlbum:function(id,userid, title, price, tracks, savings, image, artist_url, artist_band, atrist_genres, in_player){
	    $("#IndexAddAlbum").load('/Base/Popup/indexaddmusicalbum/?userid='+userid+'&id='+id, function() {
		$("#IndexAddAlbum").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Free',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#IndexAddAlbum").dialog("open");
		});			
    	$( "#IndexAddAlbum" ).delegate(".reset_button", "click", function(){
         $( "#IndexAddAlbum" ).dialog('close');
		});	
    	$( "#IndexAddAlbum" ).delegate(".MusicAlbum_add_btn", "click", function(){		
		});						
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
							$( "#add_error" ).addClass('alert alert_error');
                            $( "#add_error" ).html('<b>Alert:</b> Music Album already added in your list');							
                        }
                        else
                        {							
                            $( "#add_success" ).css('display', 'block');
							$( "#add_success" ).addClass('alert alert_success');							
                            $( "#add_success" ).html('<b>Success:</b> Music Album  added in your list');
								
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
	IndexEvents:function(id,userid){
	    $("#Event_Dialog").load('/Base/Popup/indexevent/?userid='+userid+'&id='+id, function() {
		$("#Event_Dialog").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Please confrim your purchase',
    	draggable: false,
	    width : 570,
	    //height : auto, 
	    resizable : false,
	    modal : true,
		});
		$("#Event_Dialog").dialog("open");
		});			
    	$( "#Event_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#Event_Dialog" ).dialog('close');
		});	
    	$( "#Event_Dialog" ).delegate(".event_buy_btn", "click", function(){ 
		var getprice		=	$("#getprice").val();
		var dialog_price	=	$("#dialog_price").val();		
		var dialog_mid		=	id;	
		if(getprice==''){
				$( "#Event_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();
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
						    document.location = '/payment/eventpayment/'+trackId+'?payMore='+getprice;												
					} else {
							$( "#Event_Dialog" ).find('#music_err').html('Please Provide price (i.e Enter  $'+dialog_price+' or more )').parent().show();																	 						  }

				}else{
						  $( "#Event_Dialog" ).find('#music_err').html('Only Numbers Allowed... :( ').parent().show();
					}				
			}
			});
	
	
		}	
	
		
	}

var tm = 0;
var oPopup = new Popup();
doLoadP = 0;