@extends('master')

@section ('heading')
	Create New Concern
@endsection

@section ('contents')

	<div class="container">

	<form method="post" action="/bugs" enctype="multipart/form-data">
		@csrf

	  	<div class="form-group">
	    	<label for="title">Title:</label>
	    	<input type="text" class="form-control" id="title" name="title" required>
	  	</div>

	  	<div class="form-group">
	    	<label for="details">Details:</label>
	    	<textarea class="form-control" id="details" name="details" required></textarea>
	  	</div>

		<div class="form-group">
			<label for="file">Upload Screenshot (image file only):</label>
			<input type="file" class="form-control-file" id="file" name="file">
		</div>
		
	<button type="submit" class="btn btn-primary">Create</button>

	</form>
	
	</div>

@endsection