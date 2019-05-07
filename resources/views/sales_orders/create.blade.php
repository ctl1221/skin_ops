@extends('master')

@section('heading')

New Sales Order: {{ $client->display_name() }}

<a href="/clients"><button type="button" class="btn btn-outline-danger">Cancel</button></a>

@endsection

@section('contents')

<form method="post" action="/sales_orders">
	{{ csrf_field() }}

	<div class="form-group">
	    <label for="date">Date:</label>
	    <input type="date" class="form-control" id="date" name="date" required>
	</div>

	<div class="form-group">
	    <label for="so_no">SO Number:</label>
	    <input type="text" class="form-control" id="so_no" name="so_no" required>
	</div>

	<sales-order-grid 
		:sellables="{{ $sellables }}"
		:client_id="{{ $client->id }}"
		:price_disable="false"
		@totalpricechanged = "totalPrice = $event.totalPrice"
		>
	</sales-order-grid>

	<payment-list
		:payment_types="{{ $payment_types }}"
		@totalpayingchanged = "totalPay = $event.totalPay"
		>
	</payment-list>

	<input type="submit" value="Submit">

	<br>

	Total Bill : @{{ totalPrice | currencyFormat}} <br>
	Total Pay  : @{{ totalPay | currencyFormat}} <br>
	Remaining Balance: @{{ totalPrice - totalPay | currencyFormat}}

	</form>


@endsection

@section('scripts')

<script type="text/javascript">
	var app = new Vue({
		el: '#app', 
		data: { 
			totalPrice: 0,
			totalPay: 0,
		},

	})
</script>

@endsection