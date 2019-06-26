@extends('master')

@section ('heading')

List of Users
<a href="/users/create"><button type="button" class="btn btn-outline-success">+ New</button></a>

@endsection

@section('contents')

<table class="table table-striped table-bordered table-sm text-center" id="user_list">

	<thead>
		<tr>
			<th>Name</th> 
			<th>Branch</th>
			<th>Email</th>
			<th>Update Password</th>
			<th>Roles</th>
		</thead>

		<tbody>
			@foreach ($users as $x)
			<tr>
				<td>{{ $x->name }}</td>
				<td>{{ $x->branch->name }}</td>
				<td>{{ $x->email }}</td>
				<td>
					<form method="post" action="userpass" class="form-inline justify-content-center">
						@csrf
						<input type="hidden" name="user_id" value="{{ $x->id }}">
						<input type="password" name="new_password" class="form-control-sm">

						<button class="btn btn-sm btn-warning">Update</button>
					</form>
				</td>
				<td>

					<form method="post" action="userroles" class="form-inline justify-content-center">
						@csrf
						<input type="hidden" name="user_id" value="{{ $x->id }}">

						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="sales" name="sales" {{ $x->hasRole('sales') ? "checked" : ""}}>
						  <label class="form-check-label" for="sales">Sales</label>
						  
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="management" name="management" {{ $x->hasRole('management') ? "checked" : ""}}>
						  <label class="form-check-label" for="management">Management</label>
						  
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="admin" name="admin" {{ $x->hasRole('admin') ? "checked" : ""}}>
						  <label class="form-check-label" for="admin">Admin</label>
						</div>

						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="checkbox" id="it" name="it" {{ $x->hasRole('it') ? "checked" : ""}}>
						  <label class="form-check-label" for="it">IT</label>
						</div>

						<button class="btn btn-sm btn-warning">Update</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>

	</table>

	@endsection

	@include('flash')