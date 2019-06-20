<div class="card">
	<div class="card-body bg-light">

		@if(!$client->sales_orders->where('is_posted')->count())
			<center>No Records Found</center>
		@else

		<table class="table table-sm my_table_shadow">
			<tr>
				<th class="text-center">Date</th>
				<th class="text-center">Reference</th>				
				<th class="text-center">Branch</th>
				<th class="text-center">Purchased Product/Service</th>
				<th class="text-center">Price</th>
				<th class="text-center">Total Amount</th>
				<th class="text-center">Sold By</th>
			</tr>

			@foreach ($client->sales_order_lines as $x)
				@if($x->sales_order->is_posted)
					<tr>
						<td class="text-center">{{ \Carbon\Carbon::parse ($x->sales_order->date) ->toFormattedDateString() }}</td>
						<td class="text-center">{{ "SO " . $x->sales_order->so_number }}</td>
						<td class="text-center">{{ $x->sales_order->branch->name }}</td>
						<td class="text-center">{{ $x->sellable->name }}</td>
						<td class="text-center">{{ "PHP " . number_format($x->price, 2) }}</td>
						<td class="text-center">{{ "PHP " . number_format($x->sales_order->total_price(), 2) }}</td>
						<td class="text-center">{{ $x->seller ? $x->seller->display_name() : '---' }}</td>
					</tr>
				@endif
			@endforeach
		</table>

		@endif

	</div>
</div>
