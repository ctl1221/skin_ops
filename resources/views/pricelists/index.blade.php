@extends('master')

@section('contents')

<table>
	
	@foreach($pricelists as $pricelist)
	<tr>
		<td>{{ $pricelist->name }}</td>
	</tr>
	@endforeach

</table>

@endsection