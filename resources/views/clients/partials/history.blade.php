<div class="card">
	<div class="card-body">
		@foreach($histories as $x)
			@if($x->parent_type == 'App\\SalesOrder')
				@include('clients.partials.history_sales')
			@endif
		@endforeach
	</div>
</div>