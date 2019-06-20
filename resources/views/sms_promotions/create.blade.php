@extends('master')

@section ('heading')
	Create SMS Blast
@endsection

@section ('contents')

	<div class="container">

	<form method="post" action="/sms_promotions">
		@csrf

		<div class="form-group">
		    <label for="type">SMS Type</label>
		    <select class="form-control" id="type" name="sms_type" v-model="sms_type">
		      <option>Single</option>
		      <option>Opt</option>
		      <option>All</option>
		    </select>
		</div>

	  	<div class="form-group" v-show="sms_type == 'Single'">
	    	<label for="mobile_no">Mobile Number:</label>
	    	<input type="text" class="form-control" id="mobile_no" name="mobile_no" :required="sms_type == 'Single'">
	  	</div>

	  	<div class="form-group">
	    	<label for="details">Details:</label>
	    	<textarea class="form-control" id="details" name="details" required rows="10"></textarea>
	  	</div>

	  	<br/>

		<button type="submit" class="btn btn-success">Send</button>
		<a href="/sms_promotions"><button type="button" class="btn btn-danger">Cancel</button>

		</form>
		
		</div>

@endsection

@section('scripts')

<script type="text/javascript">

	var app = new Vue({

		el: '#app',
		data: {
			sms_type: "Single",
		},
	});

</script>

@endsection