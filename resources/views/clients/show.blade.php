@extends('master')

@section('contents')

{{ $client->display_name() }}

<a href="/sales_orders/create/client/{{$client->id}}">Create<a>

@endsection