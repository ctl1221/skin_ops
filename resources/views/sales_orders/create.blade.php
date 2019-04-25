@extends('master')

@section('heading')

New Sales Order: {{ $client->display_name() }}

<a href="/clients"><button type="button" class="btn btn-outline-danger">Cancel</button></a>

@endsection

@section('contents')

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