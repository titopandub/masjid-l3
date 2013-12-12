// restfulizer.js

/**
 * Restfulize any hiperlink that contains a data-method attribute by
 * creating a mini form with the specified method and adding a trigger
 * within the link.
 * Requires jQuery!
 *
 * Ex:
 *     <a href="post/1" data-method="delete">destroy</a>
 *     // Will trigger the route Route::delete('post/(:id)')
 * 
 */
$(function(){
    $('[data-method]').append(function(){
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' style='display:none'>\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "</form>\n"
    })
    .removeAttr('href')
    .attr('style','cursor:pointer;')
    .on('click', function (ev) {
		var $a = $(this);
		ev.preventDefault();
		$("#delete-dialog").dialog({
			buttons : {
				"Confirm" : function() {
					$a.find("form").submit();
				},
				"Cancel" : function() {
					$("#delete-dialog").dialog("close");
				}
			}
		});

		$("#delete-dialog").dialog("open");
		ev.stopPropagation();
	});

	$("#delete-dialog").dialog({
		autoOpen: false,
		modal: true
	});
});