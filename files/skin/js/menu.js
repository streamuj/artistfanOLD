(function($) { 
	$.fn.extend({
		Menu: function()
		{
		
		var elements = $('li', this);
		var nested = null
		$('li', this).hover(function(){
			$(this).addClass('hover');
		}, function(){
			$(this).removeClass('hover');
		});
		for (var i=0; i<elements.length; i++)
		{
			var element = elements[i];
			//find nested UL
			nested = $('ul', element);
			if(!nested) {
				continue;
			}

			//declare width
			var offsetWidth  = 0;
			nestedLi = $('li',nested);

			//find longest child
			for (k=0; k < nestedLi.length; k++) {
				var node  = nestedLi[k];
				offsetWidth = (offsetWidth >= node.offsetWidth) ? offsetWidth :  node.offsetWidth;
			}

			//match longest child
			for (k=0; k < nestedLi.length; k++) {
				var node  = nestedLi[k];
				$(node).width(offsetWidth+'px');
			}
			$(nested).width(offsetWidth+'px');
		}
	}
});
})(jQuery);



/*


	$('body').on('keypress', '.wallComment',  function(e){
		//Check for enter key
		noOfLines = 3;
		var thisObj = $(this);
		var lineHeight = parseInt(thisObj.css('line-height').substr(0, 2), 10);
		var adjustedHeight = thisObj[0].clientHeight;
		var maxHeight = lineHeight * noOfLines;
		if (maxHeight > adjustedHeight) {			
			adjustedHeight = Math.max(thisObj[0].scrollHeight, adjustedHeight);
			adjustedHeight = Math.min(maxHeight, adjustedHeight);
			if (adjustedHeight > thisObj[0].clientHeight) {
				thisObj.css('height',adjustedHeight +'px');
				thisObj.height(currentChatAreaHeight);
				thisObj.css('overflow','hidden');
			}
		} else {
			thisObj.css('overflow','auto');
		}

});	

*/

