@extends('master')

@section('heading')

	<span class="mr-5"> 
		{{ $client->display_name() }}
	</span>
	
	<div class="btn-group mr-2">
		<div class="input-group-prepend">
	      <div class="input-group-text">Create</div>
	    </div>
		<a href="/sales_orders/create/client/{{ $client->id }}"
			class="btn btn-outline-secondary">Sales Order</a>
	  	<a href="/payments/create/client/{{ $client->id }}" 
	  		class="btn btn-outline-secondary">Payment<a>
	</div>

	<div class="btn-group">
		<div class="input-group-prepend">
	      <div class="input-group-text">Back To</div>
	    </div>
		<a href="/clients/search" class="btn btn-outline-primary">Search</a>
		<a href="/sales_orders" class="btn btn-outline-primary">Sales</a>
	 	<a href="/payments" class="btn btn-outline-primary">Payments</a>
	</div>

	<span class="float-right">
	<div class="btn-group">
		@if( $client->to_claims()->count())
			<a href="/clients/{{ $client->id }}/claim" 
				class="btn btn-outline-success">Claim</a>
		@endif
		<a href="/clients/{{ $client->id }}/edit" class="btn btn-outline-warning">Edit</a> 
	 	@if($client->is_active)
			<a href="/clients/{{ $client->id }}/deactivate" 
				class="btn btn-outline-danger">Deactivate</a> 
		@else
			<a href="/clients/{{ $client->id }}/activate" 
				class="btn btn-outline-success">Activate</a> 
		@endif

	</div>

	</span>

	
@endsection

@section('contents')

			<div class="container">

				<table class="table table-bordered table-sm">
					<tr>
						<th style="width:30%">Payables</th>
						<td style="width:20%">
							<span class="badge badge-danger">
								{{ number_format($client->payable_amount(),2) }}
							</span>
						</td>
						<th style="width:30%">To Claims from Packages</th>
						<td style="width:20%">
							<span class="badge badge-success">
								{{ $client->to_claims()->count() }}
							</span>
						</td>
					</tr>

					<tr>
						<th>Member Expiry</th>
						<td>{{ count($client->memberships) ? $client->memberships[0]->pivot->date_end : '---' }}</td>

						<th>Pricelist</th>
						<td>{{ $client->pricelist->name ? $client->pricelist->name : '---' }}</td>
					</tr>

					<tr>
						<th>Birthday</th>
						<td>{{ $client->birthday ? $client->birthday : '---' }}</td>

						<th>Last Visit</th>
						<td>
							{{ $client->last_visit() }}
						</td>
					</tr>
					<tr>
						<th>Mobile No.</th>
						<td>{{ $client->mobile_number ? $client->mobile_number : '---' }}</td>
						<th>Email Address</th>
						<td>{{ $client->email ? $client->email : '---' }}</td>
					</tr>
				</table>
			</div>

			<div class="container">

				<ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-history-tab" data-toggle="pill" href="#pills-history" role="tab" aria-controls="pills-history" aria-selected="true">History</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-salesorders-tab" data-toggle="pill" href="#pills-salesorders" role="tab" aria-controls="pills-salesorders" aria-selected="false">Sales Orders</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-payments-tab" data-toggle="pill" href="#pills-payments" role="tab" aria-controls="pills-payments" aria-selected="false">Payments</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" id="pills-claims-tab" data-toggle="pill" href="#pills-claims" role="tab" aria-controls="pills-claims" aria-selected="false">Claims</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-history" role="tabpanel" aria-labelledby="pills-history-tab">

						@include('clients.partials.history')

					</div>
					<div class="tab-pane fade" id="pills-salesorders" role="tabpanel" aria-labelledby="pills-salesorders-tab">

						@include('clients.partials.sales_orders')

					</div>

					<div class="tab-pane fade" id="pills-payments" role="tabpanel" aria-labelledby="pills-payments-tab">

						@include('clients.partials.payments')

					</div>

					<div class="tab-pane fade" id="pills-claims" role="tabpanel" aria-labelledby="pills-claims-tab">

						@include('clients.partials.claims')

					</div>
				</div>
			</div>	

			@endsection

			@section('scripts')

			<script type="text/javascript">

				var app = new Vue({

					el: '#app',
					data: {
						flash_message: "{{ session('message') }}",
						message_type: "{{ session('message_type') }}"
					},
					created: function () {

						if(this.flash_message)
						{
							Vue.toasted.show(this.flash_message, {
								type: this.message_type,
								duration: 3000,
								position: 'bottom-right',
								theme: 'outline',
							});
						}
					},
				});

			</script>

			@endsection