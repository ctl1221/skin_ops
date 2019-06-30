@extends ('master')

@section ('heading')

	{{ $product->name }} 

	<a href="/products"><button type="button" class="btn btn-outline-primary">Back</button></a> 

	<a href="/products/{{$product->id}}/edit"><button type="button" class="btn btn-outline-warning">Edit</button></a> 

	@if($product->is_active)
	<a href="/products/{{$product->id}}/deactivate"><button type="button" class="btn btn-outline-danger">Deactivate</button></a> 
	
	@else
	<a href="/products/{{$product->id}}/activate"><button type="button" class="btn btn-outline-success">Activate</button></a> 
 
	@endif

@endsection

@section ('contents')

	<div class="container">

		<table class="table table-sm table-bordered">
			@foreach($product->pricelists as $x)
			<tr>
				<th>{{ $x->pricelist->name }} Price</th>
				<td>{{ "PHP " . number_format($x->price,2) }}</td>
			</tr>
			@endforeach
		</table>

		<h3>
			@if($product->is_active)
				<span class="badge badge-success">Active</span>
			@else
				<span class="badge badge-danger">Inactive</span>
			@endif

			@if($product->price_edit_enabled)
				<span class="badge badge-warning">Price Edit Enabled</span>
			@else
				<span class="badge badge-primary">Price Edit Disabled</span>
			@endif
		</h3>
		
	</div>

@endsection