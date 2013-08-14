function Errors()
{

}


Errors.prototype =
{
    __construct:function ()
    {
        $(document).ready(function ()
        {

        });
    },

    /**
     * Registration page
     */
    Show:function ()
    {
        if (errs != '')
        {
            for (var i in errs)
            {
                $('#err_' + i).html('<div class="error">' + errs[i] + '</div>');
            }
        }
    },

    ShowInOne:function( div_id )
    {
        if (errs != '')
        {
            var s = '';
            for (var i in errs)
            {
                s += ( (s != '')  ? '<br />' : '' ) + errs[i];
            }
            $('#'+div_id).html( s );
            $('#'+div_id).parent().show();
        }
    },

    SetBadFld: function(id, msg) {
        $('#err_' + id).html('<div class="error">' + msg + '</div>');
    },

    SetOkFld: function(id, msg) {
        if(msg != undefined)
        {
            $('#err_' + id).html('<div class="good">' + msg + '</div>');
        }
        else
        {
            $('#err_' + id).html('<div class="good">&nbsp;</div>');
        }
    },

    SetClearFld: function(id) {
        $('#err_' + id).html('');
    },

    SetWaitFld: function(id) {
        $('#err_' + id).html('<div class="wait">&nbsp;</div>');
    }


}

var oErrors = new Errors();