<table class="table table-sm table-bordered my_table_shadow">
	<tr>
		<td rowspan="6" width="1%" bgcolor="{{ $x->parent->branch->color }}"></td>
		<td rowspan="6" width="1%" bgcolor="{{ $colors['Payment Color'] }}"></td>
		<td class="text-center align-middle" rowspan="6" style="width: 30%">
			{{ $x->parent->branch->name }}
			<br />
			Payment : <a href="/payments/{{ $x->parent_id }}">{{ $x->parent->py_number }}</a>
			<br />
			PHP {{ number_format($x->parent->amount,2)}}
			<br />
			{{  \Carbon\Carbon::parse($x->date)->toFormattedDateString() }}
		</td>
	</tr>
	<tr>
		<td>
			{{ $x->parent->payment_type->name }}
		</td>
	</tr>

	<tr>
		<td>
			{{ $x->parent->reference ? $x->parent->reference : "No Reference" }}
		</td>
	</tr>	

	<tr>
		<td rowspan="3">
			{!! nl2br($x->parent->notes ? $x->parent->notes : "No Notes") !!}
		</td>
	</tr>	

</table>