/**
 *
 * User: ssergy
 * Date: 20.12.11
 * Time: 18:07
 *
 */

function Admin()
{

}


Admin.prototype =
{
    __construct:function ()
    {
        $(document).ready(function ()
        {
            
        });
    },


    PaymentsStartReload: function()
    {
        oAdmin.PaymentsList();
        setTimeout("oAdmin.PaymentsList()", 10000);
    },

    PaymentsList: function(page)
    {
        $('#wait').show();
        page = typeof page != "undefined" ? page : $('#page').val();
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&flist="+$('#flist').val()+"&pcnt="+$('#pcnt').val()+"&tp="+$('#tp').val(),
            url:      '/base/admin/PaymentsList',
            success: function (data)
            {
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

    PaymentsFilter: function()
    {
        $('#page').val('1');
        var options = {
            type:          'post',
            dataType:      'json',
            clearForm:     false,
            resetForm:     false,
            url:           '/base/admin/PaymentsList',
            beforeSubmit:  function()
            {
                $('#wait').show();
            },
            success:       function(data)
            {
                if (data.q == 'ok')
                {
                    if (data.q == 'ok')
                    {
                        $('#list').html(data.data);
                        $('#pagging').html(data.pagging);
                        $('#flist').val(data.flist);
                    }
                    $('#wait').hide();
                }
            }
        };
        $('#plist').ajaxSubmit(options);
    },

    PayoutChangeStatus: function(id, status)
    {
        if(doLoadAdmin == 1)
        {
            return;
        }
        doLoadAdmin = 1;
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id+"&status="+status,
            url:      '/base/admin/PaymentChangeStatus',
            success: function (data)
            {
                doLoadAdmin = 0;
                if (data.q == 'ok')
                {
                    oAdmin.PaymentsList();
                }
            }
        });
    },

    MusicStartReload: function()
    {
        oAdmin.MusicList();
        setTimeout("oAdmin.MusicList()", 10000);
    },

    MusicList: function(page)
    {
        $('#wait').show();
        page = typeof page != "undefined" ? page : $('#page').val();
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&flist="+$('#flist').val()+"&pcnt="+$('#pcnt').val()+"&tp="+$('#tp').val(),
            url:      '/base/admin/MusicList',
            success: function (data)
            {
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

    MusicFilter: function()
    {
        $('#page').val('1');
        var options = {
            type:          'post',
            dataType:      'json',
            clearForm:     false,
            resetForm:     false,
            url:           '/base/admin/MusicList',
            beforeSubmit:  function()
            {
                $('#wait').show();
            },
            success:       function(data)
            {
                if (data.q == 'ok')
                {
                    if (data.q == 'ok')
                    {
                        $('#list').html(data.data);
                        $('#pagging').html(data.pagging);
                        $('#flist').val(data.flist);
                    }
                    $('#wait').hide();
                }
            }
        };
        $('#mlist').ajaxSubmit(options);
    },

    MusicAlbumFeatured: function(id)
    {
        if(doLoadAdmin == 1)
        {
            return;
        }
        doLoadAdmin = 1;
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id,
            url:      '/base/admin/MusicAlbumFeatured',
            success: function (data)
            {
                doLoadAdmin = 0;
                if (data.q == 'ok')
                {
                    oAdmin.MusicList(1);
                }
            }
        });
    },

    DeleteMusic: function(id, is_album)
    {
        var is_album = typeof is_album != "undefined" ? is_album : 0;
        if(doLoadAdmin == 1)
        {
            return;
        }
        if(!confirm('Do you really want to delete this ' + (is_album > 0 ? 'album' : 'track') + '?'))
        {
            return;
        }
        doLoadAdmin = 1;
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id+'&is_album='+is_album,
            url:      '/base/admin/MusicDelete',
            success: function (data)
            {
                doLoadAdmin = 0;
                if (data.q == 'ok')
                {
                    oAdmin.MusicList();
                }
            }
        });
    },

    RestoreMusic: function(id, is_album)
    {
        var is_album = typeof is_album != "undefined" ? is_album : 0;
        if(doLoadAdmin == 1)
        {
            return;
        }
        if(!confirm('Do you really want to restore this ' + (is_album > 0 ? 'album' : 'track') + '?'))
        {
            return;
        }
        doLoadAdmin = 1;
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id+'&is_album='+is_album,
            url:      '/base/admin/MusicRestore',
            success: function (data)
            {
                doLoadAdmin = 0;
                if (data.q == 'ok')
                {
                    oAdmin.MusicList();
                }
            }
        });
    },

    VideoStartReload: function()
    {
        oAdmin.VideoList();
        setTimeout("oAdmin.VideoList()", 10000);
    },

    VideoList: function(page)
    {
        $('#wait').show();
        page = typeof page != "undefined" ? page : $('#page').val();
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&flist="+$('#flist').val()+"&pcnt="+$('#pcnt').val(),
            url:      '/base/admin/VideoList',
            success: function (data)
            {
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

    VideoFilter: function()
    {
        $('#page').val('1');
        var options = {
            type:          'post',
            dataType:      'json',
            clearForm:     false,
            resetForm:     false,
            url:           '/base/admin/VideoList',
            beforeSubmit:  function()
            {
                $('#wait').show();
            },
            success:       function(data)
            {
                if (data.q == 'ok')
                {
                    if (data.q == 'ok')
                    {
                        $('#list').html(data.data);
                        $('#pagging').html(data.pagging);
                        $('#flist').val(data.flist);
                    }
                    $('#wait').hide();
                }
            }
        };
        $('#vlist').ajaxSubmit(options);
    },

    DeleteVideo: function(id)
    {
        if(doLoadAdmin == 1)
        {
            return;
        }
        if(!confirm('Do you really want to delete this video?'))
        {
            return;
        }
        doLoadAdmin = 1;
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id,
            url:      '/base/admin/VideoDelete',
            success: function (data)
            {
                doLoadAdmin = 0;
                if (data.q == 'ok')
                {
                    oAdmin.VideoList();
                }
            }
        });
    },

    RestoreVideo: function(id)
    {
        if(doLoadAdmin == 1)
        {
            return;
        }
        if(!confirm('Do you really want to restore this video?'))
        {
            return;
        }
        doLoadAdmin = 1;
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id,
            url:      '/base/admin/VideoRestore',
            success: function (data)
            {
                doLoadAdmin = 0;
                if (data.q == 'ok')
                {
                    oAdmin.VideoList();
                }
            }
        });
    },
	
    EventsList: function(page,event_app)
    {

		$('#wait').show();
        page = typeof page != "undefined" ? page : $('#page').val();
	
		event_type = $('.tabs-panel .act').attr('id').split('_')[1];		
		var event_app = typeof event_app != "undefined" ? event_app :event_type;

		$("li").removeClass('act');		
		$('#list').val('');		
		$('.tabs-panel #eventType_'+event_app).addClass('act');
        
		$.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&flist="+$('#flist').val()+"&pcnt="+$('#pcnt').val()+"&event_app="+event_app,
            url:      '/base/admin/EventsList',
            success: function (data)
            {
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

    EventsFilter: function(event_app)
    {
        $('#page').val('1');
		event_app = typeof event_app != "undefined" ? event_app :0;
		
        var options = {
            type:          'post',
            dataType:      'json',
            data:    {"event_app":event_app},
            clearForm:     false,
            resetForm:     false,
            url:           '/base/admin/EventsList',
            beforeSubmit:  function()
            {
                $('#wait').show();
            },
            success:       function(data)
            {
                if (data.q == 'ok')
                {
                    if (data.q == 'ok')
                    {
                        $('#list').html(data.data);
                        $('#pagging').html(data.pagging);
                        $('#flist').val(data.flist);
                    }
                    $('#wait').hide();
                }
            } 
        };
        $('#elist').ajaxSubmit(options);
    },

    DeleteEvent: function(id)
    {
        if(doLoadAdmin == 1)
        {
            return;
        }
        if(!confirm('Do you really want to delete this event?'))
        {
            return;
        }
        doLoadAdmin = 1;
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id,
            url:      '/base/admin/EventDelete',
            success: function (data)
            {
                doLoadAdmin = 0;
                if (data.q == 'ok')
                {
                    oAdmin.EventsList();
                }
            }
        });
    },
    ChangeApproveStatus: function(id, user_id, event_app)
    {
        if(doLoadAdmin == 1)
        {
            return;
        }
        if(!confirm('Do you really want to change this event status?'))
        {
            return;
        }
		
        doLoadAdmin = 1;
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id+"&event_app="+event_app+"&user_id="+user_id,
            url:      '/base/admin/ChangeApproveStatus',
            success: function (data)
            {
                doLoadAdmin = 0;
                if (data.q == 'ok')
                {
                    oAdmin.EventsList(1, data.event_app);
                }
            }
        });
    },	

    RestoreEvent: function(id)
    {
        if(doLoadAdmin == 1)
        {
            return;
        }
        if(!confirm('Do you really want to restore this event?'))
        {
            return;
        }
        doLoadAdmin = 1;
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id,
            url:      '/base/admin/EventRestore',
            success: function (data)
            {
                doLoadAdmin = 0;
                if (data.q == 'ok')
                {
                    oAdmin.EventsList();
                }
            }
        });
    }
}

var doLoadAdmin = 0;
var oAdmin = new Admin();