@extends ('master')

@section('heading')
	Create New Client
@endsection

@section('contents')
	
<div class="container">

	<form method="post" action="/clients">

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
	  <label for="birthday">Birthday:</label>
	  <input type="date" class="form-control" id="birthday" name="birthday">
	</div>

	<div class="form-group">
	  <label for="address">Address:</label>
	  <input type="text" class="form-control" id="address" name="address">
	</div>

	<div class="form-group">
	  <label for="mobile_no">Mobile Number:</label>
	  <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="639xxxxxxxxxx number format">
	</div>

	<div class="form-group">
	  <label for="email">Email:</label>
	  <input type="email" class="form-control" id="email" name="email">
	</div>

	<div class="form-group">
  		<label for="select_gender">Select Gender:</label>
  		<select class="form-control" id="select_gender" name="gender">
		    <option value="male">Male</option>
		    <option value="female">Female</option>
		    <option value="unspecified">Unspecified</option>
	  	</select>
	</div>

	@role('management')
	<div class="form-group">
  		<label for="select_pricelist">Select Pricelist:</label>
  		<select class="form-control" id="select_pricelist" name="pricelist_id">
		    @foreach($pricelists as $x)
		    	<option value={{$x->id}} >{{ $x->name }}</option>
		    @endforeach
	  	</select>
	</div>
	@endRole

	<div class="form-check">
	  <input class="form-check-input" type="checkbox" id="opt_out" name="opt_out">
	  <label class="form-check-label" for="out_out">
	    Opt Out of SMS Blast
	  </label>
	</div>
	
	<br/>

  	<button type="submit" class="btn btn-primary">Create</button>

  	@php
  		$showAllClients = false;
  	@endphp
  	@hasRole('management')
  	@php
  		$showAllClients = true;
  	@endphp
  	@endHasRole

  	@if($showAllClients)
  	<a href="/clients"><button type="button" class="btn btn-danger">Cancel</button>
  	@else
  	<a href="/clients/search"><button type="button" class="btn btn-danger">Cancel</button>
  	@endif

	</form>
</div>

@include ('partials.errors')

@endsection
