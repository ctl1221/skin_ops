@extends ('master')

@section ('heading')

	{{ $product->name }} 

	<a href="/products"><button type="button" class="btn btn-outline-primary">Back</button></a> 

	<a href="/products/{{$product->id}}/edit"><button type="button" class="btn btn-outline-warning">Edit</button></a> 

	
	@if($product->is_active)
	<form method="POST" action="/products/{{$product->id}}/deactivate">
		@csrf
		<input type="submit" class="btn btn-outline-danger" value="Deactivate">
	</form>
	
	@else
	<form method="POST" action="/products/{{$product->id}}/activate">
		@csrf
		<input type="submit" class="btn btn-outline-success" value="Activate">
	</form>

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
		
	</div>

@endsection