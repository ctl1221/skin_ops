<div class="card">
	<div class="card-body">
		@foreach($client->histories as $x)
			@if($x->parent_type == 'App\\SalesOrder')
				@include('clients.partials.history_sales')
			@endif
		@endforeach

			{{-- {{ $activities->appends([
				'activities' =>$activities->currentPage(),
				'payments' => $payments->currentPage(),
				])->links()}}

				@else
				<h6 class="text-center">No Records Found.</h6>
				@endif --}}

	</div>
</div>