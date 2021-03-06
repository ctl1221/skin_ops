@extends('master')

@section ('heading')

<div class="container">

	<form method="post" action="/sales_orders/{{ $sales_order->id }}/post">
		
		@csrf

		@if(!$sales_order->is_posted)
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="/sales_orders">Sales Orders</a></li>
				    <li class="breadcrumb-item active" aria-current="page">DT{{ $sales_order->so_number }}
				    	<button type="submit" class="btn btn-outline-success">POST</button>
				    	<button class="btn btn-outline-danger" @click.prevent="deleteSalesOrder('/sales_orders/{{ $sales_order->id }}/delete')">DELETE</button></a>
				    </li>
			  	</ol>
			</nav> 
			
		@else
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="/sales_orders">Sales Orders</a></li>
				    <li class="breadcrumb-item active" aria-current="page">SO{{ $sales_order->so_number }}</li>
			 	</ol>
			</nav> 
		@endif

	</form>

</div>

@endsection

@section('contents')

<div class="container">

	<div class="card">
		<div class="card-body">
			
			<div class="row">
				<div class="form-group col">
					<label for="name">Name:</label>
					<a href="/clients/{{$sales_order->client->id}}">
						<input type="text" class="form-control" 
						id="name" name="name" value="{{ $sales_order->client->display_name() }}" disabled>
					</a>
				</div>

				<div class="form-group col">
					<label for="receptionist">Receptionist:</label>
					<input type="text" class="form-control" 
					id="name" name="receptionist" value="{{ $sales_order->receptionist->name }}" disabled>
				</div>
			</div>

			<div class="row">
				<div class="form-group col">
					<label for="date">Date:</label>
					<input type="date" class="form-control" 
					id="date" name="date" value="{{ $sales_order->date }}" disabled="">
				</div>

				<div class="form-group col">
					<label for="so_no">Draft Number:</label>
					<input type="text" class="form-control" id="so_no" name="so_no" value="{{ $sales_order->so_number }}" disabled>
				</div>
			</div>

			<div class="row">
				<div class="form-group col">
					<label for="branch">Branch:</label>
					<input type="text" class="form-control" id="branch" name="branch" value="{{ $sales_order->branch->name }}" disabled>
				</div>

				<div class="form-group col">
					<label for="cif_number">CIF Number:</label>
					<input type="text" class="form-control" id="cif_number" name="cif_number" value="{{ $sales_order->cif_number }}" disabled>
				</div>
			</div>

			<div class="row mb-3">
				<div class="form-group col">
					<label for="or_number">OR Number:</label>
					<input type="text" class="form-control" id="or_number" name="or_number" value="{{ $sales_order->or_number }}" disabled>
				</div>

				<div class="form-group col">
					<label for="si_number">SI Number:</label>
					<input type="text" class="form-control" id="si_number" name="si_number" value="{{ $sales_order->si_number }}" disabled>
				</div>
			</div>


			<div class="table-responsive">
				<table class="table table-bordered table-sm mb-4">

					<thead>

						<tr>
							<th colspan="6" class="text-center bg-secondary text-white">
								<h5 class="mt-1 mb-1">Item Details</h5>
							</th>
						</tr>

						<tr>
							<th>Type</th>
							<th>Item</th>
							<th>Price</th>
							<th>Sold By</th>
							<th>Treated By</th>
							<th>Assisted By</th>
						</tr>

					</thead>

					<tbody>

						@foreach($sales_order->sales_order_lines as $x)
						<tr>
							<td>{{ substr($x->sellable_type, 4)}}</td>
							<td>{{ $x->sellable->name}}</td>
							<td>{{ number_format($x->price,2) }}</td>
							<td>{{ $x->seller ? $x->seller->display_name() : '---' }}</td>
							<td>{{ $x->treater ? $x->treater->display_name() : '---' }}</td>
							<td>{{ $x->assistant ? $x->assistant->display_name() : '---' }}</td>
						</tr>
						@endforeach

					</tbody>

				</table>
			</div>   

			<div class="table-responsive">
				<table class="table table-bordered table-sm mb-4">

					<thead>

						<tr>
							<th colspan="3" class="text-center bg-secondary text-white">
								<h5 class="mt-1 mb-1">Discounts and Freebies</h5>
							</th>
						</tr>

						<tr>
							<th>Type</th>
							<th>Amount</th>
							<th>Reference</th>
						</tr>

					</thead>

					<tbody>

						@foreach($sales_order->payments as $x)
						@if($x->payment_type->is_subtractable)
						<tr>
							<td>{{ $x->payment_type->name }}</td>
							<td>{{ $x->amount }}</td>
							<td>{{ $x->reference }}</td>
						</tr>
						@endif
						@endforeach

					</tbody>

				</table>
			</div>   

			<div class="table-responsive">
				<table class="table table-bordered table-sm mb-4">

					<thead>

						<tr>
							<th colspan="3" class="text-center bg-secondary text-white">
								<h5 class="mt-1 mb-1">Payment Modes</h5>
							</th>
						</tr>

						<tr>
							<th>Type</th>
							<th>Amount</th>
							<th>Reference</th>
						</tr>

					</thead>

					<tbody>

						@foreach($sales_order->payments as $x)
						@if($x->payment_type->is_direct || $x->payment_type->is_external)
						<tr>
							<td>{{ $x->payment_type->name }}</td>
							<td>{{ number_format($x->amount,2) }}</td>
							<td>{{ $x->reference }}</td>
						</tr>
						@endif
						@endforeach

					</tbody>

				</table>
			</div> 

			<div class="row">
				<div class="col-7">
					<textarea class="form-control" id="notes" name="notes" rows="5" placeholder="Notes / Remarks..." readonly>{{ $sales_order->notes }}</textarea>

				</div>
				<div class="col-5">
					<table class="table table-bordered table-sm">
						<tr>
							<td>
								Total Bill
							</td>
							<td>
								{{ number_format($a = $sales_order->total_price(), 2) }}
							</td>
						</tr>
						<tr>
							<td>
								Less: Discounts 
							</td>
							<td>
								{{ number_format($b = $sales_order->total_discount(), 2) }}
							</td>
						</tr>
						<tr>

							<td>
								Total Pay
							</td>
							<td>
								{{ number_format($c = $sales_order->total_pay(), 2) }}
							</td>
						</tr>
						<tr>
							<td>
								Remaining Balance
							</td>
							<td>
								{{ number_format($a - $b - $c,2) }}
							</td>
						</tr>
					</table>
				</div>
			</div>

		</div>
	</div>

	<br>


	@role('management')
		<a href="/sales_orders/{{ $sales_order->id }}/edit" class="btn btn-outline-warning btn-block">Edit</a>
		<br/>
		<form method="post" action="/sales_orders/{{ $sales_order->id }}/destroy">
			@csrf

			<input type="submit" value="Delete" class="btn btn-outline-danger btn-block">

		</form>
	@endRole

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
		methods: {
			deleteSalesOrder: function(url, id) {
				axios.post(url)
					.then(response =>
					{
						window.location.href = "/sales_orders";
					}
				);
			},
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
