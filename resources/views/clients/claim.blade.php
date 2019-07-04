@extends ('master')

@section('heading')
	Claim Packages - <a href="/clients/{{ $client->id }}">{{ $client->display_name() }}</a>
@endsection

@section('contents')
	
<div class="container">
	<div class="card">
		<div class="card-body">

		<form method="POST" action="/clients/{{ $client->id }}/claim">
		@csrf

		<div class="row">
			<div class="form-group col">
				<label for="claimed_by_date">Date:</label>
				<input class="form-control" 
				type="date" 
				name="claimed_by_date" 
				id="claimed_by_date" 
				min="{{ $min_date }}"
					value="{{ \Carbon\Carbon::now()->toDateString() }}" required>
			</div>

			<div class="form-group col">
				<label for="treated_by_id">Treated By:</label>
				<select class="form-control" name="treated_by_id">
					<option value="">---</option>
					@foreach($treated_by as $x)
						<option value="{{ $x->id }}">{{ $x->display_name() }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col">
				<label for="branch">Branch:</label>
				<input type="text" class="form-control" id="branch" value="{{ Auth::user()->branch->name }}" disabled>
			</div>

			<input type="hidden" name="branch_id" value="{{ Auth::user()->branch->id }}">

			<div class="form-group col">
				<label for="assisted_by_id">Assisted By:</label>
				<select class="form-control" name="assisted_by_id">
					<option value="">---</option>
					@foreach($assisted_by as $x)
						<option value="{{ $x->id }}">{{ $x->display_name() }}</option>
					@endforeach
				</select>
			</div>

		</div>
			

		<div class="form-check">
			<input class="form-check-input" type="checkbox" id="checkbox" name="claim_for_myself" v-model="claim_for_myself">
			<label class="form-check-label" for="checkbox">Claim For Myself</label>
		</div>
		
		<br/>

		<div class="form-group">
			<select class="form-control" name="selected_client_claim_id">
				@foreach($client->to_claims() as $x)
					@if(!$x->claimed_by_id)
						<option value="{{ $x->id }}">{{ $x->sellable->name }}</option>
					@endif
				@endforeach
			</select>
		</div>

	 	<div class="form-group">
			<label for="notes">Notes:</label>
			<textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
		</div>

		<button type="submit" class="btn btn-outline-success" :disabled="!submittable">Submit</button>
		<a href="/clients/{{ $client->id }}" class="btn btn-outline-danger">Cancel</a>

		<div class="container">
			<table class= "table table-bordered table-fullwidth table-sm mt-4" v-show="!claim_for_myself">
	            <tr>
	                <th class="text-center bg-secondary text-white"><h5 class="mb-1 mt-1">Claiming Client</h5></th>
	            </tr>    
	        </table>
        </div>

		<client-search 
			@clientselected="client_selected = true"
			@clear_search="client_selected = false"
			v-show="!claim_for_myself"
			min_char_first_name = 3
			min_char_last_name = 2
			mode="claim"
		/>

		</form>

		</div>
	</div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">

var app = new Vue({
  el: '#app', 
  data: {
  	claim_for_myself: true,
  	client_selected:false,
  },
  computed: {
  	submittable: function ()
  	{
  		if(!this.claim_for_myself)
  		{
  			if(this.client_selected)
  				return true;
  			return false;
  		}
  		else
  		{
  			return true;
  		}
  	}
  }
})

</script>

@endsection

