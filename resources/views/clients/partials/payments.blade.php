<div class="card">
	<div class="card-body">
		<table class="table table-bordered table-sm text-center align-middle">
			<tr>
				<th>Date</th>
				<th>Type</th>
				<th>Amount</th>
				<th>Running Balance</th>
			</tr>
		@php
			$rt = 0;
		@endphp
		@foreach($payments as $x)
			@if($x->parent_type == 'App\\SalesOrder')
				<tr>
					<td rowspan="3">
						{{ $x->date}}
					</td>
				</tr>
				@if($x->parent->totalprice && $x->parent->is_posted)
					<tr>
						<td>
							Billed
						</td>
						<td>
							PHP {{number_format($x->parent->totalprice,2) }}
						</td>
						<td>
							PHP {{ number_format($rt += $x->parent->totalprice,2) }}
						</td>
					</tr>
				@endif

				@if($x->parent->total_pay() && $x->parent->is_posted)
					<tr>
						<td>
							Payed
						</td>
						<td>
							PHP {{ number_format($x->parent->total_pay(),2) }}
						</td>
						<td>
							PHP {{ number_format($rt -= $x->parent->total_pay(),2) }}
						</td>
					</tr>
				@endif

			@elseif($x->parent_type == 'App\\Payment')
				<tr>
					<td>
						{{ $x->date}}
					</td>
					<td>
						Payed
					</td>
					<td>
						PHP {{ number_format($x->parent->amount,2) }}
					</td>
					<td>
						PHP {{ number_format($rt -= $x->parent->amount,2) }}
					</td>
				</tr>
			@endif
		@endforeach
		</table>
	</div>
</div>