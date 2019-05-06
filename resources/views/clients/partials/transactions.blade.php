
<div class="card">
	<div class="card-body">
		{{-- @if(count($product_sales))
		<table class="table table-sm">
			<tr>
				<th class="text-center">Reference</th>
				<th class="text-center">Date</th>
				<th class="text-center">Branch</th>
				<th class="text-center">Product Name</th>
				<th class="text-center">Product Price</th>
				<th class="text-center">Quantity</th>
				<th class="text-center">Total Amount</th>
				<th class="text-center">Sold By</th>
			</tr>

			@foreach ($product_sales as $x)
			<tr>
				<td class="text-center">{{ $x->REF }}</td>
				<td class="text-center">{{ \Carbon\Carbon::parse ($x-> SALES_DATE) ->toFormattedDateString() }}</td>
				<td class="text-center">{{ $x->BRANCH_NAME }}</td>
				<td class="text-center">{{ $x->PRODUCT_NAME }}</td>
				<td class="text-center">{{ "PHP " . number_format($x->PRODUCT_PRICE,2) }}</td>
				<td class="text-center">{{ $x->QUANTITY }}</td>
				<td class="text-center">{{ "PHP " . number_format($x->TOTAL,2) }}</td>
				<td class="text-center">{{ $x->LAST_NAME . ", " . $x->FIRST_NAME }}</td>
			</tr>
			@endforeach
		</table>

		@else
		<h6 class="text-center">No Records Found.</h6>
		@endif --}}

	</div>
</div>