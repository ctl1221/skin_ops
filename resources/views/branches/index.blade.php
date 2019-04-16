@extends('master')

@section('heading')

	List of Branches 

	<a href="/branches/create"><button type="button" class="btn btn-outline-success">+ New</button></a> 
	<a href="/branches/edit"><button type="button" class="btn btn-outline-warning">Edit</button></a>
	
@endsection

@section('contents')
	
	<table class="table table-bordered table-sm">
		<thead class="thead-light">
			<tr> 
				<th>Name</th>
				<th>Status</th>
				<th>Edit Status</th>
			</tr>
		</thead>	
	
		<tbody>

			@foreach($branches as $x)
				<tr>
					<td> {{$x->name}} </td>

					<td>
			        	<span class="badge {{ $x->is_active ? 'badge-success': 'badge-danger' }}">
			        		{{ $x->is_active ? 'Active' : 'Inactive' }} 
			        	</span>
			        </td>

			        <td>
			        	@if($x->is_active)
							<form method="POST" action="/branches/{{$x->id}}/deactivate">
							@csrf
							<input type="submit" class="btn btn-outline-danger" value="Deactivate">
							</form>
		
						@else
							<form method="POST" action="/branches/{{$x->id}}/activate">
								@csrf
								<input type="submit" class="btn btn-outline-success" value="Activate">
							</form>
						@endif
					</td>
				</tr>
			@endforeach

		</tbody>

	</table>

@endsection
