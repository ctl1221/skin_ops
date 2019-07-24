@extends('master')

@section('heading')

@endsection

@section('contents')

	<h4>Services</h4>

	<form method="post" action="/categories/{{ $category->id }}/add_service">
		
		@csrf

		<select name="service_id">
			@foreach($services as $x)
				@if(!in_array($x->id, $service_items))
					<option value="{{ $x->id }}">{{ $x->name }}</option>
				@endif
			@endforeach
		</select>

		<input type="submit" value="Add to Category">

	</form>

	<br>

	<h4>Products</h4>

	<form method="post" action="/categories/{{ $category->id }}/add_product">
		
		@csrf

		<select name="product_id">
			@foreach($products as $x)
				@if(!in_array($x->id, $product_items))
					<option value="{{ $x->id }}">{{ $x->name }}</option>
				@endif
			@endforeach
		</select>

		<input type="submit" value="Add to Category">

	</form>

	<br>

	<h4>Packages</h4>

	<form method="post" action="/categories/{{ $category->id }}/add_package">
		
		@csrf

		<select name="package_id">
			@foreach($packages as $x)
				@if(!in_array($x->id, $package_items))
					<option value="{{ $x->id }}">{{ $x->name }}</option>
				@endif
			@endforeach
		</select>

		<input type="submit" value="Add to Category">

	</form>

	<br>

	<table class="table table-bordered table-sm">
		@foreach($category->items->where('sellable_type','App\Service') as $x)
			<tr>
				<td>Service</td>
				<td>
					{{ $x->sellable->name }}
					<a href="/categories/{{ $category->id }}/delete_service/{{ $x->sellable->id }}"> &nbsp <i class="fas fa-trash-alt text-danger"></i>
					</a>
				</td>
			</tr>
		@endforeach

		@foreach($category->items->where('sellable_type','App\Product') as $x)
			<tr>
				<td>Product</td>
				<td>
					{{ $x->sellable->name }}
					<a href="/categories/{{ $category->id }}/delete_product/{{ $x->sellable->id }}"> &nbsp <i class="fas fa-trash-alt text-danger"></i>
					</a>
				</td>
			</tr>
		@endforeach

		@foreach($category->items->where('sellable_type','App\Package') as $x)
			<tr>
				<td>Package</td>
				<td>
					{{ $x->sellable->name }}
					<a href="/categories/{{ $category->id }}/delete_package/{{ $x->sellable->id }}"> &nbsp <i class="fas fa-trash-alt text-danger"></i>
					</a>
				</td>
			</tr>
		@endforeach
	</table>

@endsection
