@extends ('master')

@section('heading')
Generate New Report
@endsection

@section('contents')

<div class="container">

	<form method="post" action="/reports">

		@csrf

		<div class="form-group">
			<label for="name">Report Name:</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ $default_name }}" required>
		</div>

		<div class="form-group">
			<label for="from">From:</label>
			<input type="date" class="form-control" id="from" name="from" value="{{\Carbon\Carbon::now()->startOfMonth()->toDateString()}}" required>
		</div>

		<div class="form-group">
			<label for="to">To:</label>
			<input type="date" class="form-control" id="to" name="to" value="{{\Carbon\Carbon::now()->toDateString()}}" required>
		</div>

		<div class="form-group">
		    <label for="type">Report Type</label>
		    <select class="form-control" id="type" name="report_type">
		      <option>Under Construction</option>
		    </select>
		</div>

		<div class="form-group">
		    <label for="type">Branch</label>
			    <select class="form-control" id="branch" name="branch">
			    	<option>All Branches</option>
			    	@foreach($branches as $x)
			      		<option>{{$x->name}}</option>
			      	@endforeach
			    </select>
		</div>

		<br/>

		<button type="submit" class="btn btn-primary">Create</button>
		<a href="/reports"><button type="button" class="btn btn-danger">Cancel</button>

		</form>

	</div>	

	@endsection