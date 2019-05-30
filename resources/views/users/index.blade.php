@extends('master')

@section ('heading')

	List of Users
	<a href="/users/create"><button type="button" class="btn btn-outline-success">+ New</button></a>
	
@endsection

@section('contents')

<div class="container">
	<table class="table table-striped table-bordered table-sm" id="user_list">

		<thead>
			<tr>
				<th>Name</th> 
				<th>Branch</th>
				<th>Email</th>
		</thead>

		<tbody>
			@foreach ($users as $x)
				<tr>
					<td>{{ $x->name }}</td>
					<td>{{ $x->branch->name }}</td>
					<td>{{ $x->email }}</td>
				</tr>
			@endforeach
		</tbody>

	</table>
</div>


@endsection