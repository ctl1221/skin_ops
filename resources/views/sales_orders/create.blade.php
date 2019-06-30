@extends('master')

@section('heading')

Create Transaction - <a href="/clients/{{ $client->id }}">{{ $client->display_name() }}</a>

@endsection

@section('contents')

<div class="container mb-5">
	<div class="card">
		<div class="card-body">
			<form method="post" action="/sales_orders">

				@csrf

				<div class="row">
					<div class="form-group col">
						<label for="date">Date:</label>
						<input type="date" class="form-control" 
						id="date" name="date" 
						value="{{\ Carbon\Carbon::now()->toDateString() }}" 
						min="{{ $min_date }}"
						required>
					</div>

					<div class="form-group col">
						<label for="receptionist">Receptionist:</label>
						<input type="text" class="form-control" id="receptionist" value="{{ Auth::user()->name }}"disabled>
					</div>
				</div>

				<input type="hidden" name="branch_id" value="{{ Auth::user()->branch->id }}">

				<input type="hidden" name="receptionist_id" value="{{ Auth::id() }}">

				<div class="row mb-3">
					<div class="form-group col">
						<label for="branch">Branch:</label>
						<input type="text" class="form-control" id="branch" value="{{ Auth::user()->branch->name }}" disabled>
					</div>

					<div class="form-group col">
						<label for="pricelist">Pricelist:</label>
						<input type="text" class="form-control" id="pricelist_id" value="{{ $client->pricelist->name }}" disabled>
					</div>
				</div>

				<sales-order-grid 
					@zeroed="submittable = false"
					@nonzeroed="submittable = true"
					:u_sellables="{{ $sellables }}"
					:employees="{{ $employees }}"
					:client_id="{{ $client->id }}"
					:ordered_ids="{{ $ordered_ids }}"
					@totalpricechanged = "totalPrice = $event.totalPrice"
				></sales-order-grid>

				<payment-list
					:payment_types="{{ $payment_types }}"
					@totalpayingchanged = "totalPay = $event.totalPay"
					>
				</payment-list>

				<div class="row">
					<div class="col-7">
						<textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Notes / Remarks..."></textarea>

					</div>
					<div class="col-5">
						<table class="table table-bordered table-sm">
							<tr>
								<td>
									Total Bill
								</td>
								<td>
									@{{ totalPrice | currencyFormat}}
								</td>
							</tr>
							<tr>

								<td>
									Total Pay
								</td>
								<td>
									@{{ totalPay | currencyFormat}}
								</td>
							</tr>
							<tr>
								<td>
									Remaining Balance
								</td>
								<td>
									@{{ totalPrice - totalPay | currencyFormat}}
								</td>
							</tr>
						</table>
					</div>
				</div>


				<div class="row mt-5">   
					<div class="col-8 mr-0">
						<input type="submit" value="Submit" class="btn btn-outline-success btn-block" :disabled="! submittable">
					</div>

					<div class="col-4 ml-0">
						<a href="/clients/{{ $client->id }}">
							<button type="button" class="btn btn-outline-danger btn-block">Cancel</button>
						</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">
	var app = new Vue({
		el: '#app', 
		
		data: { 
			totalPrice: 0,
			totalPay: 0,
			submittable: true,
		},
	})
</script>

@endsection