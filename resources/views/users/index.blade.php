@extends('master')

@section ('heading')

List of Users
<a href="/users/create"><button type="button" class="btn btn-outline-success">+ New</button></a>

@endsection

@section('contents')

<table class="table table-striped table-bordered table-sm" id="user_list">

	<thead>
		<tr>
			<th>Name</th> 
			<th>Branch</th>
			<th>Email</th>
			<th>Update Password</th>
		</thead>

		<tbody>
			@foreach ($users as $x)
			<tr>
				<td>{{ $x->name }}</td>
				<td>{{ $x->branch->name }}</td>
				<td>{{ $x->email }}</td>
				<td>

					<form method="post" action="userpass" class="form-inline">

						@csrf
						<input type="hidden" name="user_id" value="{{ $x->id }}">
						<input type="text" name="new_password" class="form-control-sm">

						<button class="btn btn-sm btn-warning">Update</button>


					</form>

				</td>
			</tr>
			@endforeach
		</tbody>

	</table>

	@endsection

	@include('flash')