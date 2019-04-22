@extends ('master')

@section('heading')
	Edit Pricelist
@endsection

@section('contents')

	<div class="container">

		<form method="post" action="/pricelists/update">
		
		@csrf

		<form class = "form-horizontal">

		@foreach($pricelists as $x)
			<div class="form-group">
			    <label for="pricelist_name">Current: {{ $x->name }}</label>
			    <input type="text" class="form-control" id="{{ $x->name }}" name="{{ $x->id }}" value="{{ $x->name }}" required>
			</div>
		@endforeach

		<br>

		<button type="submit" class="btn btn-warning">Update</button>
		<a href="/pricelists"><button type="button" class="btn btn-danger">Cancel</button>
		
		</form>

	</div>

@endsection