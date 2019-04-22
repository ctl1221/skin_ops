@extends ('master')

@section ('heading')

	{{ $service->name }} 

	<a href="/services"><button type="button" class="btn btn-outline-primary">Back</button></a> 

	<a href="/services/{{$service->id}}/edit"><button type="button" class="btn btn-outline-warning">Edit</button></a> 

	
	@if($service->is_active)
	<a href="/services/{{$service->id}}/deactivate"><button type="button" class="btn btn-outline-danger">Deactivate</button></a> 
	
	@else
	<a href="/services/{{$service->id}}/activate"><button type="button" class="btn btn-outline-success">Activate</button></a> 

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