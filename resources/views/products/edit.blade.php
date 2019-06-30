@extends ('master')

@section('heading')
Edit Product: {{ $product->name }}
@endsection

@section('contents')

<div class="container">

	<form method="post" action="/products/{{ $product->id}}">
		@method('patch')
		@csrf

		<div class="form-group">
			<label for="product_name">Product Name:</label>
			<input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->name }}" required>
		</div>

		<br/>

		@foreach($product->pricelists as $x)
		<div class="form-group">
			<label for="{{ $x->pricelist->name }}">{{ $x->pricelist->name }} Price:</label>
			<input type="number" class="form-control" id="{{ $x->pricelist->name }}" name="{{ $x->pricelist->name }}" value="{{ $x->price }}" min="0" required>
		</div>
		@endforeach

		<div class="form-check">
		  <input class="form-check-input" type="checkbox" id="price_edit_enabled" name="price_edit_enabled" value="1" 
		  {{ $product->price_edit_enabled ? "checked": ""}}>
		  <label class="form-check-label" for="price_edit_enabled">
		    Price Editing Enabled
		  </label>
		</div>

		<br/>

		<button type="submit" class="btn btn-warning">Update</button>
		<a href="/products"><button type="button" class="btn btn-danger">Cancel</button>

		</form>

		{{-- @include('partials.errors') --}}

	</div>	

	@endsection