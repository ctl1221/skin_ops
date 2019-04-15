@extends('master')

@section('contents')

	<table class="table table-bordered table-sm">
		<thead class="thead-light">
			<tr>
				<th>Name</th>
				<th>Status</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($pricelists as $pricelist)
			<tr>
				<td>{{ $pricelist->name }}</td>

				<td>
	        		<span class="badge {{ $pricelist->is_active ? 'badge-success': 'badge-danger' }}">
	        		{{ $pricelist->is_active ? 'Active' : 'Inactive' }} 
	        		</span>
	        	</td>
			</tr>
			@endforeach
		</tbody>

	</table>

@endsection