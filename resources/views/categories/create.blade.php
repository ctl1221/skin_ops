@extends ('master')

@section('heading')
	Add New Category
@endsection

@section('contents')

	<div class="container">

		<form method="post" action="/categories">

		 @csrf

		  <div class="form-group">
		    <label for="name">Name:</label>
		    <input type="text" class="form-control" id="category_name" name="category_name">
		  </div>

		  <button type="submit" class="btn btn-primary">Create</button>
		  
		  <a href="/categories"><button type="button" class="btn btn-danger">Cancel</button>

		</form>

	</div>	

@endsection