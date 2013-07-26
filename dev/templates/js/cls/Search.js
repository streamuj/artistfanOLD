/**
 * Search js controller
 *
 */
 

function Search()
{

}


Search.prototype =
{
    __construct:function ()
    {
        $(document).ready(function ()
        {
        });
    },

 	SearchResult: function()
    {
		alert("serch .. ..");
		var search_post = $('#search_post').val();
		alert(search_post);
		
		var search_v = 1;
		
        var options = {
            type:'post',
            dataType:'json',
			data:{'search_v': search_v, 'search_post' : search_post },
            url:'/base/index/search',
            success:function (data)
            {
				alert("dsdd");
                if (data.q == 'ok')
                {
                    $('#search_result').html('Searched Reuslt...');
                }
                else
                {
                    if (data.errs)
                    {
                       $('#search_result').html('Error in Search Reuslt.');
                    }
                }
            }
			
        };
        $('#search_form').ajaxSubmit(options);        
    }  
}
var oSearch = new Search();
var tm = 0;
var doReload = 0;
var doReloadM = 0;
var doReloadF = 0;
