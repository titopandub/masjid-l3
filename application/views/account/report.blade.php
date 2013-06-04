@layout('master')
	<?php 
	$total_donation = 0;
	$total_expense = 0;
	$yesterday = 3600 * 24;
	$last_week_date = date('Y-m-d', strtotime($week['start']) - $yesterday );
	?>
@section('container')
<button class="btn pull-right print">Print</button>
<div class="clearfix"></div>
<div id="main-container">
	<h3 class="report-header">Laporan Keuangan<br>{{ $account->name }} Al-Muttaqin</h3>

	<h4>Periode: {{ AppHelper::date($week['start'], 'j F Y') }} - {{ AppHelper::date($week['end'], 'j F Y') }}</h4>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Keterangan</th>
				<th class="money">Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2"><strong>Pemasukan</strong></td>
			</tr>
			<tr>
				<td>Saldo Tanggal {{ AppHelper::date($last_week_date, 'j F Y') }}</td>
				<td class="money">{{ AppHelper::idr_format($last_week_balance) }}</td>
				<?php $total_donation += $last_week_balance; ?>
			</tr>
		@forelse ($donations as $donation)
			<tr>
				<td>{{ $donation->remark . " - " . AppHelper::date($donation->donation_date) }}</td>
				<td class="money">{{ AppHelper::idr_format($donation->amount) }}</td>
			</tr>
			<?php $total_donation += $donation->amount; ?>
		@empty
			<tr>
				<td>-</td>
				<td class="money">{{ AppHelper::idr_format(0) }}</td>
			</tr>
		@endforelse
			<tr>
				<td><strong class="pull-right">Total Pemasukan</strong></td>
				<td class="money">{{ AppHelper::idr_format($total_donation) }}</td>
			</tr>
			<tr>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td colspan="2"><strong>Pengeluaran</strong></td>
			</tr>
		@forelse ($expenses as $expense)
			<tr>
				<td>{{ $expense->remark . " - " . AppHelper::date($expense->expense_date) }}</td>
				<td class="money">{{ AppHelper::idr_format($expense->amount) }}</td>
			</tr>
			<?php $total_expense += $expense->amount; ?>
		@empty
			<tr>
				<td>-</td>
				<td class="money">{{ AppHelper::idr_format(0) }}</td>
			</tr>
		@endforelse
			<tr>
				<td><strong class="pull-right">Total Pengeluaran</strong></td>
				<td class="money">{{ AppHelper::idr_format($total_expense) }}</td>
			</tr>
			<tr>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td><strong class="pull-right">Saldo Akhir, {{ AppHelper::date($week['end'], 'j F Y') }}</strong></td>
				<td class="money">{{ AppHelper::idr_format($end_balance) }}</td>
			</tr>
		</tbody>
	</table>

	<br>

	<div>Dilaporkan, {{ AppHelper::date($week['end'], 'j F Y') }}</div>
	<div class="position-sign row-fluid">
		<div class="two-third span8">Sekretaris</div>
		<div class="one-third span4">Bendahara</div>
	</div>
	<div class="name-sign">
		<div class="two-third span8">Tito Pandu B.</div>
		<div class="one-third span4">Bambang</div>
	</div>
</div>



@endsection

@section('javascript')
<script type="text/javascript">
	$('.print').click(function(e) {
		$('#main-container').printElement({
			overrideElementCSS: [
				{ href: '/css/print.css', media:'print'}
			],
			pageTitle: $('h3.report-header').val() + '.html'
		});
	});
</script>
@endsection

