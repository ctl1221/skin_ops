@extends('master')

@section('contents')

	Create New Sales Order
	
	<br>

	Client: {{ $client->display_name() }}

	<sales-order-grid 
		:sellables="{{ $sellables }}"
		:client_id="{{ $client->id }}"
		:price_disable="false">
		{{ csrf_field() }}
	</sales-order-grid>

@endsection

@section('scripts')

var app = new Vue({
  el: '#app', 
  data: {},
})

@endsection