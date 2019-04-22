@extends('master')

@section ('heading')
	Edit Employee: {{ $employee->display_name() }}
@endsection

@section ('contents')

	<div class="container">

	<form method="post" action="/employees/{{ $employee->id }}">
		@method('patch')
		@csrf

	  <div class="form-group">
	    <label for="first_name">First Name:</label>
	    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $employee->first_name }}" required>
	  </div>

	  <div class="form-group">
	    <label for="last_name">Last Name:</label>
	    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $employee->last_name }}" required	>
	  </div>

	  <div class="form-group">
		<label for="branch">Select Branch:</label>
		<select class="form-control" id="select_branch" name="branch_id" required >
		  @foreach ($branches as $x)
		  <option value={{ $x->id }} 
		  	@if($x->id == $employee->branch_id)
		  		{{ "selected = 'selected'" }}	
		  	@endif>	
		  	{{ $x->name }} </option>
		  @endforeach
		</select>
	  </div>

	<br>

	<h5>Tick all that applies</h5>

	<div class="form-check">
		<label class="form-check-label">
		    <input type="checkbox" class="form-check-input" name ="receptionist" value="1" {{ $employee->is_receptionist ? "checked": ""}}>Receptionist
		</label>
	</div>

	<div class="form-check">
		<label class="form-check-label">
		    <input type="checkbox" class="form-check-input" name ="aesthetician" value="1" {{ $employee->is_aesthetician ? "checked": ""}}>Aesthetician
		</label>
	</div>

	<div class="form-check">
		<label class="form-check-label">
		    <input type="checkbox" class="form-check-input" name ="administrator" value="1" {{ $employee->is_administrator ? "checked": ""}}>Administrator
		</label>
	</div>

	<div class="form-check">
		<label class="form-check-label">
		    <input type="checkbox" class="form-check-input" name ="doctor" value="1" {{ $employee->is_doctor ? "checked": ""}}>Doctor
		</label>
	</div>
	
	<br>

	<button type="submit" class="btn btn-warning">Update</button>
	<a href="/employees"><button type="button" class="btn btn-danger">Cancel</button>

	</form>
	
	</div>

@endsection