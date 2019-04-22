@extends('master')

@section('heading')

	Pricelists

	<a href="/pricelists/create"><button type="button" class="btn btn-outline-success">+ New</button></a> 
	<a href="/pricelists/edit"><button type="button" class="btn btn-outline-warning">Edit</button></a>
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
			@foreach ($pricelists as $x)
				<tr>

					<td>{{ $x->name }}</td>

					@if($x->is_active)
			        <td><span class="badge badge-success">Active</span></td>
			        @else
			        <td><span class="badge badge-danger">Inactive</span></td>
			        @endif
			        
			        <td>
			        @if($x->is_active)
					<a href="/pricelists/{{ $x->id }}/deactivate"><button type="button" class="btn btn-outline-danger btn-sm">Deactivate</button></a>
					@else
					<a href="/pricelists/{{ $x->id}}/activate"><button type="button" class="btn btn-outline-success btn-sm">Activate</button></a>
			        @endif
					</td>

				</tr>
				
			@endforeach
		</tbody>

	</table>

@endsection