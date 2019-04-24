@extends('master')

@section('heading')

	{{ $client->display_name() }}

	<a href="/clients"><button type="button" class="btn btn-outline-primary">Back</button></a> 
	<a href="/clients/search"><button type="button" class="btn btn-outline-primary">Back to Search</button></a> 

	<a href="/clients/{{ $client->id }}/edit"><button type="button" class="btn btn-outline-warning">Edit</button></a> 

	@if($client->is_active)
	<a href="/clients/{{ $client->id }}/deactivate"><button type="button" class="btn btn-outline-danger">Deactivate</button></a> 
	
	@else
	<a href="/clients/{{ $client->id }}/activate"><button type="button" class="btn btn-outline-success">Activate</button></a> 

	@endif

	<a href="/sales_orders/create/client/{{$client->id}}"><button type="button" class="btn btn-outline-secondary">Create Sales Order</button><a>

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
				<td>---</td>
			</tr>

			<tr>
				<th>Birthday</th>
				<td>
					---
				</td>
				<th>Last Visit</th>
				<td>
					---
				</td>
			</tr>
			<tr>
				<th>Mobile No.</th>
				<td>---</td>
				<th>Email Address</th>
				<td>---</td>
			</tr>
		</table>
	</div>

@endsection