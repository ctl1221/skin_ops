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

			<input type="date" name="claimed_by_date" value="{{ /Carbon/Carbon::now() }}">

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

	 		<br/>

			<button type="submit" class="btn btn-outline-success">Submit</button>
			<a href="/clients/{{ $client->id }}"><button type="submit" class="btn btn-outline-danger">Cancel</button></a>

		</div>

		<div class="container">
			<table class= "table table-bordered table-fullwidth table-sm" v-show="!claim_for_myself">
	            <tr>
	                <th class="text-center bg-secondary text-white"><h5 class="mb-1 mt-1">Claiming Client</h5></th>
	            </tr>    
	        </table>
        </div>

		<client-search 
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
  },
})

</script>

@endsection

