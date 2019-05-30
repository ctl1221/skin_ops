<table class="table table-sm table-bordered ">
	<tr>
		<td class="text-center align-middle" rowspan="5" style="width: 30%">
			{{ $x->parent->branch->name }}
			<br />
			Sales Order : <a href="/sales_orders/{{ $x->parent->id }}">{{ $x->parent->so_number }}</a>
			<br />
			PHP {{ number_format($x->parent->totalprice,2)}}
			<br />
			{{  \Carbon\Carbon::parse($x->date)->toFormattedDateString() }}
		</td>
	</tr>
	<tr>
		<td class="align-middle">
			Bought/Availed &nbsp;
			@foreach($x->parent->sales_order_lines as $y)
			@if($loop->count != 1 && $loop->last)
			and
			@endif
			{{ $y->sellable->name }}
			@if($loop->count != 1 && !$loop->last)
			,&nbsp;
			@endif
			@endforeach
		</td>
	</tr>

	<tr>
		<td>
			@if( $x->parent->payments->count() )
			@foreach( $x->parent->payments as $z)
			@if($z->payment_type->is_subtractable)
			Less: <u>{{ $z->payment_type->name }}</u> - <b>{{ number_format($z->amount,2) }}</b><br/>
			@endif
			@endforeach
			@else
			No Less
			@endif
		</td>
	</tr>	

	<tr>
		<td>
			@if( $x->parent->payments->count() )
				@foreach( $x->parent->payments as $z)
					@if($z->payment_type->is_direct)
						Paid: <u>{{ $z->payment_type->name }}</u> - 
						<b>{{ number_format($z->amount,2) }}</b>
					@endif
				@endforeach
				@else
				No Payments
			@endif
		</td>
	</tr>	

	<tr>
		<td>
			Payables: {{ number_format($x->parent->payableamount, 2) }}
		</td>
	</tr>	

</table>