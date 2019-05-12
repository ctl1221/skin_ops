@extends('master')

@section ('heading')

	List of Memberships
	<a href="/memberships/create"><button type="button" class="btn btn-outline-success">+ New</button></a>
	
@endsection

@section('contents')

<div class="container">
	<table class="table table-striped table-bordered table-sm" id="client_list">

		<thead>
			<tr>
				<th>Name</th>
				<th>Days Valid</th>
				<th>Status</th>
		</thead>

		<tbody>
			@foreach ($memberships as $x)
				<tr>
					<td>{{ $x->name }}</td>
					<td>{{ $x->days_valid }}</td>
					<td>
		        		<span class="badge {{ $x->is_active ? 'badge-success': 'badge-danger' }}">
		        		{{ $x->is_active ? 'Active' : 'Inactive' }} 
		  				</span>
		        	</td>
				</tr>
			@endforeach
		</tbody>

	</table>
</div>

{{ $memberships->links() }}

@endsection
