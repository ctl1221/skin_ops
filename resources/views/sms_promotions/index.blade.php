@extends('master')

@section ('heading')

	List of SMS Promotions Sent
	<a href="/sms_promotions/create">
		<button type="button" class="btn btn-outline-success">
			+ New
		</button>
	</a>
	
@endsection

@section('contents')

<div class="container">
	<table class="table table-striped table-bordered table-sm" id="user_list">

		<thead>
			<tr>
				<th>Date</th> 
				<th>Details</th>
				<th>Type</th>
		</thead>

		<tbody>
			@foreach ($sms_promotions as $x)
				<tr>
					<td>{{ $x->created_at->toFormattedDateString() }}</td>
					<td>{!! nl2br($x->details) !!}</td>
					<td>{{ $x->type }}</td>
				</tr>
			@endforeach
		</tbody>

	</table>
</div>


@endsection