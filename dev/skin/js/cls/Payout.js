function Payout()
{

}


Payout.prototype =
{
    __construct:function ()
    {
        $(document).ready(function ()
        {
            
        });
    },
	    paypalApproval : function(page)
		{
			
			
        if(doLoadAdmin == 1)
        {
            return;
        }
        doLoadAdmin = 1;
		var id = 0;
        $.ajax({
            type:     'POST',
            dataType: 'json',
            data:     "id="+id,
            url:      '/base/payout/approval',
            success: function (data)
            {
				alert(data);
            }
        });
    
			
		}
	
}

var doLoadAdmin = 0;
var oPayout = new Payout;
