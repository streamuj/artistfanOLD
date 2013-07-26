/**
 * Contacts JS class
 * User: ssergy
 * Date: 19.01.2011
 * Time: 19:24:26
 *
 */

var show_login = 0;

function Home()
{

}


Home.prototype =
{
    __construct:function ()
    {
        $(document).ready(function ()
        {

        });
    },
	CatInLineEdit: function(id, cname)
	{		
		$('#pCatView_'+id).html('');
		$('#pCatView_'+id).html('<input type="text" class="text_input_small cat_'+id+'" value="'+jQuery.trim(cname)+'" /><a href="javascript:void(0);" class="save_icon" onclick="oHome.UpdateCat('+id+')"></a>');		
	},
    UpdateCat: function(id)
    {		
        $('#wait').show();
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id+"&cat_name="+$('.cat_'+id).val(),
            url:      '/base/home/updatecategory',
             success:function (data)
            {
				checkResponseRedirect(data);
				var q="'";
                if (data.q == 'ok')
                {
					$('#pCatView_'+id).html(data.catName+'<a href="javascript:void(0);" class="edit_icon" onclick="oHome.CatInLineEdit('+q+id+q+','+q+data.catName+q+')"></a>');
                }
                $('#wait').hide();
            }
        });
    },
	SaveCatOrder: function(id, h_order)
	{
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id+"&cat_order="+h_order,
            url:      '/base/home/UpdateCatOrder'
        });
	},
	AddNewCat: function()
	{
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "cat_name="+$('#newCatName').val()+"&cat_order="+$('#newCatOrder').val()+"&parent_id="+$('#Category').val(),
            url:      '/base/home/AddNewCategory',
            success: function (data)
            {	
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {		
					$('#addBtn').show();				
					oHome.CategoryList();
				}
			}
        });
	},	
    CategoryList: function(page)
    {		
        $('#wait').show();
        page = typeof page != "undefined" ? page : $('#page').val();
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&home_cat="+$('#Category').val(),
            url:      '/base/home/category',
            success: function (data)
            {
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
                    $('#list').html( data.data );
                    $('#pagging').html(data.pagging);
                    $('#page').val(data.page);
                }
                $('#wait').hide();
            }
        });
    },
    DeleteCat: function(id)
    {
        if(!confirm('Do you really want to remove this category?'))
        {
            return;
        }
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id,
            url:      '/base/home/DeleteCat',
            success: function (data)
            {
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
					$('#category_'+id).remove();
                }
            }
        });
    },	
	ArtistList: function(page)
    {
		
        $('#wait').show();
        page = typeof page != "undefined" ? page : $('#page').val();
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&home_cat="+$('#Category').val(),
            url:      '/base/home/Artist',
            success: function (data)
            { checkResponseRedirect(data);
                if (data.q == 'ok')
                {
                    $('#list').html( data.data );
                    $('#pagging').html(data.pagging);
                    $('#page').val(data.page);
                }
                $('#wait').hide();
            }
        });
    },
    VideoList: function(page)
    {
        $('#wait').show();
        page = typeof page != "undefined" ? page : $('#page').val();
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&home_cat="+$('#Category').val(),
            url:      '/base/home/video',
            success: function (data)
            {	checkResponseRedirect(data);
                if (data.q == 'ok')
                {
                    $('#list').html( data.data );
                    $('#pagging').html(data.pagging);
                    $('#page').val(data.page);
                }
                $('#wait').hide();
            }
        });
    },
    EventList: function(page)
    {
        $('#wait').show();
        page = typeof page != "undefined" ? page : $('#page').val();
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&home_cat="+$('#Category').val(),
            url:      '/base/home/event',
            success: function (data)
            {	checkResponseRedirect(data);
                if (data.q == 'ok')
                {
                    $('#list').html( data.data );
                    $('#pagging').html(data.pagging);
                    $('#page').val(data.page);
                }
                $('#wait').hide();
            }
        });
    },	
    MusicAlbumList: function(page)
    {
        $('#wait').show();
        page = typeof page != "undefined" ? page : $('#page').val();
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&home_cat="+$('#Category').val(),
            url:      '/base/home/musicalbum',
            success: function (data)
            {	checkResponseRedirect(data);
                if (data.q == 'ok')
                {
                    $('#list').html( data.data );
                    $('#pagging').html(data.pagging);
                    $('#page').val(data.page);
                }
                $('#wait').hide();
            }
        });
    },	
	
	SearchUsers: function(status)
    {
    	email = $('#email').val();
    	name = $('#name').val();
    	s_location = $('#location').val();
		
		email = typeof email != "undefined" ? email : '';
		name = typeof name != "undefined" ? name : '';
		s_location = typeof s_location != "undefined" ? s_location :'';				

	  $.ajax({
            type:     'POST',
            dataType: 'json',    
			data: "email="+email+"&name="+name+"&location="+s_location+"&status="+status,
            url:           '/base/home/SearchArtistList',
            success:       function(data)
            {
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
                    if (data.q == 'ok')
                    {
                        $('#list').html(data.data);					
                    }
                    $('#wait').hide();
                }
            }
        });
    },	

	HomeLinkUser: function(user, user_id)
	{
		u_name = user;
		u_id = user_id;		
		$('#link').val('/u/'+u_name+'/');
		$('#u_id').val(u_id);		
	},
 	SaveArtist: function(m_type)
    {
		id = $('#u_id').val();
		u_link = $('#link').val();
		h_order = $('#h_order').val();
		home_cat = $('#Category').val();	

		var er = 0;
		$('#err_link, #err_Category').removeClass('error_link').html('');
		 
		if(u_link=='')
		{
			$('#err_link').addClass('error_link').html('Please Select Artist To Create Link');
			er = 1;
		}	
		if($('#Category').val() =='')
		{
			$('#err_Category').addClass('error_link').html('Please Select Category');
			er = 1;
		}		
		if(er)
		{
			return false
		}
		else
		{		
			$('#wait').show();
			$.ajax({
				type:     'POST',
				dataType: 'json',    
				data: 	  "id="+id+"&link="+u_link+"&h_order="+h_order+"&home_cat="+home_cat,
				url:      '/base/home/savehomeartist',
				success :function(response)
				{			
					if(response.q == 'ok')
					{
						$('#link').val('');
						window.location.href="/base/home/artist?msg=1";									
					}
					else
					{
						if (response.errs)
						{
							$('#err_link').addClass('error_link').html('This link already created');
						}
					}
				}		
	        });
		}
    },
 	SaveVideo: function(m_type)
    {
		id = $('#m_id').val();
		u_link = $('#link').val();
		h_order = $('#h_order').val();	
		home_cat = $('#Category').val();	
		rand_id = $('#rand_id').val();		

		var er = 0;
		$('#err_link, #err_Category').removeClass('error_link').html('');
		 
		if(u_link=='')
		{
			$('#err_link').addClass('error_link').html('Please Select Artist To Create Link');
			er = 1;
		}	
		if(u_link != '' && id =='')
		{
			$('#err_link').addClass('error_link').html('Please Select Video To Create Link');
			er = 1;			
		}
		if(home_cat =='')
		{
			$('#err_Category').addClass('error_link').html('Please Select Category');
			er = 1;
		}
		if(home_cat == 8 && $('#slide_image').attr('src') == '/si/placeholder.gif')
		{
			$('#image_err').addClass('error_link').html('Please upload slide image');
			er = 1;
		}
		if(er)
		{
			return false
		}
		else
		{
			var param = "&x1="+$('#x1').val()+"&y1="+$('#y1').val()+"&x2="+$('#x2').val()+"&y2="+$('#y2').val()+"&w="+$('#w').val()+"&h="+$('#h').val();
			
			$('#wait').show();
			$.ajax({
				type:     'POST',
				dataType: 'json',    
				data: 	  "id="+id+"&link="+u_link+"&h_order="+h_order+"&home_cat="+home_cat+"&rand_id="+rand_id+param,
				url:      '/base/home/savehomevideo',
				success :function(response)
				{			
					if(response.q == 'ok')
					{
						$('#link').val('');
						window.location.href="/base/home/video?msg=1";						
					}
				}
			});
		}
    },	
 	SaveEvent: function(m_type)
    {
		id = $('#m_id').val();
		u_link = $('#link').val();
		h_order = $('#h_order').val();
		home_cat = $('#Category').val();	

		var er = 0;
		$('#err_link, #err_Category').removeClass('error_link').html('');
		 
		if(u_link=='')
		{
			$('#err_link').addClass('error_link').html('Please Select Artist To Create Link');
			er = 1;
		}
		if(u_link != '' && id =='')
		{
			$('#err_link').addClass('error_link').html('Please Select Event To Create Link');
			er = 1;			
		}		
		if($('#Category').val() =='')
		{
			$('#err_Category').addClass('error_link').html('Please Select Category');
			er = 1;
		}		
		if(er)
		{
			return false
		}
		else
		{						
			$('#wait').show();
			$.ajax({
				type:     'POST',
				dataType: 'json',    
				data: 	  "id="+id+"&link="+u_link+"&h_order="+h_order+"&home_cat="+home_cat,
				url:      '/base/home/savehomeevent',
				success :function(response)
				{			
					if(response.q == 'ok')
					{
						$('#link').val('');
						window.location.href="/base/home/event?msg=1";
					}
				}
			});
		}
    },		
 	SaveMusicAlbum: function(m_type)
    {
		id = $('#m_id').val();
		u_link = $('#link').val();
		h_order = $('#h_order').val();	
		home_cat = $('#Category').val();	
		rand_id = $('#rand_id').val();			

		var er = 0;
		$('#err_link, #err_Category').removeClass('error_link').html('');
		 
		
		if(u_link=='')
		{
			$('#err_link').addClass('error_link').html('Please Select Artist To Create Link');
			er = 1;
		}	
		if(u_link != '' && id =='')
		{
			$('#err_link').addClass('error_link').html('Please Select Music To Create Link');
			er = 1;			
		}		
		if($('#Category').val() =='')
		{
			$('#err_Category').addClass('error_link').html('Please Select Category');
			er = 1;
		}	

		if(home_cat == 15 && $('#slide_image').attr('src') == '/si/placeholder.gif')
		{
			$('#image_err').addClass('error_link').html('Please upload slide image');
			er = 1;
		}
		
		if(er)
		{
			return false
		}
		else
		{	
			var param = "&x1="+$('#x1').val()+"&y1="+$('#y1').val()+"&x2="+$('#x2').val()+"&y2="+$('#y2').val()+"&w="+$('#w').val()+"&h="+$('#h').val();
		
		
			$('#wait').show();
			$.ajax({
				type:     'POST',
				dataType: 'json',    
				data: 	  "id="+id+"&link="+u_link+"&h_order="+h_order+"&home_cat="+home_cat+"&rand_id="+rand_id+param,
				url:      '/base/home/savehomemusicalbum',
				success :function(response)
				{			
					if(response.q == 'ok')
					{
						$('#link').val('');
						window.location.href="/base/home/musicalbum?msg=1"; 											
					}
				}
			});
		}
    },			
	
	HomeLinkFunction: function(type)
	{
		fun_name = type;
		switch(type)
		{
			case 'HomeVideoList':
								m_type = 'video';
								break;
			case 'HomeEventList':
								m_type = 'events';
								break;								
			case 'HomeMusicAlbumList':
								m_type = 'music';
								break;							
		}
		$('#link').val('/u/'+u_name+'/'+m_type);
		oHome.HomeLinkSelectMedia(fun_name);
	},	
   HomeLinkSelectMedia: function(m_type)
    {
        $('#wait').show();
        $.ajax({
            type:     'POST',
            dataType: 'json',    
			data: 	  "id="+u_id,
            url:      '/base/home/'+m_type,
            success: function (data)
            {	checkResponseRedirect(data);
                if (data.q == 'ok')
                {
					$('#HomeLinkSelected').html( data.data );	
					$('#art_name').html('<b>'+u_name+'</b>');					
				}
                $('#wait').hide();
            }
        });
    },
	
	HomeFullLink: function(id)
	{
		$('#link').val('/u/'+u_name+'/'+m_type+'/'+id);
		$('#m_id').val(id);	
	},
	SaveHomeOrder: function(id, h_order)
	{
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id+"&h_order="+h_order,
            url:      '/base/home/SaveHomeOrder'
        });
	},
    DeleteLink: function(id, status)
    {
        if(!confirm('Do you really want to remove from home page list?'))
        {
            return;
        }
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id,
            url:      '/base/home/DeleteLink',
            success: function (data)
            {	checkResponseRedirect(data);
                if (data.q == 'ok')
                {
					$('#artist_'+id).remove();
                }
            }
        });
    }
}

var doLoad = 0;
var oHome = new Home();
