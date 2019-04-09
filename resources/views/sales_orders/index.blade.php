@extends('master')

@section('contents')

<table class="table">

	@foreach ($sales_orders as $x)
		<tr>
			<td>{{ $x->so_number }}</td>
			<td>
				<form action="/sales_orders/{{ $x->id }}" method="POST">
					@csrf
					@method('delete')
					<input type="submit">
				</form>

			</td>
		</tr>
	@endforeach

</table>

@endsection