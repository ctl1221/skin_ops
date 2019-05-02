@extends ('master')

@section('heading')
	Edit Payment Types
@endsection

@section('contents')

	<div class="container">

		<form method="post" action="/payment_types/update">

		@csrf

		<form class = "form-horizontal">

		@foreach($payment_types as $x)

			<div class="form-group">
			    <label for="name">Name: {{ $x->name }}</label>

			    <div>
			    <input type="text" class="form-control" id="{{ $x->name }}" name="{{ $x->id }}" value="{{ $x->name }}" required>
				</div>
			</div>

		@endforeach

		<br>

		<button type="submit" class="btn btn-warning">Update</button>
		<a href="/payment_types"><button type="button" class="btn btn-danger">Cancel</button>
		
		</form>

	</div>

@endsection