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
			<input type="text" class="form-control" id="name" name="name" required>
		</div>

		<div class="form-group">
			<label for="from">From:</label>
			<input type="date" class="form-control" id="from" name="from" required>
		</div>

		<div class="form-group">
			<label for="to">To:</label>
			<input type="date" class="form-control" id="to" name="to" required>
		</div>

		<div class="form-group">
		    <label for="type">Report Type</label>
		    <select class="form-control" id="type" name="report_type">
		      <option>1</option>
		      <option>2</option>
		      <option>3</option>
		      <option>4</option>
		      <option>5</option>
		    </select>
		</div>

		<button type="submit" class="btn btn-primary">Create</button>
		<a href="/products"><button type="button" class="btn btn-danger">Cancel</button>

		</form>

	</div>	

	@endsection