@extends ('master')

@section ('heading')

		{{ $package->name }} 

		<a href="/packages"><button type="button" class="btn btn-outline-primary">Back</button></a> 

		<a href="/packages/{{ $package->id }}/edit"><button type="button" class="btn btn-outline-warning">Edit</button></a> 
		
		@if($package->is_active)
		<a href="/packages/{{ $package->id }}/deactivate"><button type="button" class="btn btn-outline-danger">Deactivate</button></a> 
		@else
		<a href="/packages/{{ $package->id }}/activate"><button type="button" class="btn btn-outline-success">Activate</button></a> 
		@endif

@endsection

@section ('contents')
	<div class="container">
		<div class="row">
			<table class="table table-sm table-bordered">
				@foreach($package->pricelists as $x)
				<tr>	
					<th>{{ $x->pricelist->name }} Price:</th>
					<td>{{ "PHP " . number_format($x->price,2) }}</td>
				</tr>
				@endforeach	
			</table>
		</div>

		<div class="row">
			<table class="table table-sm table-bordered">
				<tr>	
					<th>Item</th>
					<th>Quantity</th>
				</tr>
				@foreach($package->breakdowns as $x)
				<tr>	
					<td>{{ $x->sellable->name }}</td>
					<td>{{ $x->quantity }}</td>
				</tr>
				@endforeach	
			</table>
		</div>
	</div>
@endsection 