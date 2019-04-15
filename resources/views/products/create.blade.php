@extends ('master')

@section('heading')
	Add New Product
@endsection

@section('contents')

<div class="container">

	<form method="post" action="/products">

		@csrf

		<div class="form-group">
			<label for="product_name">Product Name:</label>
			<input type="text" class="form-control" id="product_name" name="product_name" required>
		</div>

		<br>

		@foreach($pricelists as $x)
		<div class="form-group">
			<label for="{{ $x->name }}">{{ $x->name }} Price:</label>
			<input type="number" class="form-control" id="{{ $x->name }}" name="{{ $x->name }}" min="0" value="0" required>
		</div>
		@endforeach

		<br>

		<button type="submit" class="btn btn-primary">Create</button>
		<a href="/products"><button type="button" class="btn btn-danger">Cancel</button>

		</form>

		{{-- @include('partials.errors') --}}

</div>	

@endsection