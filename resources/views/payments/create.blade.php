@extends ('master')

@section('heading')
	Pay: <u>{{ $client->display_name() }}</u>
@endsection

@section('contents')

	<div class="container">

		<form method="post" action="/payments">

		@csrf

		<input type="hidden" name="client_id" value="{{ $client->id }}">
		<input type="hidden" name="branch_id" value="{{ Auth::user()->branch->id }}">

		<div class="form-group">
			<label for="branch">Branch:</label>
			<input type="text" class="form-control" id="branch" value="{{ Auth::user()->branch->name }}" disabled>
		</div>
		
		<div class="form-group">
		    <label for="date">Date:</label>
		    <input type="date" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::now()->toDateString() }}" required>
		</div>

		<div class="form-group">
			<label for="amount">Amount:</label>
		    <input type="number" class="form-control" id="amount" name="amount" required>
		</div>

		<button type="submit" class="btn btn-primary">Create</button>
		  
		<a href="/clients/{{ $client->id }}"><button type="button" class="btn btn-danger">Cancel</button>

		</form>

	</div>	

@endsection