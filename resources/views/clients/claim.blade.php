@extends ('master')

@section('heading')
	Claim Packages
@endsection

@section('contents')
	
	<div class="container">

	<form method="POST" action="/clients/{{ $client->id }}/claim">

		@csrf

	<select name="selected_client_claim_id">
		@foreach($client->to_claims() as $x)
			@if(!$x->claimed_by_id)
				<option value="{{ $x->id }}">{{ $x->sellable->name }}</option>
			@endif
		@endforeach
	</select>

	<button type="submit">Submit</button>

	<div class="form-check">
		<input class="form-check-input" type="checkbox" id="checkbox" name="claim_for_myself" v-model="claim_for_myself">
		<label class="form-check-label" for="checkbox">Claim For Myself</label>
	</div>

	<client-search 
		v-show="!claim_for_myself"
		min_char_first_name = 3
		min_char_last_name = 2
		mode="claim"
	/>

	</form>

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

