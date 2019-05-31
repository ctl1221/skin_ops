@extends('master')

@section('heading')

{{ $client->display_name() }}

<a href="/sales_orders/create/client/{{ $client->id }}"><button type="button" class="btn btn-outline-secondary">Create Sales Order</button><a>

	@if( $client->to_claims()->count() )
	<a href="/clients/{{ $client->id }}/claim"><button type="button" class="btn btn-outline-secondary">Claim Packages</button><a>
	@endif

<a href="/payments/create/client/{{ $client->id }}"><button type="button" class="btn btn-outline-secondary">Create Payment</button><a>

<a href="/clients"><button type="button" class="btn btn-outline-primary">Back</button></a> 
<a href="/clients/search"><button type="button" class="btn btn-outline-primary">Back to Search</button></a> 
<a href="/clients/{{ $client->id }}/edit"><button type="button" class="btn btn-outline-warning">Edit</button></a> 

	@if($client->is_active)
	<a href="/clients/{{ $client->id }}/deactivate"><button type="button" class="btn btn-outline-danger">Deactivate</button></a> 

	@else
	<a href="/clients/{{ $client->id }}/activate"><button type="button" class="btn btn-outline-success">Activate</button></a> 

	@endif

@endsection

@section('contents')

<div class="container">

	<table class="table table-bordered table-sm">
		<tr>
			<th style="width:30%">Payables</th>
			<td style="width:20%">
				<span class="badge badge-danger">
					{{ $client->payable_amount() }}
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