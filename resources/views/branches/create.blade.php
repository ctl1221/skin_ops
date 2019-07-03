@extends ('master')

@section('heading')
	Add New Branch
@endsection

@section('contents')

	<div class="container">

		<form method="post" action="/branches">

		 @csrf

		  <div class="form-group">
		    <label for="name">Branch Name:</label>
		    <input type="text" class="form-control" id="name" name="name">
		  </div>

		  <div class="form-group">
		    <label for="quota">Quota:</label>
		    <input type="number" class="form-control" id="quota" name="quota">
		  </div>

		  <button type="submit" class="btn btn-primary">Create</button>
		  
		  <a href="/branches"><button type="button" class="btn btn-danger">Cancel</button>

		</form>

	</div>	

@endsection