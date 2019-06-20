@extends('master')

@section ('heading')

	List of Payment Types

	<a href="/payment_types/create"><button type="button" class="btn btn-outline-success">+ New</button></a>
	
@endsection

@section('contents')

	<table class="table table-bordered table-sm text-center">

		<thead class="thead-light">
			<tr>
				<th>Name</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($payment_types as $x)
				<tr>
					<td>{{ $x->name }}</td>

					<td>
		        		<span class="badge {{ $x->is_active ? 'badge-success': 'badge-danger' }}">
		        		{{ $x->is_active ? 'Active' : 'Inactive' }} 
		  				</span>
		        	</td>

		        	<td>
		        		<span class="justify-content-center form-inline">
			        	@if($x->is_active)
							<form method="POST" action="/payment_types/{{$x->id}}/deactivate">
								@csrf
							<input type="submit" class="btn btn-sm btn-outline-danger" value="Deactivate">
							</form>
		
						@else
							<form method="POST" action="/payment_types/{{$x->id}}/activate">
								@csrf
							<input type="submit" class="btn btn-sm btn-outline-success" value="Activate">
							</form>
						@endif
						<a href="/payment_types/{{$x->id}}/edit"><button type="button" class="btn btn-sm btn-outline-warning">Edit</button></a>
						</span>
					</td>

				</tr>

			@endforeach
		</tbody>

	</table>
@endsection
