@extends ('master')

@section('heading')
	Edit Package: {{ $package->name }}
@endsection

@section('contents')

	<div class="container">

		<form method="post" action="/packages/{{ $package->id }}">

		@method('patch')
		@csrf

		<div class="form-group">
			<label for="service_name">Package Name:</label>
			<input type="text" class="form-control" id="package_name" name="package_name" value="{{ $package->name }}" required>
		</div>

		@foreach($package->pricelists as $x)
			<div class="form-group">
			    <label for="{{ $x->pricelist->name }}">{{ $x->pricelist->name }} Price:</label>
			    <input type="number" class="form-control" id="{{ $x->pricelist->name }}" name="{{ $x->pricelist->name }}" value="{{ $x->price }}" required>
			</div>
		@endforeach

		 <br/>

		 <button type="submit" class="btn btn-warning">Update</button>
		 <a href="/packages"><button type="button" class="btn btn-danger">Cancel</button>
		  
		</form>

	</div>	

@endsection