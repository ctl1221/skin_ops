@extends ('master')

@section('heading')
Edit Service: {{ $service->name }}
@endsection

@section('contents')

<div class="container">

	<form method="post" action="/services/{{ $service->id}}">
		
		@method('patch')
		@csrf

		<div class="form-group">
			<label for="service_name">Product Name:</label>
			<input type="text" class="form-control" id="service_name" name="service_name" value="{{ $service->name }}" required>
		</div>

		@foreach($service->pricelists as $x)
		<div class="form-group">
			<label for="{{ $x->pricelist->name }}">{{ $x->pricelist->name }} Price:</label>
			<input type="number" class="form-control" id="{{ $x->pricelist->name }}" name="{{ $x->pricelist->name }}" value="{{ $x->price }}" min="0" required>
		</div>
		@endforeach

		<div class="form-check">
			<input class="form-check-input" type="checkbox" id="price_edit_enabled" name="price_edit_enabled" value="1" 
			  {{ $service->price_edit_enabled ? "checked": ""}}>
			<label class="form-check-label" for="price_edit_enabled">
		    	Price Editing Enabled
		  	</label>
		</div>

		<br>

		

		<button type="submit" class="btn btn-warning">Update</button>
		<a href="/services"><button type="button" class="btn btn-danger">Cancel</button>

		</form>

		{{-- @include('partials.errors') --}}

	</div>	

	@endsection