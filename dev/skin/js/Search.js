
$(document).ready(function ()
{
 	$.ajaxSetup({
		data: {ajaxMode:1}
	});
	if($( "#search_key" ).length) {
		$.widget( "custom.catcomplete", $.ui.autocomplete, {
			_renderMenu: function( ul, items ) {
				var that = this,
				currentCategory = "";
				$.each( items, function( index, item ) {
					if ( item.category != currentCategory ) {
						/*ul.append($('<li class="ui-autocomplete-category '+ item.category+'" id="'+item.id+'"><a class="pink" href="/base/search/search'+item.category+'?search_key='+$('#search_key').val() +'">'+ item.category + '</a></li>').data("item.autocomplete", {}));*/
						ul.append( '<li class="ui-autocomplete-category">'+ item.category + '</li>');
						/*ul.append($("<li class='ui-autocomplete-category " + itemtype + "' id='" + item.searchid + "'><a href='/arama/" + searchkey + "?k=" + searchtype + "&q=" + searchkey + "'>" + item.category + "</a></li>").data("item.autocomplete", {}));*/
						currentCategory = item.category;
					}
					that._renderItem( ul, item );
				});
			}
		});
		$( "#search_key" ).catcomplete({
			delay: 0,
			source: function(request, response) {
			  jQuery.ajax({
				url: "/base/search/AutoSearch",
				type: "post",
				dataType: "json",
				data: {
				  query: request.term, sendData: 1
				},
				success: function(data) {
				  response(jQuery.map(data, function(item) {
					return {
						url: item.link,
						value: item.Title,
						label: item.Title,
						img: item.image,
						id: item.Id,
						category: item.category
					}
				  }))
				}
			  })
			},
			minLength: 1,
			select: function (event, ui) {
				//console.log(ui);
				window.location.href = ui.item.url;
			},
			focus: function(event, ui){
				event.preventDefault();
			},
			open: function() {
				$('<li class="ui-autocomplete-category pink"><a class="pink" href="/base/search/search?search_key='+$( "#search_key" ).val()+'">See All</a></li>').prependTo('ul.ui-autocomplete');
			}
		}).data("catcomplete")._renderItem = function (ul, item) {
        return $("<li>").data("item.autocomplete", item).append("<a>" + item.label + "</a>").appendTo(ul);
    	};
	}
});