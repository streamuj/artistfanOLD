/**
 * Contacts JS class
 * User: ssergy
 * Date: 19.01.2011
 * Time: 19:24:26
 *
 */

var show_login = 0;

function Users()
{

}


Users.prototype =
{
    __construct:function ()
    {
		
        $(document).ready(function ()
        {
			
        });
    },


    /**
     * Init login
     */
    InitLogin:function ()
    {
        /*$('#system_login, #system_pass').keyup(
            function (e)
            {
                if (13 === e.keyCode)
                    $('#login_form').submit();
            });*/
            
        //submit login form    
        $('#login_form').submit(function() {
            var er = 0;
            if (jQuery.trim($("#system_login").val()) == "" || !verify_email($("#system_login").val()))
            {
                $('#system_login_err').html('<span class="error">Please enter your valid e-mail</span>');
                er = 1;
            }
            else
            {
                $('#system_login').parents('tr').find('div').html('<span class="good">&nbsp;</span>');
            }

            if (jQuery.trim($("#system_pass").val()) == "")
            {
                $('#system_pass_err').html('<span class="error">Please enter your password</span>');
                er = 1;
            }
            else
            {
                $('#system_pass').parents('tr').find('div').html('<span class="good">&nbsp;</span>');
            }

            if (!er)
            {
                return true;
            }
            else
            {
                return false;
            }
        });  

    },

    
    /**
     * Edit user profile
     */
    Edit:function ()
    {
        $('#edit_btn').click(function ()
        {
            if (doLoad)
            {
                return false;
            }
            doLoad = 1;

            $('.err').html('');

            var options = {
                type:'post',
                dataType:'json',
                clearForm:false,
                resetForm:false,
                url:'/base/user/Edit',
                beforeSubmit:function ()
                {

                },
                success:function (data)
                {
					checkResponseRedirect(data);
                    doLoad = 0;
                    if (data.q == 'ok')
                    {
                        document.location = '/base/user/Edit';
                    }
                    else
                    {
                        if (data.errs)
                        {
                            for (var i in data.errs)
                            {
                                $('#err_' + i).html('<br />' + data.errs[i]);
                            }
                        }
                    }
                }
            };
            $('#edit_form').ajaxSubmit(options);
        });
    },
    
    /**
     * Upload avatar from profile form
     */
    UploadAvatar: function ()
    {
        $("#loading").ajaxStart(function ()
        {
            $(this).show();
        }).ajaxComplete(function ()
        {
            $(this).hide();
        });

        $.ajaxFileUpload({
            url:'/base/user/UploadAvatar',
            secureuri:false,
            fileElementId:'file',
            dataType: 'json',
            async: false,
            success: function (data, status)
            {
                if (typeof data.avatar != undefined)
                {
                    $('#avatar').attr('src', data.avatar);
                }
            },
            error: function (data, status, e)
            {

            }
        });
        return false;
    },


    /**
     * Follow other user (artist)
     */
    Follow: function(user_id_follow) {

        $.ajax({
            type:'POST',
            dataType:'json',
            data:{
                'user_id_follow': user_id_follow
            },
            url:'/base/profile/Follow',
            success:function (data)
            {
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
                    var oldnum = -1;
                    if($('.header_block').find('#fanscount').length > 0)
                    {
                        oldnum = 1*$('#fanscount').html();
                    }
                    if (data.data*1 == 1)
                    {					
                        //followed
						if(data.status == 2)						
                        $('#follow').html('<span style="color:green;">Followed</span>');						
						else
						$('#follow').html('<span style="color:green;">Connected</span>');
						
                        if(oldnum >= 0)
                        {
                            oldnum++;
                            $('#fanscount').html(oldnum);
                        }
                    }
                    else if (data.data == 2)
                    {
                        //unfollowed						
						if(data.status == 2)
                        $('#follow').html('<span style="color:red;">Unfollowed</span>');
						else
						$('#follow').html('<span style="color:red;">Disconnected</span>');
						
                        if(oldnum > 0)
                        {
                            oldnum--;
                            $('#fanscount').html(oldnum);
                        }
                    }
                }
				window.location.href =	window.location;
				
            }
        });
    },
   ConnectFollow: function(user_id_follow,username,url){	   
        $.ajax({
            type:'POST',
            dataType:'json',
            data:{
                'user_id_follow': user_id_follow
            },
            url:'/base/profile/Follow',
            success:function (data)
            {
				checkResponseRedirect(data);
                if (data.q == 'ok')
                {
                    var oldnum = -1;
                    if($('.header_block').find('#fanscount').length > 0)
                    {
                        oldnum = 1*$('#fanscount').html();
                    }
                    if (data.data*1 == 1)
                    {					
                        //followed
						if(data.status == 2)						
                        $('#follow').html('<span style="color:green;">Followed</span>');						
						else
						$('#follow').html('<span style="color:green;">Connected</span>');
						
                        if(oldnum >= 0)
                        {
                            oldnum++;
                            $('#fanscount').html(oldnum);
                        }
					//	document.location = '/u/'+username+'/'+url+'';	
						window.location.href =	window.location;
					
                    }
                    else if (data.data == 2)
                    {
                        //unfollowed						
						if(data.status == 2)
                        $('#follow').html('<span style="color:red;">Unfollowed</span>');
						else
						$('#follow').html('<span style="color:red;">Disconnected</span>');
						
                        if(oldnum > 0)
                        {
                            oldnum--;
                            $('#fanscount').html(oldnum);
                        }

                    }
                }			
				
            }
        });   
	   
	   },

    /**
     * Init registration select
     */
    InitRegistrationSelect:function ()
    {
        $('#select_form').submit(function() {
            var er = 0;
            var st = $(':radio[name=status]').filter(':checked').val();
            st = (undefined == st) ? 0 : st;
            if (st != 1 && st != 2)
            {
                $('.radio_td').parents('tr').find('td:last').html('<div class="error">Please select your role!</div>');
                er = 1;
            }

            if (!er)
            {
                return true;
            }
            else
            {
                return false;
            }
        });

    },

    InitRegistration: function() {
        var err = 0;
        $('#email').blur(function(){
            if(!verify_email($(this).val()))
            {
                oErrors.SetBadFld('email', 'This isn\'t a valid address');
                err = 1;
            }
            else
            {
                oErrors.SetWaitFld('email');
                $.ajax({
                    type:     'POST',
                    dataType: 'json',
                    data:     "what=email&email="+$(this).val(),
                    url:      '/base/user/ValidateRegisterFields',
                    success: function (data)
                    {
                        if (data.q == 'ok')
                        {
                            oErrors.SetOkFld('email', 'Available!');
                            err = 0;
                        }
                        else
                        {
                            oErrors.SetBadFld('email', data.err);
                            err = 1;
                        }
                    }
                });
            }
        });
        $('#name').blur(function(){
            oErrors.SetWaitFld('name');
            $.ajax({
                type:     'POST',
                dataType: 'json',
                data:     "what=name&name="+$(this).val(),
                url:      '/base/user/ValidateRegisterFields',
                success: function (data)
                {
                    if (data.q == 'ok')
                    {
                        oErrors.SetOkFld('name', 'Available!');
                        err = 0;
                    }
                    else
                    {
                        oErrors.SetBadFld('name', data.err);
                        err = 1;
                    }
                }
            });
        });
        $('#pass').blur(function(){
            if(jQuery.trim($(this).val()) == "" || jQuery.trim($(this).val()).length < 6)
            {
                oErrors.SetBadFld('pass', 'Your password is too short');
                err = 1;
            }
            else if(jQuery.trim($('#pass2').val()) != '' && jQuery.trim($(this).val()) != jQuery.trim($('#pass2').val()))
            {
                oErrors.SetBadFld('pass', 'The password fields did not match');
                err = 1;
            }
            else
            {
                oErrors.SetOkFld('pass');
                err = 0;
            }
        });
        $('#pass2').blur(function(){
            if(jQuery.trim($(this).val()) == '')
            {
                oErrors.SetBadFld('pass2', 'Please repeat password');
                err = 1;
            }
            else if(jQuery.trim($('#pass').val()) != jQuery.trim($(this).val()))
            {
                oErrors.SetBadFld('pass', 'The passwords do not match');
                err = 1;
            }
            else
            {
                oErrors.SetOkFld('pass');
                oErrors.SetOkFld('pass2');
                err = 0;
            }
        });
        $('#first_name').blur(function(){
            if(jQuery.trim($(this).val()) == '')
            {
                oErrors.SetBadFld('first_name', 'Please specify first name');
                err = 1;
            }
            else
            {
                oErrors.SetOkFld('first_name');
                err = 0;
            }
        });
        $('#last_name').blur(function(){
            if(jQuery.trim($(this).val()) == '')
            {
                oErrors.SetBadFld('last_name', 'Please specify last name');
                err = 1;
            }
            else
            {
                oErrors.SetOkFld('last_name');
                err = 0;
            }
        });

        $('.genres').click(function(){
           var numgenres = $('.genres:checkbox').filter(':checked').length;
            if(numgenres == 0)
            {
                oErrors.SetBadFld('genres', 'You must select genres');
                err = 1;
            }
            else if(numgenres > 5)
            {
                oErrors.SetBadFld('genres', 'You can choose up to 3 genres');
                err = 1;
            }
            else
            {
                oErrors.SetOkFld('genres');
                err = 0;
            }
        });

        $('#website').blur(function(){
            if(jQuery.trim($(this).val()) != '')
            {
                if(!verify_url(jQuery.trim($(this).val())))
                {
                    oErrors.SetBadFld('website', 'This isn\'t a valid website url');
                    err = 1;
                }
                else
                {
                    oErrors.SetOkFld('website');
                    err = 0;
                }
            }
            else
            {
                oErrors.SetClearFld('website');
                err = 0;
            }
        });
    
        
        //submit registration form
        $('#reg_form').submit(function() {
            if (!err)
            {
                return true;
            }
            else
            {
                return false;
            }
        });
        
      
    },

    /**
     * Delete one record label item from list
     */
    DeleteRecordLabel: function() {
        
    },
    

    InitRecordLabelEdit: function() {
       $('#add_label').click(function() {
            var obj = $('.rlabel div:first').clone(true);
            $(obj).find('input:text').val('');
            $(obj).appendTo('.rlabel');
        });

        $('.del_label').click(function() {
            if ($('.pitem').length > 1)
            {
                $(this).parents('.pitem').remove();
            }
            else
            {
                $(this).parents('.pitem').find('input:text').val('');
            }

        });
    },


    /**
      *  Init Facebook login button
      */
    FBInit: function(app_id, domain)
    {
        window.fbAsyncInit = function ()
        {
            FB.init({
                appId:app_id, 
                channelUrl:'//' + domain + '/base/user/FbChannel', 
                status:true, 
                cookie:true, 
                xfbml:true, 
                oauth:true
            });
        };
    },


    /**
     *  Login with Facebook (custom button)
     */
    FBLoginCustom:function (sel)
    {
        var sel = undefined == sel ? 0 : sel;
        FB.login(function (response)
        {
            if (response.authResponse)
            {
                FB.api('/me', function (response)
                {
               //  var st = sel == 1 ? $(':radio[name=status]').filter(':checked').val() : (sel == 2 ? $('#status').val() : 0);
			   	   var st = sel;
                   st = (undefined == st) ? 0 : st;
                    var email = (undefined != response.email) ? response.email : '';
                    oUsers.FbAuth(response.id,
                        response.first_name,
                        response.last_name,
                        response.name,
                        email,
                        st
                    );
                });
            }
        }, {
            scope:'email,read_stream,publish_stream'
        });
    },


    /**
     *  Ajax login with Facebook
     */
    FbAuth:function (id, fname, lname, name, email, status)
    {
        $.ajax({
           type:'POST',
           dataType:'json',
           cache:false,
           data:{
               "id":id,
               "ajaxinit":1,
               "fname":fname,
               "lname":lname,
               "name":name,
               "email":email
           },
           url:'/base/user/FbAuth',
           success:function (data)
           {
			   checkResponseRedirect(data);
               if (data.q == 'ok')
               {
                   if (1*data.isfirst == 1)
                   {
                       //first auth with facebook - redirect to edit profile page
                       if(status > 0)
                       {
                           document.location = '/reg/?status=' + status;
                       }
                       else
                       {
					       document.location = '/base/user/login?err=1';
                       }
                   }
                   else
                   {
                       if(data.redirect)
                       {
                           document.location = '/' + data.redirect;
                       }
                       else
                       {
                           document.location = '/u/'+ data.uname;
                       }
                   }
               }
               else
               {
                   if(data.err)
                   {   
					   $('#infoAlert').html(data.err);
					   	$('#infoAlert').dialog({ 
								modal:true,
								buttons: {
										'OK': {
										"text":'OK', "class":'button wblue', "click":function()
													{									
													$(this).dialog('close');
													}
												}
										}
						});
                   }
               }
           }
       });
    },
 	InitFbFriends: function(page)
    {
		var sContact = $.trim($('#openListSearch').val());

        page = typeof page != "undefined" ? page : $('#page').val();		
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&openListSearch="+sContact,
            url:      '/base/invite/InviteFriends',
            success: function (data)
            {
                if (data.q == 'ok')
                {
					$('#fbFriends').html( data.data );
                    $('#pagging').html(data.pagging);
                }
            }
        });
	},
 	InitTwFriends: function(page)
    {
		var sContact = $.trim($('#openListSearch').val());

        page = typeof page != "undefined" ? page : $('#page').val();		
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&openListSearch="+sContact,
            url:      '/base/invite/InviteTwitterFriends',
            success: function (data)
            {
                if (data.q == 'ok')
                {
					$('#twFriends').html( data.data );
                    $('#pagging').html(data.pagging);
                }
            }
        });
	},	
    /**
     *  Login with Facebook (custom button)
     */
    FBInviteFriend:function ()
    {
		FB.getLoginStatus(function(response) 
	    {
		  if (response.status === 'connected') 
		  {
			FB.api('/me', function (response)
			{
				$.ajax({
					url: '/base/invite/addFBUser',
					type:'post',
					dataType: 'json',
					data :'email='+response.email,
					success: function(data){
						var invId = data.id;
						FB.api('/me/friends', function (response)
						{
							oUsers.FBInsertContact(response.data, invId);
						});
					}
				});
			});

		  } 
		  else 
		  {   
		  /*
			  $('#FBConfirm').dialog('open');	
			  
			  if(confirm("If you want to invite your Facebook friends login with Facebook authentication ! "))
			  {
				  */
					var sel = undefined == sel ? 0 : sel;
				    FB.login(function (response)
					{
						if (response.authResponse)
						{
							FB.api('/me', function (response)
							{
								$.ajax({
									url: '/base/invite/addFBUser',
									type:'post',
									dataType: 'json',
									data :'email='+response.email,
									success: function(data){
										var invId = data.id;
										FB.api('/me/friends', function (response)
										{
											oUsers.FBInsertContact(response.data, invId);
										});
									}
								});								
							});
						}
					}, {
						scope:'email,read_stream,publish_stream'
					});
/*			  }
			  else
			  {
				  return false;
			  }*/
		  }
	   });
		
	},
    TwInviteFriend:function (email)
    {
		$.ajax({
			url: '/base/invite/addTwUser',
			type:'post',
			dataType: 'json',
			data :'email='+email,
			success: function(data){
				if(data.q == 'ok')
				{
					document.location = '/base/invite/InviteTwitterFriends?msg=1';
				}
				else if(data.q == 'err')
				{
/* 				    if(confirm("If you want to invite your Twitter friends login with Twitter authentication ! "))
					{*/
						oUsers.TwtGetAuthUrl();
				//	}
				}
			}
		});
		
	},	

	FBInsertContact: function (friends, invId)
	{
		$.ajax({
				url: '/base/invite/addFBFriends',
				type:'post',
				dataType: 'json',
				data :{ 'frVal':friends, 'apiId': invId },
				success : function(data){
					document.location = '/base/invite/InviteFriends?msg=1';
				}
		});
	},	
	FBInvitationAdd: function (inviter, invitee, invName, invFbid)
	{
		var path = $('#root_path').val(); 
		var appId = $('#appId').val();
		var uFbId = $('#uFbId').val();
		var fbAppName = $('#fbAppName').val();

		FB.ui({
				method: 'send',
				app_id: appId,
				name: 'Invitation to ArtistFan ',
				to: invFbid,
				link: 'http://apps.facebook.com/'+fbAppName+'/?inviter='+uFbId,
				picture: path+'/si/logo_a.png',
				description: "ArtistFan Site"
				
			},
			function(response){
				if(response)
				{	
					$.ajax({
						url: '/base/invite/addFbInvitation',
						type:'post',
						dataType: 'json',
						data :{ 'inviter': inviter, 'invitee':invitee, 'invName': invName, 'invFbid': invFbid },
						success : function(data)
						{
							if(data.q=='ok')
							{
								$('#Invite_'+invitee).addClass('good').html('Invited');
							}
							else if(data.q == 'err')
							{
								$('#Invite_'+invitee).addClass('btnFriend').html('Invited');
							}
						}
					});
				}/*
				else
				{
					//alert('invitation not send');
					//$('#delConfirm').dialog('open');
					
				}	*/						
			});
	},	
	TwInvitationAdd: function ( inviter, invitee, invName, invTwid )
	{
		$.ajax({
			   type :'POST',
			   dataType :'json',
			   data :{ 'invName':invName },
			   url :'/base/invite/sendMsgTwFriend',
			   success :function(data)
			   {
					if(data.q=='ok')
					{
						$.ajax({
							url: '/base/invite/addTwInvitation',
							type:'post',
							dataType: 'json',
							data :{ 'inviter': inviter, 'invitee':invitee, 'invName': invName, 'invTwid': invTwid },
							success : function(data)
							{
								if(data.q=='ok')
								{
									$('#Invite_'+invitee).addClass('good').html('Invited');
								}
								else if(data.q == 'err')
								{
									$('#Invite_'+invitee).addClass('btnFriend').html('Invited');
								}
							}
						});
					}/*
					else if(data.q == 'err')
					{
						//alert('invitation not send');
						$('#delConfirm').dialog('open');						
					}*/
			   }
		});
	},		
	
	TwtGetAuthUrl: function(sel)
    {
        var sel = undefined == sel ? 0 : sel;
        //var st = sel ? $(':radio[name=status]').filter(':checked').val() : (sel == 2 ? $('#status').val() : 0);
		var st = sel;
        st = (undefined == st) ? 0 : st;
        $.ajax({
            type:'POST',
            dataType:'json',
            cache:false,
            data:{"st":st},
            url:'/base/user/TwtGetAuthUrl',
            success:function (data)
            {
				checkResponseRedirect(data);
			//	alert(data.url);
			//	return false;
				
				
               if (data.q == 'ok')
               {
                   document.location = data.url;
               }
               else
               {
                   alert(data.err);
               }
           }
       });
    },

    FbGetAuthUrl: function(sel)
    {
        var sel = undefined == sel ? 0 : sel;
        var st = sel ? $(':radio[name=status]').filter(':checked').val() : (sel == 2 ? $('#status').val() : 0);
        st = (undefined == st) ? 0 : st;
        $.ajax({
            type:'POST',
            dataType:'json',
            cache:false,
            data:{"st":st},
            url:'/base/user/FbGetAuthUrl',
            success:function (data)
            {
				checkResponseRedirect(data);
               if (data.q == 'ok')
               {
                   document.location = data.url;
               }
               else
               {
                   alert(data.err);
               }
           }
       });
    },

    StartReload: function()
    {
        oUsers.UsersList();
       // setTimeout("oUsers.UsersList()", 10000);
    },

    UsersList: function(page)
    {
        $('#wait').show();
        page = typeof page != "undefined" ? page : $('#page').val();
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&flist="+$('#flist').val()+"&pcnt="+$('#pcnt').val()+"&status="+$('#status').val(),
            url:      '/base/user/AdminUsersList',
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

    UsersFilter: function()
    {
        $('#page').val('1'); 
        var options = {
            type:          'post',
            dataType:      'json',
            clearForm:     false,
            resetForm:     false,
            url:           '/base/user/AdminUsersList',
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
        $('#ulist').ajaxSubmit(options);
    },

<!--	video list-->
	
   Video: function(page, video_type)
    {
		if(typeof video_type == "undefined")
		{
			video_type = $('.subTab .active').attr('id').split('_')[1];
		}
		else
		{			
			$('a').removeClass('active');	
			$('.subTab #videoType_'+video_type).addClass('active');
		}
		
        $('#wait').show();
        page = typeof page != "undefined" ? page : $('#page').val();
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&video_type="+video_type,
            url:      '/base/artist/video',
            success: function (data)
            {
                if (data.q == 'ok')
                {
					$('#list').html( data.data );
                    $('#pagging').html(data.pagging);					
                    $('#pagging1').html(data.pagging); 
                }
                $('#wait').hide();
            }
        });
    },
   ShowArtistVideo: function(page)
    {
        $('#wait').show();
        page = typeof page != "undefined" ? page : $('#page').val();		
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "act=video&page="+page,
            url:      window.location.href,
            success: function (data)
            {
                if (data.q == 'ok')
                {
					$('#list').html( data.data );
                    $('#pagging').html(data.pagging);
					
                }
                $('#wait').hide();
            }
        });
    },
   ShowArtistRelatedVideo: function(page)
    {
        $('#wait').show();
        page = typeof page != "undefined" ? page : $('#video_page').val();		
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "act=video&video_page="+page,
            url:      window.location.href,
            success: function (data)
            {
                if (data.q == 'ok')
                {
					$('#list').html( data.data );
                    $('#pagging').html(data.pagging);
					
                }
                $('#wait').hide();
            }
        });
    },	
   Event: function(page)
    {
        $('#wait').show();
        page = typeof page != "undefined" ? page : 1;		
		
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "page="+page+"&ajaxMode=1",
            url:      window.location.href,
            success: function (data)
            {
                if (data.q == 'ok')
                {
					$('#event_list').html( data.data );
                    $('#pagging').html(data.pagging);
					$('#pagging1').html(data.pagging);
					
                }
                $('#wait').hide();
            }
        });
    },

    FansFilter: function()
    {
		var con = $("#country").val();
		var loc = $("#location").val();	
		
		var state = $("#state").val();
		var music_genre = $("#music_genre").val();	
		var gender = $("#gender").val();

		if(con != 'US')
		{
			state = '';
		}
        $.ajax({
            type:          'post',
            dataType:      'json',
		    data:     "location="+loc+"&country="+con+"&state="+state+"&music_genre="+music_genre+"&gender="+gender,
            url:           '/base/artist/Tools',
		   success:function(data)
            {
                if (data.q == 'ok')
                {
					$('#fan_ids').val(data.fan_ids);
					$('#no_fan_err').removeClass('error').html('');
					$('#fans').html(data.data); 
                }
            }
        });
    },
	
    UserEdit: function()
    {
        var options = {
            type:'post',
            dataType:'json',
            clearForm:false,
            resetForm:false,
            url:'/base/user/AdminEditUser',
            beforeSubmit:function ()
            {
                $('#wait').show();
            },
            success:function (data)
            {
				checkResponseRedirect(data);
                $('#wait').hide();
                if (data.q == 'ok')
                {
                    document.location = '/base/user/AdminShowUser?id=' + $('#uid').val();
                }
                else if (data.q == 'err')
                {
                    if (data.errs)
                    {
                        errs = data.errs;
                        oErrors.Show();
                    }
                }
            }
        };
        $('#edit_profile_form').ajaxSubmit(options);
    },

    InitResend: function()
    {
        $('#resend_subm').click(function()
        {
            if(doLoad == 1)
            {
                return;
            }
            if(!verify_email($('#email').val()))
            {
                oErrors.SetBadFld('email', 'This isn\'t a valid address');
            }
            else
            {
                $('#resend_subm').addClass('noactive');
                $('#resend_msg').html('');
                $('#resend_msg').parent().find('strong').html('');
                $('#resend_msg').parent().removeClass('alert_error').removeClass('alert_success').hide();
                doLoad = 1;
                $.ajax({
                    type:     'POST',
                    dataType: 'json',
                    data:     "email="+$('#email').val(),
                    url:      '/base/user/ResendEmail',
                    success: function (data)
                    {
                        oErrors.SetClearFld('email');
                        if (data.q == 'ok')
                        {
                            $('#resend_msg').html('Confirmation email sent to your email address.');
                            $('#resend_msg').parent().find('strong').html('Success!');
                            $('#resend_msg').parent().addClass('alert_success').show();
                            $('#email').val('');
                        }
                        else
                        {
                            $('#resend_msg').html(data.err);
                            $('#resend_msg').parent().find('strong').html('Error!');
                            $('#resend_msg').parent().addClass('alert_error').show();
                        }
                        doLoad = 0;
                        $('#resend_subm').removeClass('noactive');
                    }
                });
            }
        });
    },

    InitForgot: function()
    {
        /*$('#forgot_subm').click(function()
        {*/
            if(doLoad == 1)
            {
                return;
            }
            if(!verify_email($('#email').val()))
            {
                oErrors.SetBadFld('email', 'This is n\'t a valid address');
            }
            else
            {
				
				
                $('#forgot_subm').addClass('noactive');
                $('#forgot_msg').html('');
                $('#forgot_msg').parent().find('strong').html('');
                $('#forgot_msg').parent().removeClass('alert_error').removeClass('alert_success').hide();
                doLoad = 1;
                $.ajax({
                    type:     'POST',
                    dataType: 'json',
                    data:     "email="+$('#email').val(),
                    url:      '/base/user/Forgot',
                    success: function (data)
                    {
                        oErrors.SetClearFld('email');
                        if (data.q == 'ok')
                        {
                            $('#email').val('');	
							$('#infoAlert').html('A message with password change instructions was sent to your email address.');
							$('#infoAlert').dialog({ 
								autoOpen: false, 
								modal: true,
								title:'Success !',
								buttons: {
									'Close' : {
										 "text":'Close', "class": 'button bgrey', "click": function() {
											$(this).dialog('close');
										}
									}
								}
							});
							$('#infoAlert').dialog('open');
							
                        }
                        else
                        {
							$('#infoAlert').html(data.err);
							$('#infoAlert').dialog({ 
								autoOpen: false, 
								modal: true,
								buttons: {
									'Close' : {
										 "text":'Close', "class": 'button bgrey', "click": function() {
											$(this).dialog('close');
										}
									}
								}
							});
							$('#infoAlert').dialog('open');
							
                        }
                        doLoad = 0;
                        $('#forgot_subm').removeClass('noactive');
                    }
                });
            }
        /*});*/
    },

    InitRestore: function()
    {
        var err = 0;
        $('#pass').blur(function(){
            if(jQuery.trim($(this).val()) == "" || jQuery.trim($(this).val()).length < 6)
            {
                oErrors.SetBadFld('pass', 'Your password is too short');
                err = 1;
            }
            else if(jQuery.trim($('#pass2').val()) != '' && jQuery.trim($(this).val()) != jQuery.trim($('#pass2').val()))
            {
                oErrors.SetBadFld('pass2', 'Passwords do not match');
                err = 1;
            }
            else
            {
                oErrors.SetOkFld('pass');
                err = 0;
            }
        });
        $('#pass2').blur(function(){
            if(jQuery.trim($(this).val()) == '')
            {
                oErrors.SetBadFld('pass2', 'Please repeat password');
                err = 1;
            }
            else if(jQuery.trim($('#pass').val()) != jQuery.trim($(this).val()))
            {
                oErrors.SetBadFld('pass2', 'Passwords do not match');
                err = 1;
            }
            else
            {
                oErrors.SetOkFld('pass');
                oErrors.SetOkFld('pass2');
                err = 0;
            }
        });
        $('#restore_subm').click(function()
        {
            if(err == 1)
            {
                return false;
            }
            if(doLoad == 1)
            {
                return false;
            }
            doLoad = 1;
            var options = {
                type:'post',
                dataType:'json',
                clearForm:false,
                resetForm:false,
                url:'/base/user/Restorepass',
                beforeSubmit:function ()
                {
                    $('#restore_subm').addClass('noactive');
                    $('#restore_msg').html('');
                    $('#restore_msg').parent().find('strong').html('');
                    $('#restore_msg').parent().removeClass('alert_error').removeClass('alert_success').hide();
                },
                success:function (data)
                {
					checkResponseRedirect(data);
                    doLoad = 0;
                    $('#restore_subm').removeClass('noactive');
                    oErrors.SetClearFld('pass');
                    oErrors.SetClearFld('pass2');
                    if (data.q == 'ok')
                    {
                        $('#restore_msg').html('A message with password change instructions was sent to your email address.');
                        $('#restore_msg').parent().find('strong').html('Success!');
                        $('#restore_msg').parent().addClass('alert_success').show();
                        document.location.href = '/base/user/passchanged';
                    }
                    else
                    {
                        if (data.errs)
                        {
                            $('#restore_msg').html('Errors found,  please correct the highlighted fields below.');
                            $('#restore_msg').parent().find('strong').html('Error!');
                            $('#restore_msg').parent().addClass('alert_error').show();
                            for (var i in data.errs)
                            {
                                oErrors.SetBadFld(i, data.errs[i]);
                            }
                        }
                    }
                }
            };
            $('#restore_form').ajaxSubmit(options);
        });
    },
    SlideUsersFilter: function(status)
    {

        $('#page').val('1');
    	email = $('#email').val();
    	name = $('#name').val();
    	s_location = $('#location').val();
    	featured = $('#featured').val();
      
	  $.ajax({
            type:     'POST',
            dataType: 'json',    
			data: "email="+email+"&name="+name+"&location="+s_location+"&featured="+featured,
            url:           '/base/user/AdminSlideUsersList',
            success:       function(data)
            {
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
		oUsers.SlideLinkSelectMedia(fun_name);
	},	
   SlideLinkSelectMedia: function(m_type)
    {
        $('#wait').show();
        $.ajax({
            type:     'POST',
            dataType: 'json',    
			data: 	  "id="+u_id,
            url:      '/base/HomeSlide/'+m_type,
            success: function (data)
            {
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
	ReloadNotificationCount: function()
	{
		//alert("im Here Reload notification Count");
		if(doLoad) return;
		doLoad = 1;
        $.ajax({
            type:     'POST',
            dataType: 'json',    
            url:      '/base/Notification/',
            success: function (data)
            {	
				doLoad = 0;
				if(data.q==0){
				//$('#notificationCount').hide();									
					}else {
				//$('#notificationCount').show();															
				$('#notificationCount').html(data.q);				
				}
			}
        });		
			//tm = setTimeout("oUsers.ReloadNotificationCount();", 20000);		
			tm = setInterval(function(){oUsers.ReloadNotificationCount();}, 60000);
		},
	CheckLoginDetails: function()
	{

		$.ajax({
            type:     'POST',
            dataType: 'json',    
            url:      '/base/user/checkNotificationLogin',
            success: function (data)
            {
				if(data.q)
					{
					oUsers.ReloadNotificationCount();
					}
					
			}
        });		
	},
	
	InitRegistrationStep2: function(){
        var err = 0;
		
		$('#reg_step2').submit(function(){
		
            if (!err)
            {
                return true;
            }
            else
            {
				return false;
            }
		});
		
	  $('#add_label').click(function() {
            var obj = $('.rlabel div:first').clone(true);
            $(obj).find('input:text').val('');
            $(obj).appendTo('.rlabel');
        });

        $('.del_label').click(function() {
            if ($('.pitem').length > 1)
            {
                $(this).parents('.pitem').remove();
            }  
            else
            {
                $(this).parents('.pitem').find('input:text').val('');
            }
              
        });
		
		 $('.genres').click(function(){
            var numgenres = $('.genres:checkbox').filter(':checked').length;
            if(numgenres == 0)
            {
                oErrors.SetBadFld('genres', 'You must select genres');
                err = 1;
            }
            else if(numgenres > 3)
            {
                oErrors.SetBadFld('genres', 'You can choose up to 3 genres');
                err = 1;
            }
            else
            {
                oErrors.SetOkFld('genres');
                err = 0;
            }
        });
		 
		 $('#saveAvatar').click(function(){
			var x1 = $('#x1').val();
			var x2 = $('#x2').val();
			var y1 = $('#y1').val();
			var y2 = $('#y2').val();
			var w = $('#w').val();
			var h = $('#h').val();
			if(h)
			{
				$.ajax({
					type:'post',
					url:'/base/user/SaveAvatar',
					data:{ x1: x1, x2:x2, y1: y1, y2:y2, w: w, h: h, rand_id: $('#rand_id').val(), user_id: $('#user_id').val(), ppic: 1},
					dataType: 'json',
					success: function(response){
						checkResponseRedirect(response);
						$(".M10").hide();
						$('#saveAvatar').hide();
						$('#profilePic').hide();
						$('#profilePicSucess').show();
						$('#profilePicSucess').addClass('good').html('Profile Picture Successfully Uploaded');
					
					}
				})
			}
			else
			{
				return false;
			}
	     });
		
	},
	
	
	
	
	
	
	ReportViewersList: function(EventId,UserId,EventTitle)
	{
		$("#ViewersReportList").dialog({
	    autoOpen: false,
	    position: 'center' ,
	    title: 'Viewers Report List :: '+EventTitle,
    	draggable: false,
	    width : 570,
	    height : 300, 
	    resizable : false,
	    modal : true,
		buttons: {
			'Cancel' : {
				 "text":'Cancel', "class": 'button bgrey', "click": function() {
			 		$(this).dialog('close');
			 	}
			 }
			}
	//
		
		});
		$("#ViewersReportList").dialog("open");
	    $("#ViewersReportList").load('/Base/Popup/ViewersReportList/?UserId='+UserId+'&EventId='+EventId, function() {});			
    	$( "#ViewersReportList" ).delegate(".reset_button", "click", function(){
         $( "#ViewersReportList" ).dialog('close');
		});			

	}

}

var doLoad = 0;
var oUsers = new Users();
var tm = 0;
//oUsers.CheckLoginDetails();
