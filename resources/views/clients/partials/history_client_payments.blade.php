<table class="table table-sm table-bordered " style="background-color: white; box-shadow: 1px 1px #888888;">
	<tr>
		<td class="text-center align-middle" rowspan="6" style="width: 30%">
			{{ $x->parent->branch->name }}
			<br />
			Payment : {{ $x->parent->py_number }}
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
			{{ $x->parent->notes ? $x->parent->notes : "No Notes" }}
		</td>
	</tr>	

</table>