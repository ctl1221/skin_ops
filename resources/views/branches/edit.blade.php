@extends ('master')

@section('heading')
	Edit Branches
@endsection

@section('contents')

	<div class="container">

		<form method="post" action="/branches/update">

		@csrf

		<form class = "form-horizontal">

		@foreach($branch as $x)

			<div class="form-group">
			    <label for="branch_name">Current Name: {{ $x->name }}</label>

			    <div>
			    <input type="text" class="form-control" id="{{ $x->name }}" name="{{ $x->id }}" value="{{ $x->name }}" required>
				</div>
			</div>

		@endforeach

		<br>

		<button type="submit" class="btn btn-warning">Update</button>
		<a href="/branches"><button type="button" class="btn btn-danger">Cancel</button>
		
		</form>

	</div>

@endsection