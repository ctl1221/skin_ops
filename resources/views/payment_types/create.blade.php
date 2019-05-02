@extends('master')

@section ('heading')
	Add New Payment Tpye
@endsection

@section ('contents')

	<div class="container">

	<form method="post" action="/payment_types">
		@csrf

	  <div class="form-group">
	    <label for="name">Name:</label>
	    <input type="text" class="form-control" id="name" name="name" required>
	  </div>

		
	<br>

	<button type="submit" class="btn btn-primary">Create</button>
	<a href="/payment_types"><button type="button" class="btn btn-danger">Cancel</button>

	</form>
	
	</div>

@endsection