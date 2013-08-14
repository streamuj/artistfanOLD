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
            if (jQuery.trim($("#system_login").val()) == "" || 
                !verify_email($("#system_login").val()))
            {
                $('#system_login').parents('tr').find('td:last').html('<div class="error">Please enter your e-mail</div>');
                er = 1;
            }
            else
            {
                $('#system_login').parents('tr').find('td:last').html('<div class="good">&nbsp;</div>');
            }

            if (jQuery.trim($("#system_pass").val()) == "")
            {
                $('#system_pass').parents('tr').find('td:last').html('<div class="error">Please enter your password</div>');
                er = 1;
            }
            else
            {
                $('#system_pass').parents('tr').find('td:last').html('<div class="good">&nbsp;</div>');
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
                        $('#follow').html('<span style="color:green;" class="fl_right">Followed</span>');
                        if(oldnum >= 0)
                        {
                            oldnum++;
                            $('#fanscount').html(oldnum);
                        }
                    }
                    else if (data.data == 2)
                    {
                        //unfollowed
                        $('#follow').html('<span style="color:red;" class="fl_right">Unfollowed</span>');
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
                oErrors.SetBadFld('pass', 'The passwords are not matched');
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

        $(':checkbox[name=fm[genres]]').click(function(){
            var numgenres = $(':checkbox[name=fm[genres]]').filter(':checked').length;
            if(numgenres == 0)
            {
                oErrors.SetBadFld('genres', 'You must select genres');
                err = 1;
            }
            else if(numgenres > 5)
            {
                oErrors.SetBadFld('genres', 'You can choose to not more than 5 genres');
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
                    var st = sel == 1 ? $(':radio[name=status]').filter(':checked').val() : (sel == 2 ? $('#status').val() : 0);
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
                           document.location = '/reg/select/';
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
                           document.location = '/';
                       }
                   }
               }
               else
               {
                   if(data.err)
                   {
                       alert(data.err);
                   }
               }
           }
       });
    },

    TwtGetAuthUrl: function(sel)
    {
        var sel = undefined == sel ? 0 : sel;
        var st = sel ? $(':radio[name=status]').filter(':checked').val() : (sel == 2 ? $('#status').val() : 0);
        st = (undefined == st) ? 0 : st;
        $.ajax({
            type:'POST',
            dataType:'json',
            cache:false,
            data:{"st":st},
            url:'/base/user/TwtGetAuthUrl',
            success:function (data)
            {
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
        setTimeout("oUsers.UsersList()", 10000);
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

    FansFilter: function()
    {
        var options = {
            type:          'post',
            dataType:      'json',
            clearForm:     false,
            resetForm:     false,
            url:           '/base/artist/Tools',

		   success:       function(data)
            {
                if (data.q == 'ok')
                {
					$('#fans').html(data.data);
                    
                }
            }
        };
	  $('#fanlist').ajaxSubmit(options);
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
        $('#forgot_subm').click(function()
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
                            $('#forgot_msg').html('A message with password change instructions was sent to your email address.');
                            $('#forgot_msg').parent().find('strong').html('Success!');
                            $('#forgot_msg').parent().addClass('alert_success').show();
                            $('#email').val('');
                        }
                        else
                        {
                            $('#forgot_msg').html(data.err);
                            $('#forgot_msg').parent().find('strong').html('Error!');
                            $('#forgot_msg').parent().addClass('alert_error').show();
                        }
                        doLoad = 0;
                        $('#forgot_subm').removeClass('noactive');
                    }
                });
            }
        });
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
    }
}

var doLoad = 0;
var oUsers = new Users();
