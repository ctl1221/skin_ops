@extends('master')

@section('heading')

	List of Categories 

	<a href="/categories/create"><button type="button" class="btn btn-outline-success">+ New</button></a> 

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

			@foreach($categories as $x)
				<tr>
					<td> 
						<a href="/categories/{{ $x->id}}">{{$x->name}}</a>
					</td>

					<td>
			        	<span class="badge {{ $x->is_active ? 'badge-success': 'badge-danger' }}">
			        		{{ $x->is_active ? 'Active' : 'Inactive' }} 
			        	</span>
			        </td>

			        <td>
			        	<span class="form-inline">
			        	<a href="/categories/{{$x->id}}/edit"><button type="button" class="btn btn-outline-warning btn-sm">Edit</button></a>
			        	&nbsp;&nbsp;
			        	@if($x->is_active)
							<form method="POST" action="/branches/{{$x->id}}/deactivate">
							@csrf
							<input type="submit" class="btn btn-outline-danger btn-sm" value="Deactivate">
							</form>
		
						@else
							<form method="POST" action="/categories/{{$x->id}}/activate">
								@csrf
								<input type="submit" class="btn btn-outline-success btn-sm" value="Activate">
							</form>
						@endif
						</span>
					</td>
				</tr>
			@endforeach

		</tbody>

	</table>

@endsection
