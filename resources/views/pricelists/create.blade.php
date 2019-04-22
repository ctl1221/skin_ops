@extends ('master')

@section('heading')
	Add New Pricelist
@endsection

@section('contents')

	<div class="container">

		<form method="post" action="/pricelists">

		 @csrf

			<div class="form-group">
		    	<label for="pricelist_name">Pricelist Name:</label>
		    	<input type="text" class="form-control" id="pricelist_name" name="pricelist_name" placeholder="One Word Only">
			</div>

				<button type="submit" class="btn btn-primary">Create</button>
				<a href="/pricelists"><button type="button" class="btn btn-danger">Cancel</button>

		</form>

	</div>	

@endsection