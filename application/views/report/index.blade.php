@layout('master')

@section('container')
<form id="report-jumat" method="GET" action="http://mesjid.local.dev:8888/accounts/report/" class="form-horizontal">
	<div class="control-group">
		{{ Form::label('account_id', 'Account', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::select('account_id', $accounts, array()) }}
		</div>
	</div>
	
	<div class="control-group">
		{{ Form::label('periode', 'Periode', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::select('periode', array('daily' => 'Daily', 'weekly' => 'Weekly', 'monthly' => 'Monthly'), array()) }}
		</div>
	</div>
	
	<div class="control-group">
		{{ Form::label('date', 'Report Date', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('date', date('Y-m-d'), array('class' => 'datepick')) }}
		</div>
	</div>
	
	<div class="control-group">
		<div class="controls">
			<div class="btn-group">
				{{ Form::submit('Submit', array('class' => 'btn')) }}
			</div>
		</div>
	</div>
</form>
@endsection

@section('javascript')
<script type="text/javascript">
	// $('#report-jumat').on('submit', function (e) {
	// 	e.preventDefault();
	// 	// alert('done');

	// 	e.stopPropagation();
	// });
	// $('#form-module').on('submit',function (e) {
	// 	e.preventDefault();
	// 	var jsonUrl = '';
	// 	jsonUrl = '../../groups/add_module/';
	// 	$.ajax({
	// 		url: jsonUrl,
	// 		cache: false,
	// 		type: 'POST',
	// 		data : JSON.stringify($(this).serializeObject()),
	// 		success: function(json) {
	// 			alert('done');
	// 			tableModule.fnReloadAjax();
	// 		}
	// 	});
	// 	$(this).clearForm();
	// 	$('#module_id').val('')
	// 	// console.log(JSON.stringify($(this).serializeObject()));
	// 	$("#modal-module").modal('hide');
	// });
</script>
@endsection