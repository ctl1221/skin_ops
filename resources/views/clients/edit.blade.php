@extends ('master')

@section('heading')
	Edit Client: {{ $client->display_name() }}
@endsection

@section('contents')
	
<div class="container">

	<form method="post" action="/clients/{{ $client->id }}">
		@method('patch')
		@csrf

	<div class="form-group">
	  <label for="first_name">First Name:</label>
	  <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $client->first_name }}">
	</div>

	<div class="form-group">
	  <label for="last_name">Last Name:</label>
	  <input type="text" class="form-control" id="last_name" name="last_name" value= "{{ $client->last_name }}">
	</div>

	<div class="form-group">
	  <label for="birthday">Birthday:</label>
	  <input type="date" class="form-control" id="birthday" name="birthday" value= {{ $client->birthday }}>
	</div>

	<div class="form-group">
		<label for="address">Address:</label>
		<input type="text" class="form-control" id="address" name="address" value ="{{ $client->address }} ">
	</div>

	<div class="form-group">
		<label for="mobile_no">Mobile Number:</label>
		<input type="tel" class="form-control" id="mobile_no" name="mobile_no" value="{{ $client->mobile_number }}" placeholder="+639xxxxxxxxxx number format">
	</div>

	<div class="form-group">
		<label for="email">Email:</label>
		<input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}">
	</div>

	<div class="form-group">
  		<label for="select_gender">Select Gender:</label>
  		<select class="form-control" id="select_gender" name="gender">
		    <option value="male" {{ $client->gender == 'male' ? "selected=\"selected\"":"" }}>Male</option>
		    <option value="female" {{ $client->gender == 'female' ? "selected=\"selected\"":"" }}>Female</option>
		    <option value="unspecified" {{ $client->gender == 'unspecified' ? "selected=\"selected\"":"" }}>Unspecified</option>
	  	</select>
	</div>

	<div class="form-group">
  		<label for="select_pricelist">Select Pricelist:</label>
  		<select class="form-control" id="select_pricelist" name="pricelist_id">
		    @foreach($pricelists as $x)
		    	<option value={{$x->id}} {{ $client->pricelist_id == $x->id ? "selected=\"selected\"":"" }}>{{ $x->name }}</option>
		    @endforeach
	  	</select>
	</div>

	<div class="form-check">
	  <input class="form-check-input" type="checkbox" id="opt_out" name="opt_out" value="1" {{ $client->opt_out ? "checked": ""}}>
	  <label class="form-check-label" for="out_out">
	    Opt Out of SMS Blast
	  </label>
	</div>
	
	<br/>

  	<button type="submit" class="btn btn-warning">Update</button>
  	<a href="/clients/{{ $client->id }}"><button type="button" class="btn btn-danger">Cancel</button>

	</form>

</div>


@endsection
