@extends ('master')

@section ('heading')

	{{ $service->name }} 

	<a href="/services"><button type="button" class="btn btn-outline-primary">Back</button></a> 

	<a href="/services/{{$service->id}}/edit"><button type="button" class="btn btn-outline-warning">Edit</button></a> 

	
	@if($service->is_active)
	<form method="POST" action="/services/{{$service->id}}/deactivate">
		@csrf
		<input type="submit" class="btn btn-outline-danger" value="Deactivate">
	</form>
	
	@else
	<form method="POST" action="/services/{{$service->id}}/activate">
		@csrf
		<input type="submit" class="btn btn-outline-success" value="Activate">
	</form>
	@endif

@endsection

@section ('contents')

	<div class="container">

		<table class="table table-sm table-bordered">
			@foreach($service->pricelists as $x)
			<tr>
				<th>{{ $x->pricelist->name }} Price</th>
				<td>{{ "PHP " . number_format($x->price,2) }}</td>
			</tr>
			@endforeach
		</table>
		
	</div>

@endsection