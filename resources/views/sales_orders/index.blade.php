@extends('master')

@section('contents')

<table>

	@foreach ($sales_orders as $x)
		<tr>
			<td>{{ $x->so_number }}</td>
		</tr>
	@endforeach

</table>

@endsection