/**
 * PhotoEdit JS class
 * User: usawebsolution php team
 * Date: 19.01.2011
 * Time: 19:24:26
 *
 */

var show_login = 0;

function photoEdit()
{

}


photoEdit.prototype =
{
       __construct:function ()
    {
        $(document).ready(function ()
        {

        });
    },
	
	photoShow:function(){		
		$(".uplod-colu").slideDown("slow");	
		$(".uplod-colu").css('display','block');
		$(".belw").slideDown("slow");	
		$(".belw").css('display','block');
		$(".belwR").slideDown("slow");	
		$(".belwR").css('display','block');	
		$("#PhotoSuccess").css('display','none');					
		$("#err_Image").css('display','none');	
		var editagain = $("#editagain").val();						
		if(editagain){
			$("#editagain").val(1);					
			}				
		},
		
	albumEditPhotoIcon:function(albumCount)
	{
		//if(albumCount!=1){
		$(".belw").slideDown("slow");	
		$(".belw").css('display','block');
		$(".belwR").slideDown("slow");	
		$(".belwR").css('display','block');			
		//}else{		
		//$('#WarningConfirm').dialog("open");
		//$('#WarningConfirm').html("<p>You can't Remove the Cover Photo of this Album</p>");
		//}
	},
		
	TopAdd:function(AlbumId,AddAlbumTitle){
		$(document).load().scrollTop(0);
		$(".uplod-colu-ANO").css('display','none');
		$("#PhotoSuccess").css('display','none');				
		$("#err_Image").css('display','none');						
		$(".uplod-colu P10").css('display','block');								
		$(".uplod-colu-ANO").slideUp();	
		$("#AddAlbumId").val(AlbumId);	
		$("#AddAlbumTitle").val(AddAlbumTitle);		
		},	
		
	cancelalbumEdit:function(id,title)
		{		
			if(title.length>26){
			var AlbumshortText = jQuery.trim(title).substring(0, 25).split(" ").slice(0, -1).join(" ") + "...";
			}else{
			var AlbumshortText = title;	
				}
			$("#AlbumName_"+id).html(AlbumshortText);						

		},
	cancelPhotoEdit:function(id,title)
		{		
			$("#PhotoName_"+id).html(title);
		},
	ArtistAlbumEditShow:function()
	{	
		$(".uplod-colu").slideUp();	
		$(".uplod-colu-ANO").slideDown("slow");	
		$(".uplod-colu").css('display','none');			
		$(".uplod-colu-ANO").css('display','block');	
			$.ajax({
			   type: 'POST',
			   dataType:'JSON',
				url:'/artist/getAlbums',
				success: function(data)
				{
					checkResponseRedirect(data);
					if(data.q == 'ok')
					{
						//For artist photo album add
						$('#AlbumId').empty();
						$('#AlbumId').append('<option value="-1">No Album</option>');
						$('#AlbumId').append('<option value="0">New album</option>');
  

						$.each(data.album, function(key, value){
							if( value.Title != 'Banner Images' && value.Title != 'Profile Pictures')
							 $('#AlbumId').append($('<option value="'+value.Id+'">'+value.Title+'</option>'));
							
						});
					}
				}
			   
		});
	},
	AlbumEditShow:function()
	{	
		$(".uplod-colu").slideUp();	
		$(".uplod-colu-ANO").slideDown("slow");	
		$(".uplod-colu").css('display','none');			
		$(".uplod-colu-ANO").css('display','block');	
		
			$.ajax({
				   type: 'POST',
				   dataType:'JSON',
					url:'/fan/getAlbums',
					success: function(data)
					{
						checkResponseRedirect(data);
						if(data.q == 'ok')
						{
							//For fan photo album add 
							$('#AlbumId').empty();
							$('#AlbumId').append('<option value="-1">No Album</option>');
              				$('#AlbumId').append('<option value="0">New album</option>');

							$.each(data.album, function(key, value){
								if( value.Title != 'Banner Images' && value.Title != 'Profile Pictures')														
 									$('#AlbumId').append($('<option value="'+value.Id+'">'+value.Title+'</option>'));								
							});
						}
					}
				   
			});
		},
	CloseAlbumEditAndPhoto:function(){	
		$(".uplod-colu-ANO").css('display','none');
		$(".uplod-colu").css('display','none');		
		$("#PhotoSuccess").css('display','none');				
		$("#err_Image").css('display','none');	
		$("#Photoerror").css('display','none');					
		$(".uplod-colu-ANO").slideUp();			
		},
	PhotoAdd:function(){
		var AlbumTitle =	$.trim($("#AlbumTitle").val());	
		var AlbumDesc  =	$.trim($("#AlbumDesc").val());						
		var photoImage =    $('#photo_image').attr('src');
		var id = $('#AlbumId').val();
		var rand_id = $('#rand_id').val();
		

		
		if(id==0){
			if(AlbumTitle==''){
				
				$("#Photoerror").html('Please enter photo title');
				$("#Photoerror").slideDown("slow");	
				$("#Photoerror").css('display','block');							
				return false;				
				}
			}
		if (AlbumDesc=='')	
			{
				$("#Photoerror").html('Please enter photo description');
				$("#Photoerror").slideDown("slow");	
				$("#Photoerror").css('display','block');							
				return false;
			}
		else if	(photoImage=='')
			{
				$("#Photoerror").html('Please upload image');
				$("#Photoerror").slideDown("slow");	
				$("#Photoerror").css('display','block');							
				return false;

			}
		else 
			{
				
				$("#PhotoLoading").html('Please wait...');
				$("#PhotoLoading").slideDown("slow");	
				$("#PhotoLoading").css('display','block');	
				$("#err_Image").css('display','none');		
				$("#Photoerror").css('display','none');						
				$("#Photoerror").val('');						
				
				$.ajax({
					 type:'POST',
					 dataType:'json',
					 data:{'AlbumTitle':AlbumTitle,'AlbumDesc': AlbumDesc, 'photoImage':photoImage,'id':id,'rand_id':rand_id },
					 url:'/artist/addPhotoNewAjax',
					 dataType: 'json',
					 success: function(data)
					 {
						 checkResponseRedirect(data);
						 if (data.q == 'ok')
						{	
							$("#err_Image").css('display','none');																				
							$("#PhotoLoading").css('display','none');													
							$("#PhotoSuccess").html('Photo uploaded...');
							$("#PhotoSuccess").slideDown("slow");	
							$("#PhotoSuccess").css('display','block');	
							$(".uplod-colu-ANO").slideUp();	
							$(".PhotoSuccess").css('display','none');							
							$('#photoid_'+id).attr('src', subDomain+'photo/thumbs/'+data.UserId+'/'+data.PhotoName+'');
							$("#AlbumTitle").val("");
							$("#AlbumDesc").val("");							 
							$("#totAlb").html(data.totAlb);
							$("#totPhoto").html(data.totPhoto);
							
							$('#Photoerror').html('');
							
							
							if(data.existing)
							{
								$("#PhotoSuccess").css('display','none');									
								$("#err_Image").css('display','block');																												
								$("#err_Image").html(data.existing);		
								$("#err_Image").addClass("red");
								$("#AlbumId option:selected").val(0);															
								$('#editagain').val("1");
								
								
							}
							else
							{
								if(AlbumTitle)
								{
									$("#recentPhotoAdded").css('display','block');	
									$("#recentPhotoAdded").html(data.AppendNewAlbum);	
									$("#NoPhotoAlbums").css('display','none');									
									
								}
							}
							
						}
						else if(data.q == 'err')
						{
								$('#err_mesg').html( data.msg );
						}
					}
				})
									
			}
		}	,
	PaginationAlbum:function(UserId,PageNum){
		
			if($(".pagination wait").is(':visible')) return;
			$(".pagination wait").show();
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': UserId, 'page': PageNum },				
                url:'/base/artist/photo',
                success:function (data)
                { checkResponseRedirect(data);
					$(".pagination wait").hide();
					$("#content").slideDown();							
					$("#content").append(data.data);				
					var spanedit = $(".belw").is(":visible");
					if(spanedit) {
								$(".belw").slideDown("slow");	
								$(".belw").css('display','block');
								$(".belwR").slideDown("slow");	
								$(".belwR").css('display','block');	
								$("#PhotoSuccess").css('display','none');											
						}
					if(data.page > 0) {
						$(".pagination").html('<a href="javascript:void(0);" onclick="oPhotoEdit.PaginationAlbum('+UserId+','+data.page+')" >See More Photos</a>'); 												
					} else  {
						$(".pagination").hide();
					}
				}
            });				
			

		
		},
	PaginationShowFanAlbumPhotos:function(Id,UserId,UserName,PageNum){
		
			if($(".pagination wait").is(':visible')) return;
			$(".pagination wait").show();
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'UserId': UserId, 'page': PageNum },				
                url:'/u/'+UserName+'/photo?id='+Id,
                success:function (data)
                {	checkResponseRedirect(data);
					$(".pagination wait").hide();
					$("#content").slideDown();							
					$("#content").append(data.data);				
					var spanedit = $(".belw").is(":visible");
					if(spanedit) {
								$(".belw").slideDown("slow");	
								$(".belw").css('display','block');
								$(".belwR").slideDown("slow");	
								$(".belwR").css('display','block');	
								$("#PhotoSuccess").css('display','none');											
						}
					if(data.page > 0) {
						$(".pagination").html('<div class="clear"></div><a href="javascript:void(0);" onclick="oPhotoEdit.PaginationShowFanAlbumPhotos('+UserId+','+data.page+')" >See More Photo Albums</a>'); 												
					} else  {
						$(".pagination").hide();
					}
				}
            });				
		},
	PaginationShowArtistAlbum:	function(UserId,UserName,PageNum){
		
			if($(".pagination wait").is(':visible')) return;
			$(".pagination wait").show();
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'UserId': UserId, 'page': PageNum },				
                url:'/u/'+UserName+'/photo',
                success:function (data)
                {	checkResponseRedirect(data);
					$(".pagination wait").hide();
					$("#content").slideDown();							
					$("#content").append(data.data);				
					var spanedit = $(".belw").is(":visible");
					if(spanedit) {
								$(".belw").slideDown("slow");	
								$(".belw").css('display','block');
								$(".belwR").slideDown("slow");	
								$(".belwR").css('display','block');	
								$("#PhotoSuccess").css('display','none');											
						}
					if(data.page > 0) {
						$(".pagination").html('<div class="clear"></div><a href="javascript:void(0);" onclick="oPhotoEdit.PaginationShowArtistAlbum('+UserId+',\''+UserName+'\','+data.page+')" >See More Photo Albums</a>'); 												
					} else  {
						$(".pagination").hide();
					}
				}
            });				
		},	
	PaginationShowFanAlbum:function(UserId,UserName,PageNum){
		
		
			if($(".pagination wait").is(':visible')) return;
			$(".pagination wait").show();
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'UserId': UserId, 'page': PageNum },				
                url:'/u/'+UserName+'/photo',
                success:function (data)
                {	checkResponseRedirect(data);
					$(".pagination wait").hide();
					$("#content").slideDown();							
					$("#content").append(data.data);				
					var spanedit = $(".belw").is(":visible");
					if(spanedit) {
								$(".belw").slideDown("slow");	
								$(".belw").css('display','block');
								$(".belwR").slideDown("slow");	
								$(".belwR").css('display','block');	
								$("#PhotoSuccess").css('display','none');											
						}
					if(data.page > 0) {
						$(".pagination").html('<div class="clear"></div><a href="javascript:void(0);" onclick="oPhotoEdit.PaginationShowFanAlbum('+UserId+','+data.Name+','+data.page+')" >See More Photo Albums</a>'); 												
					} else  {
						$(".pagination").hide();
					}
				}
            });				
		
		},
	paginationShowAllPhotos:function(UserId,PageNum){		
	
			if($(".pagination wait").is(':visible')) return;
			$(".pagination wait").show();
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': UserId, 'page': PageNum },				
                url:'/base/artist/showAllPhotosById',
                success:function (data)
                {	checkResponseRedirect(data);
					$(".pagination wait").hide();
					$("#content").slideDown();							
					$("#content").append(data.data);
					var spanedit = $(".belw").is(":visible");	
					if(spanedit) {
					$(".belw").slideDown("slow");	
					$(".belw").css('display','block');
					$(".belwR").slideDown("slow");	
					$(".belwR").css('display','block');	
					$("#PhotoSuccess").css('display','none');											
					}

					$('a[rel=group1]').each(function(){
						$(this).fancybox(wallFancySetting);
					});					
					if(data.page > 0) {
						$(".pagination").html('<a href="javascript:void(0);" onclick="oPhotoEdit.paginationShowAllPhotos('+UserId+','+data.page+')" >See More Photos</a>'); 												
					} else  {
						$(".pagination").hide();
					}
				}
            });	
				
		},
	paginationAlbumPhotos:function(AlbumId,PageNum){
				
			if($(".pagination wait").is(':visible')) return;
			$(".pagination wait").show();
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': AlbumId, 'page': PageNum },				
                url:'/base/artist/EditPhotoAlbum',
                success:function (data)
                {	checkResponseRedirect(data);
					$(".pagination wait").hide();
					$("#content").slideDown();	
					$("#content").append(data.data);
					var spanedit = $(".belw").is(":visible");	
					if(spanedit) {
					$(".belw").slideDown("slow");	
					$(".belw").css('display','block');
					$(".belwR").slideDown("slow");	
					$(".belwR").css('display','block');	
					$("#PhotoSuccess").css('display','none');											
					}	

					$('a[rel=group1]').each(function(){
						$(this).fancybox(wallFancySetting);
					});
					if(data.page > 0) {
						$(".pagination").html('<a href="javascript:void(0);" onclick="oPhotoEdit.paginationAlbumPhotos('+AlbumId+','+data.page+')" >See More Photos</a>'); 																		
					} else  {
						$(".pagination").hide();
					}
				}
            });				
				
		},
	paginationFanAlbumPhotos:function(AlbumId,PageNum){
		
			if($(".pagination wait").is(':visible')) return;
			$(".pagination wait").show();
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': AlbumId, 'page': PageNum },				
                url:'/base/Fan/EditPhotoAlbum',
                success:function (data)
                {	checkResponseRedirect(data);
					$(".pagination wait").hide();
					$("#content").slideDown();	
					$("#content").append(data.data);
					var spanedit = $(".belw").is(":visible");	
					if(spanedit) {
					$(".belw").slideDown("slow");	
					$(".belw").css('display','block');
					$(".belwR").slideDown("slow");	
					$(".belwR").css('display','block');	
					$("#PhotoSuccess").css('display','none');											
					}	

					$('a[rel=group1]').each(function(){
						$(this).fancybox(wallFancySetting);
					});
					if(data.page > 0) {
						$(".pagination").html('<a href="javascript:void(0);" onclick="oPhotoEdit.paginationFanAlbumPhotos('+AlbumId+','+data.page+')" >See More Photos</a>'); 																		
					} else  {
						$(".pagination").hide();
					}
				}
            });				
				
		},		
	albumNameEdit:function(id)
	{
		if(id)
		{
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': id},				
                url:'/artist/GetUpdatedPhotoTitleById',
                success:function (data)
                {
					checkResponseRedirect(data);
					$("#AlbumName_"+data.id).slideDown();		
					$("#AlbumName_"+data.id).append("<div class='editBox'><span class='block font12'>Edit Album Title</span>"+								 
								 "<span class='block font12'><input id='updateNewalbumNames' value='"+data.title+"' type='text' size='9' class='txtBox font12' /></span>"+
								 "<a href='javascript:void(0);' onclick='oPhotoEdit.UpdateArtistNewAlbumName("+data.id+");' class=' font12 saveTit RT pink' style='margin:0 5px;'>Save</a>"+
								 "<a href='javascript:void(0);' id='cancelAlbum_"+data.id+"' class='cancelAlbum font12 cancelTit RT black' title='"+data.title+"'>Cancel</a></div>");		
						
				}
            });				
				
		}
	},	
		
	UpdateArtistNewAlbumName:function(id)
		{
			$("#AlbumName_"+id).slideDown();					
			var title = $("#updateNewalbumNames").val();											
			//$("#AlbumName_"+id).html(title);									
			if(id){
				$("#PhotoLoading").html('Please wait...');
				$("#PhotoLoading").slideDown("slow");	
				$("#PhotoLoading").css('display','block');
				$('body').addClass('loading');
				$.ajax({
						type:'POST',
						dataType:'json',
						data:'id='+id+'&title='+title,
						url:'/artist/EditAjaxPhotoAlbum',
						success:function(data)
						{ checkResponseRedirect(data);
							$('body').removeClass('loading');
							if(data.q=='ok')
							{
							$("#PhotoLoading").css('display','none');													
							$("#PhotoSuccess").html('Successfully updated!');
							$("#PhotoSuccess").slideDown("slow");	
							$("#PhotoSuccess").css('display','block');
							
							$('.uplod-colu-ANO').hide();
							if(data.title.length>26)
							{
								var AlbumshortText = jQuery.trim(data.title).substring(0, 25).split(" ").slice(0, -1).join(" ") + "...";
							}
							else
							{
								var AlbumshortText = data.title;	
							}
							
							$("#AlbumName_"+id).html(AlbumshortText);																	
							
							
							}
						}
					});				
				}
		},
		
		FanUpdateNewPhotoName:function(id)
		{
			
			$("#PhotoName_"+id).slideDown();					
			var title = $("#updateNewPhotoName").val();	
			$("#PhotoName_"+id).html('<p style="padding:0 5px;" id="PhotoName_"'+id+' >'+title+'</p>');
			if(id){
				$("#PhotoLoading").html('Please wait...');
				$("#PhotoLoading").slideDown("slow");	
				$("#PhotoLoading").css('display','block');
				$.ajax({
						type:'POST',
						dataType:'json',
						data:'id='+id+'&title='+title,
						url:'/fan/EditAjaxPhotoName',
						success:function(data)
						{	checkResponseRedirect(data);
							if(data.q=='ok')
							{
							$("#PhotoLoading").css('display','none');													
							$("#PhotoSuccess").html('Successfully updated!');
							$("#PhotoSuccess").slideDown("slow");	
							$("#PhotoSuccess").css('display','block');								
								
							}
						}
					});				
				}
		},
		
		
		FanPhotoAdd:function()
		{
			var AlbumTitle =	$.trim($("#AlbumTitle").val());								
			var AlbumDesc  =	$.trim($("#AlbumDesc").val());						
			var photoImage =    $('#photo_image').attr('src');
			var id = $('#AlbumId').val();
			var rand_id = $('#rand_id').val();

			if(id == 0)
			{
				if(AlbumTitle=='')
				{
					$("#Photoerror").html('Please enter photo title');
					$("#Photoerror").slideDown("slow");	
					$("#Photoerror").css('display','block');							
					return false;				
				}
			}		
			if (AlbumDesc=='')	
			{
					$("#Photoerror").html('Please enter photo description');
					$("#Photoerror").slideDown("slow");	
					$("#Photoerror").css('display','block');							
					return false;
			}
			else if	(photoImage=='')
			{
					$("#Photoerror").html('Please upload photo');
					$("#Photoerror").slideDown("slow");	
					$("#Photoerror").css('display','block');							
					return false;
	
			}
			else 
			{		
					$("#PhotoLoading").html('Please wait...');
					$("#PhotoLoading").slideDown("slow");	
					$("#PhotoLoading").css('display','block');	
					$("#err_Image").css('display','none');				
					$.ajax({
						 type:'POST',
						 dataType:'json',
						 data:{'AlbumTitle':AlbumTitle,'AlbumDesc': AlbumDesc, 'photoImage':photoImage,'id':id,'rand_id':rand_id },
						 url:'/fan/addPhotoNewAjax',
						 dataType: 'json',
						 success: function(data)
						 {
							 checkResponseRedirect(data);
							if (data.q == 'ok')
							{	
								$("#err_Image").css('display','none');																				
								$("#PhotoLoading").css('display','none');													
								$("#PhotoSuccess").html('Photo uploaded...');
								$("#PhotoSuccess").slideDown("slow");	
								$("#PhotoSuccess").css('display','block');	
								$(".uplod-colu-ANO").slideUp();	
								$(".PhotoSuccess").css('display','none');
								$('#photoid_'+id).attr('src', subDomain+'photo/thumbs/'+data.UserId+'/'+data.PhotoName+'');
								$("#AlbumTitle").val("");
								$("#AlbumDesc").val("");
								$("#totAlb").html(data.totAlb);
								$("#totPhoto").html(data.totPhoto);							
								$('#Photoerror').html('');
								
								if(data.existing)
								{
									$("#PhotoSuccess").css('display','none');									
									$("#err_Image").css('display','block');																												
									$("#err_Image").html(data.existing);		
									$("#err_Image").addClass("red");
									$("#AlbumId option:selected").val(0);															
									$('#editagain').val("1");
								}							
								if(AlbumTitle)
								{
									$("#recentPhotoAdded").css('display','block');	
									
									$("#content").html(data.newContent);
									
									$("#recentPhotoAdded").html(data.AppendNewAlbum);	
									
									//$("#AlbumId option:selected").val(0);		
									
									var newOption = $('<option value="'+data.AlbumId+'">'+data.AlbumTitle+'</option>');
 									$('#AlbumId').append(newOption);
 
									$("#NoPhotoAlbums").css('display','none');									
									
								}
							}
							else if(data.q == 'err')
							{
								$('#err_mesg').html( data.msg );
							}
						}
					})
										
				}
		},
		
		FanPhotoAlbumRemove:function(id)
		{	
		  var didConfirm = confirm("Are you sure?");
		  if (didConfirm == true) {					  	
				$.ajax({
						type:'POST',
						dataType:'json',
						data:'id='+id,
						url:'/fan/RemovePhotoAlbum?id='+id,
						success:function(data)
						{	checkResponseRedirect(data);
							$("#totAlb").html(data.totAlb);
							$("#totPhoto").html(data.totPhoto);
							if(data.q =='ok')
							{
								$("#PhotoAlbums_"+id).hide();
								$("#PhotoAlbums_"+id).slideUp();	
							}
						}
					});							
		  }
		
		},
		FanPaginationShowFanAllPhoto:function(UserId, UserName, PageNum) {
	
		
			if($(".pagination wait").is(':visible')) return;
			$(".pagination wait").show();
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'UserId': UserId, 'page': PageNum },				
                url:'/u/'+UserName+'/photo?allPhoto=1',
                success:function (data)
                {	checkResponseRedirect(data);
					$(".pagination wait").hide();
					$("#content").slideDown();							
					$("#content").append(data.data);
					$('a[rel=group1]').each(function(){
						$(this).fancybox(wallFancySetting);
					});					
					if(data.page > 0) {
						$(".pagination").html('<a href="javascript:void(0);"					onclick="oPhotoEdit.FanPaginationShowFanAllPhoto('+UserId+',\''+$.trim(UserName)+'\','+data.page+')" >See More Photos</a>'); 												
					} else  {
						$(".pagination").hide();
					}
				}
            });	
				
		
		
			
		},		
		FanPaginationShowAllPhotos:function(UserId, PageNum)
		{	
			if($(".pagination wait").is(':visible')) return;
			$(".pagination wait").show();
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': UserId, 'page': PageNum },				
                url:'/base/fan/showAllPhotosById',
                success:function (data)
                {	checkResponseRedirect(data);
					$(".pagination wait").hide();
					$("#content").slideDown();							
					$("#content").append(data.data);
					var spanedit = $(".belw").is(":visible");
					if(spanedit) {
								$(".belw").slideDown("slow");	
								$(".belw").css('display','block');
								$(".belwR").slideDown("slow");	
								$(".belwR").css('display','block');	
								$("#PhotoSuccess").css('display','none');											
						}					
					$('a[rel=group1]').each(function(){
						$(this).fancybox(wallFancySetting);
					});										
					if(data.page > 0) {
					$(".pagination").html('<a href="javascript:void(0);" onclick="oPhotoEdit.FanPaginationShowAllPhotos('+UserId+','+data.page+')" >See More Photos</a>');
					} else  {
						$(".pagination").hide();
					}
				}
            });	
				
		},	
		
		FanPaginationShowAllAlbums:function(UserId, PageNum)
		{
			if($(".pagination wait").is(':visible')) return;
			$(".pagination wait").show();
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{'id': UserId, 'page': PageNum },				
                url:'/base/fan/Photo',
                success:function (data)
                {	checkResponseRedirect(data);
					$(".pagination wait").hide();
					$("#content").slideDown();							
					$("#content").append(data.data);
					$('a[rel=group1]').each(function(){
						$(this).fancybox(wallFancySetting);
					});										
					if(data.page > 0) {
					$(".pagination").html('<a href="javascript:void(0);" onclick="oPhotoEdit.FanPaginationShowAllAlbums('+UserId+','+data.page+')" >See More Albums</a>');
					} else  {
						$(".pagination").hide();
					}
				}
            });	
			
		},
		
		FanAlbumNameEdit:function(id){
			
			$("#AlbumName_"+id).slideDown();					
			title =  $("#AlbumName_"+id).html();
			
			$("#AlbumName_"+id).append("<div class='editBox'><span class='block font12'>Edit Album Title</span>"+								
								 "<span class='block font12'><input id='updateNewalbumNames' value='"+title+"' type='text' size='9' class='txtBox font12' /></span>"+
								 "<a href='javascript:void(0);' onclick='oPhotoEdit.updateNewAlbumName("+id+");' class=' font12 saveTit RT pink' style='margin:0 5px;'>Save</a>"+
								 "<a href='javascript:void(0);' id='cancelAlbum_"+id+"' class='cancelAlbum font12 cancelTit RT black' title='"+title+"'>Cancel</a></div>");
		},
		
		FanPhotoNameEdit:function(id,title){
		$("#PhotoName_"+id).slideDown();		
		$("#PhotoName_"+id).html("<div class='floatL' > <input id='updateNewPhotoName' value='"+title+"' type='text' size='9' /></div> <div class='floatR'> <a href='javascript:void(0);' onclick='oPhotoEdit.FanUpdateNewPhotoName("+id+");' style='font-size:11px'>Save</a>&nbsp; &nbsp;<a href='javascript:void(0);' id='cancelPhotoEdit_"+id+"' class='cancelPhotoEdit' title='"+title+"'style='font-size:11px'>Cancel</a> </div>");		
		},



	UserPhotoEdit:function(id,title)
	{		
		$("#MusicTrack_Dialog").dialog({
		autoOpen: false,
		position: 'center' ,
		title: 'Edit Photo',
		draggable: false,
		width : 800,
		//height : auto, 
		resizable : false,
		modal : true,
		buttons:{		
			'Cancel' : {
				 "text":'Cancel', "class": 'button bgrey', "click": function() {
			 		$(this).dialog('close');
			 	}
				 },
			'Save' : {
				 "text":'Save', "class": 'Save button wblue', "click": function() {
					//start

		var PhId			=	$("#PhId").val();		
		var title			=	$("#PhotoTitle").val();		
		var desc			=	$("#desc").val();				
		//var albumId			=	$("select#albumId").val();
		var albumId	=	$('#AlbumId').val();
		if(PhId)
			{
			//ajax  start			
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{ 'mode': true, 'id': PhId, 'albumId':albumId, 'title':title,'desc':desc },				
                url:'/Base/User/EditUserPhotoDetail',
                success:function (data)
                {
	     			$("#Msg").show();
					$("#Msg").slideUp();							
					$("#Msg").html("Successfully updated!");					
					setTimeout(function() {$("#MusicTrack_Dialog" ).dialog('close');},1000); //							
					         

				}
            });	

			//ajax end
			}
							
					//end
			 	}
				 },
				 
		
		}
	});
	$("#MusicTrack_Dialog").dialog("open");		
    $("#MusicTrack_Dialog").load('/Base/User/EditUserPhotoDetail/?id='+id, function() {});			
    $( "#MusicTrack_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#MusicTrack_Dialog" ).dialog('close');
	});		
    $( "#MusicTrack_Dialog" ).delegate(".Save", "click", function(){
		var PhId			=	$("#PhId").val();		
		var title			=	$("#PhotoTitle").val();		
		var desc			=	$("#desc").val();				
		//var albumId			=	$("select#albumId").val();
		var albumId	=	$('#AlbumId').val();
		if(PhId)
			{
			//ajax  start			
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{ 'mode': true, 'id': PhId, 'albumId':albumId, 'title':title,'desc':desc },				
                url:'/Base/User/EditUserPhotoDetail',
                success:function (data)
                {	checkResponseRedirect(data);
	     			$("#Msg").show();
					$("#Msg").slideUp();							
					$("#Msg").html("Successfully updated!");					
					setTimeout(function() {$("#MusicTrack_Dialog" ).dialog('close');},1000); //							
					         

				}
            });	

			//ajax end
			}
		});			
	
			
		},
		
	AlbumInPhotoEdit:function(id,title){				
	$("#MusicTrack_Dialog").dialog({
    autoOpen: false,
    position: 'center' ,
    title: 'Edit Photo',
    draggable: false,
    width : 800,
    //height : auto, 
    resizable : false,
    modal : true,
	});
	$("#MusicTrack_Dialog").dialog("open");		
    $("#MusicTrack_Dialog").load('/Base/Fan/EditAllPhotos/?id='+id, function() {});			
    $( "#MusicTrack_Dialog" ).delegate(".reset_button", "click", function(){
         $( "#MusicTrack_Dialog" ).dialog('close');
	});		
    $( "#MusicTrack_Dialog" ).delegate(".Save", "click", function(){
		var PhId			=	$("#PhId").val();		
		var title			=	$("#PhotoTitle").val();		
		var desc			=	$("#desc").val();				
		var albumId			=	$("select#albumId").val();
		if(PhId)
			{
			//ajax  start			
	            $.ajax({
                type:'POST',
                dataType:'json',
                data:{ 'mode': true, 'id': PhId, 'albumId':albumId, 'title':title,'desc':desc },				
                url:'/fan/EditAllPhotos',
                success:function (data)
                {	checkResponseRedirect(data);
	     			$("#Msg").show();
					$("#Msg").slideUp();							
					$("#Msg").html("Successfully updated!");
				}
            });	

			//ajax end
			}
		});			
			
		},		
		
		
	updateNewAlbumName:function(id)
		{
			$("#AlbumName_"+id).slideDown();					
			var title = $("#updateNewalbumNames").val();									
			
			$("#AlbumName_"+id).html('<p style="padding:0 5px;" id="AlbumName_"'+id+' ></p>');
			$("#AlbumName_"+id).html(title);
					
			$('.uplod-colu-ANO').hide();
			
			if(id){
				$("#PhotoLoading").html('Please wait...');
				$("#PhotoLoading").slideDown("slow");	
				$("#PhotoLoading").css('display','block');					
				$.ajax({
						type:'POST',
						dataType:'json',
						data:'id='+id+'&title='+title,
						url:'/fan/EditAjaxPhotoAlbum',
						success:function(data)
						{	checkResponseRedirect(data);
							if(data.q=='ok')
							{
								$("#PhotoLoading").css('display','none');													
								$("#PhotoSuccess").html('Successfully updated!');
								$("#PhotoSuccess").slideDown("slow");	
								$("#PhotoSuccess").css('display','block');								
								
/*								var serverList = document.getElementById("AlbumId");
								console.log();
								return false;*/
								
								//data.albumId
								//data.albumTitle
								
								//var newOption = $('<option value="'+data.AlbumId+'">'+data.AlbumTitle+'</option>');
 								//$('#AlbumId').append(newOption);
									
							}
						}
					});				
				}
		},
		
		
		PhotoAlbumRemove:function(id)
		{	
		  var didConfirm = confirm("Are you sure?");
		  if (didConfirm == true) {					  	
				$.ajax({
						type:'POST',
						dataType:'json',
						data:'id='+id,
						url:'/artist/RemovePhotoAlbum?id='+id,
						success:function(data)
						{	checkResponseRedirect(data);
							$("#totAlb").html(data.totAlb);
							$("#totPhoto").html(data.totPhoto);
							if(data.q =='ok')
							{
								$("#PhotoAlbums_"+id).hide();
								$("#PhotoAlbums_"+id).slideUp();	
							}	
						}
					});							
		  }
		
		},
		
		FanRemovePhotoOnly:function(id, albumId){
			 var didConfirm = confirm("Are you sure?");
			  if (didConfirm == true)
			  {					  	
					$.ajax({
							type:'POST',
							dataType:'json',
							data:'id='+id,
							url:'/fan/RemovePhoto?id='+id+'&albumId='+albumId,
							success:function(data)
							{
								checkResponseRedirect(data);
								$("#totAlb").html(data.totAlb);
								$("#totPhoto").html(data.totPhoto);
								if(data.q=='ok')
								{
									$("#Photos_"+id).css('display','none');
									$("#Photos_"+id).hide();
								}
							}
						});
			
		  }
		
		
		},
		
		ArtistRemovePhotoOnly:function(id, albumId){
			 var didConfirm = confirm("Are you sure?");
			  if (didConfirm == true)
			  {					  	
					$.ajax({
							type:'POST',
							dataType:'json',
							data:'id='+id,
							url:'/artist/RemovePhoto?id='+id+'&albumId='+albumId,
							success:function(data)
							{
								if(data.q=='ok')
								{
									$("#Photos_"+id).css('display','none');
									$("#Photos_"+id).hide();
								}
							}
						});
			
		  }
		
		
		}
	
}

var doLoad = 0;
var oPhotoEdit = new photoEdit();
var userId = 0;
var page = 0;

$(document).ready(function(){
	$('body').on('click', '.cancelAlbum', function(){
			albTitle = $(this).attr('title');
			albId = $(this).attr('id').split('_')[1];
			oPhotoEdit.cancelalbumEdit(albId, albTitle);
	});
	
	$('body').on('click', '.cancelPhotoEdit', function(){
			photoTitle = $(this).attr('title');
			photoId = $(this).attr('id').split('_')[1];
			oPhotoEdit.cancelPhotoEdit(photoId, photoTitle);
	});
	
});