@extends('master')

@section('heading')

	{{ $client->display_name() }}

	<a href="/sales_orders/create/client/{{$client->id}}"><button type="button" class="btn btn-outline-secondary">Create Sales Order</button><a>

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
				<th>Payables</th>
				<td>
					<span class="badge badge-danger">
						---
					</span>
				</td>
				<th>To Claims from Packages</th>
				<td>
					<span class="badge badge-success">
						---
					</span>
				</td>
			</tr>

			<tr>
				<th>Member Expiry</th>
				<td>
					---
				</td>
				<th>Pricelist</th>
				<td>{{ $client->pricelist->name }}</td>
			</tr>

			<tr>
				<th>Birthday</th>
				<td>{{ $client->birthday ? $client->birthday : '---' }}</td>

				<th>Last Visit</th>
				<td>
					---
				</td>
			</tr>
			<tr>
				<th>Mobile No.</th>
				<td>+{{ $client->mobile_number ? $client->mobile_number : '---' }}</td>
				<th>Email Address</th>
				<td>{{ $client->email ? $client->email : '---' }}</td>
			</tr>
		</table>
	</div>

	<div class="container">
		
		<nav>
			<div class="nav nav-pills nav-justified" id="nav-tab" role="tablist">
			    <a class="nav-item nav-link active" id="nav-history-tab" data-toggle="tab" href="#nav-history" role="tab" aria-controls="nav-history" aria-selected="true">History</a>

			    <a class="nav-item nav-link" id="nav-service purchases-tab" data-toggle="tab" href="#nav-service purchases" role="tab" aria-controls="nav- service purchases" aria-selected="false">Service Purchases</a>

			    <a class="nav-item nav-link" id="nav-product purchases-tab" data-toggle="tab" href="#nav-product purchases" role="tab" aria-controls="nav-product purchases" aria-selected="false">Product Purchases</a>
			    
			    <a class="nav-item nav-link" id="nav-package purchases-tab" data-toggle="tab" href="#nav-package purchases" role="tab" aria-controls="nav-pacakge purchases" aria-selected="false">Package Purchases</a>

			    <a class="nav-item nav-link" id="nav-package claims history-tab" data-toggle="tab" href="#nav-package claims history" role="tab" aria-controls="nav-package claims history" aria-selected="false">P-Claims History</a>
			    
			    <a class="nav-item nav-link" id="nav-payments-tab" data-toggle="tab" href="#nav-payments" role="tab" aria-controls="nav-payments" aria-selected="false">Payments</a>
			</div>



		</nav>

{{-- 			<div class="tab-content" id="nav-tabContent">
			</div> --}}

		@include('clients.partials.history')
		@include('clients.partials.transactions')

	</div>	

@endsection