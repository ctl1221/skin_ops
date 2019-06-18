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
		    <input ref="amount" type="number" class="form-control" id="amount" name="amount" required autofocus>
		</div>

		<div class="form-group">
			<label for="payment_type">Payment Type:</label>
			<select class="form-control" name="payment_type_id">
				@foreach($payment_types as $x)
					<option value="{{ $x->id }}">{{ $x->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
		    <label for="reference">Reference:</label>
		    <input type="text" class="form-control" name="reference">
  		</div>

  		<div class="form-group">
		    <label for="notes">Notes:</label>
		    <textarea class="form-control" name="notes"></textarea>
  		</div>

		<br/>

		<button type="submit" class="btn btn-primary">Create</button>
		  
		<a href="/clients/{{ $client->id }}"><button type="button" class="btn btn-danger">Cancel</button>

		</form>

	</div>	

@endsection

@section('scripts')

<script type="text/javascript">
	var app = new Vue({
		el: '#app', 
		data: {},
	})
</script>

@endsection