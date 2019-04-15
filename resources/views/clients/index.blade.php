@extends('master')

@section('contents')



<table>

	@foreach ($clients as $x)
		<tr>
			<td><a href="/clients/{{ $x->id }}">{{ $x->last_name }}<a></td>
			<td>{{ $x->first_name }}</td>
		</tr>
	@endforeach

</table>

@endsection
