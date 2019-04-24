@extends('master')

@section ('heading')
	Create New Package
@endsection

@section ('contents')

	<div class="container">

	<form method="post" action="/packages">
		@csrf

		<div class="form-group">
			<label for="package_name">Name:</label>
		    <input type="text" class="form-control" id="package_name" name="package_name" required>
		</div>

		<package-grid :sellables="{{ $sellables }}"></package-grid>

		<br>

		@foreach($pricelists as $x)
			<div class="form-group">
				<label for="{{ $x->name }}">{{ $x->name }} Price:</label>
				<input type="number" class="form-control" id="{{ $x->name }}" name="{{ $x->name }}" min="0" value="0" required>
			</div>
		@endforeach

		<button type="submit" class="btn btn-primary">Create</button>
		<a href="/packages"><button type="button" class="btn btn-danger">Cancel</button>

	</form>
	
	</div>

@endsection

@section('scripts')

var app = new Vue({
  el: '#app', 
  data: {},
})

@endsection

