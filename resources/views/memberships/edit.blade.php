@extends ('master')

@section('heading')
	Edit Memberships
@endsection

@section('contents')

	<div class="container">

		<form method="post" action="/memberships/update">

		@csrf

		<form class = "form-horizontal">

		@foreach($memberships as $x)

			<div class="form-group">
			    <label for="membership_name">Current Name: {{ $x->name }}</label>

			    <div>
			    <input type="text" class="form-control" id="{{ $x->name }}" name="{{ $x->id }}" value="{{ $x->name }}" required>
				</div>
			</div>

		@endforeach

		<br>

		<button type="submit" class="btn btn-warning">Update</button>
		<a href="/memberships"><button type="button" class="btn btn-danger">Cancel</button>
		
		</form>

	</div>

@endsection