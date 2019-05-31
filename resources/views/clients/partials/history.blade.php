<div class="card">
	<div class="card-body bg-light">
		@foreach($histories as $x)
			@if($x->parent_type == 'App\\SalesOrder')
				@include('clients.partials.history_sales')
			@endif

			@if($x->parent_type == 'App\\ClientClaim')
				@include('clients.partials.history_claims')
			@endif
		@endforeach
	</div>
</div>