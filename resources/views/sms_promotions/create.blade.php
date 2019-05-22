@extends('master')

@section ('heading')
	Create SMS Blast
@endsection

@section ('contents')

	<div class="container">

	<form method="post" action="/sms_promotions">
		@csrf

	  	<div class="form-group">
	    	<label for="mobile_no">Mobile Number:</label>
	    	<input type="text" class="form-control" id="mobile_no" name="mobile_no">
	  	</div>

	  	<div class="form-group">
	    	<label for="details">Details:</label>
	    	<textarea class="form-control" id="details" name="details" required></textarea>
	  	</div>

	<br>

	<button type="submit" class="btn btn-primary">Create</button>

	</form>
	
	</div>

@endsection