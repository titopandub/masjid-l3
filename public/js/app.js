$(function () {
	$("#dialog").dialog({
		autoOpen: false,
		modal: true
	});

	$('.datepick').datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true });

	$('.disabled').click(function (e) {
		e.preventDefault();
	});

	var tableJS = $('.table-js').dataTable({
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"sPaginationType": "bootstrap",
		"bLengthChange": true,
		"bPaginate": true,
		"bFilter": true,
		"bSort": true,
		"bInfo": false,
		"bAutoWidth" : false,
		"bRetrieve" : true,
	});
	
	var tableModule = $('#table-module').dataTable({
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"sPaginationType": "bootstrap",
		"bLengthChange": false,
		"bPaginate": false,
		"bFilter": false,
		"bSort": true,
		"bInfo": false,
		"bAutoWidth" : false,
		"bRetrieve" : true,
		"bProcessing": true,
		"sAjaxSource": "../../modules/show/" + $('#id').val(),
		"aoColumns": [
			{ "mDataProp": "order" },
			{ "mDataProp": "name" },
			{ "mDataProp": "controller" },
			{ "mDataProp": "description" },
			{ "mDataProp": "updated_at" },
		],
		"aoColumnDefs": [
			{
				"fnRender": function(oObj, sVal) {
					return "<a href=\"#\" class=\"btn btn-small delete\">Delete</a>";
				},
				"aTargets": [4]
			}
		]
	});

	$('#add-module').click(function (e) {
		e.preventDefault();
		$("#modal-module").modal('show');
		e.stopPropagation();
	});

	$('#form-module').on('submit',function (e) {
		e.preventDefault();
		var jsonUrl = '';
		jsonUrl = '../../groups/add_module/';
		$.ajax({
			url: jsonUrl,
			cache: false,
			type: 'POST',
			data : JSON.stringify($(this).serializeObject()),
			success: function(json) {
				alert('done');
				tableModule.fnReloadAjax();
			}
		});
		$(this).clearForm();
		$('#module_id').val('')
		// console.log(JSON.stringify($(this).serializeObject()));
		$("#modal-module").modal('hide');
	});

	$('#table-module tr td .delete').livequery('click', function(e) {
		e.preventDefault();
		var data = tableModule.fnGetData($(this).parent().parent().get(0));
		$("#dialog").dialog({
			buttons : {
				"Confirm" : function() {
					console.log(data.pivot.id);
					var jsonUrl = '';
					jsonUrl = '../../groups/delete_module/';
					$.ajax({
						url: jsonUrl,
						cache: false,
						type: 'POST',
						data : JSON.stringify(data.pivot),
						success: function(json) {
							$("#dialog").dialog("close");
							tableModule.fnReloadAjax();
						}
					});
				},
				"Cancel" : function() {
					$("#dialog").dialog("close");
				}
			}
		});

		$("#dialog").dialog("open");
		e.stopPropagation();
	});
	
});