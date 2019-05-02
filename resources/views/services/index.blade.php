@extends ('master')

@section ('heading')
	
	List of Services
	<a href="/services/create"><button type="button" class="btn btn-outline-success">+ New</button></a> 

@endsection

@section ('contents')

	<table class="table table-bordered table-sm">
		<thead class="thead-light">
			<tr>
				<th>Name</th>
				<th>Status</th>
			</tr>
		</thead>

		<tbody>
		@foreach ($services as $x)
			<tr>
				<td><a class="text-secondary" href="/services/{{ $x->id }}">{{ $x->name }} </a></td>
				<td>
	        		<span class="badge {{ $x->is_active ? 'badge-success': 'badge-danger' }}">
	        		{{ $x->is_active ? 'Active' : 'Inactive' }} 
	        		</span>
	        	</td>
	        </tr>
		@endforeach
		</tbody>

	</table>

	{{ $services->links() }}	

@endsection


