@extends('master')

@section('contents')

{{ $client->display_name() }}

<a href="/sales_orders/create/client/{{$client->id}}">Create<a>

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