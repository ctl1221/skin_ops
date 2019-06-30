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

		<h3>
			@if($service->is_active)
				<span class="badge badge-success">Active</span>
			@else
				<span class="badge badge-danger">Inactive</span>
			@endif

			@if($service->price_edit_enabled)
				<span class="badge badge-warning">Price Edit Enabled</span>
			@else
				<span class="badge badge-primary">Price Edit Disabled</span>
			@endif
		</h3>

	</div>

@endsection