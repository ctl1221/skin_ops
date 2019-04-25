@extends('master')

@section ('heading')

	List of Clients
	<a href="/clients/create"><button type="button" class="btn btn-outline-success" >+ New</button></a>
	
@endsection

@section('contents')

<div class="container">
	<table class="table table-striped table-bordered table-sm" id="client_list">

		<thead>
			<tr>
				<th>Name</th>
				<th>Payables</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($clients as $x)
				<tr>
					<td><a href="/clients/{{ $x->id }}">{{ $x->display_name() }}<a></td>
					<td>---</td>
				</tr>
			@endforeach
		</tbody>

	</table>
</div>

{{ $clients->links() }}

@endsection
