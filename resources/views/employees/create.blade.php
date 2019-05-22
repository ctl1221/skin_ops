@extends('master')

@section ('heading')
	Add New Employee
@endsection

@section ('contents')

	<div class="container">

	<form method="post" action="/employees">
		@csrf

	  <div class="form-group">
	    <label for="first_name">First Name:</label>
	    <input type="text" class="form-control" id="first_name" name="first_name" required>
	  </div>

	  <div class="form-group">
	    <label for="last_name">Last Name:</label>
	    <input type="text" class="form-control" id="last_name" name="last_name" required>
	  </div>

	  <div class="form-group">
		<label for="branch">Select Branch:</label>
		<select class="form-control" id="branch_id" name="branch_id" required>
		  @foreach ($branches as $x)
		  	<option value={{ $x->id }}>{{ $x->name }}</option>
		  @endforeach
		</select>
	  </div>

	  {{-- <div class="form-group">
	    <label for="pm_user_id">PM User UID:</label>
	    <input type="text" class="form-control" id="pm_user_id" name="pm_user_id">
	  </div> --}}

	<br>

	<h5>Tick all that applies</h5>

	<div class="form-check">
		<label class="form-check-label">
		    <input type="checkbox" class="form-check-input" name ="receptionist" value="1">Receptionist
		</label>
	</div>

	<div class="form-check">
		<label class="form-check-label">
		    <input type="checkbox" class="form-check-input" name ="doctor" value="1">Doctor
		</label>
	</div>

	<div class="form-check">
		<label class="form-check-label">
		    <input type="checkbox" class="form-check-input" name ="aesthetician" value="1">Aesthetician
		</label>
	</div>

	<div class="form-check">
		<label class="form-check-label">
		    <input type="checkbox" class="form-check-input" name ="administrator" value="1">Administrator
		</label>
	</div>
		
	<br>

	<button type="submit" class="btn btn-primary">Create</button>
	<a href="/employees"><button type="button" class="btn btn-danger">Cancel</button>

	</form>
	
	</div>

@endsection