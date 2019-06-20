<div class="card">
	<div class="card-body bg-light">

		@if(!$client->histories->count())
			<center>No Records Found</center>
		@else
			@foreach($histories as $x)
				@if($x->parent_type == 'App\\SalesOrder')
					@include('clients.partials.history_sales')
				@endif

				@if($x->parent_type == 'App\\ClientClaim')
					@include('clients.partials.history_claims')
				@endif

				@if($x->parent_type == 'App\\Payment')
					@include('clients.partials.history_client_payments')
				@endif
			@endforeach
		@endif
	</div>
</div>