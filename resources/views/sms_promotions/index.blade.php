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

<table class="table table-striped table-bordered table-sm text-center" id="user_list">

	<thead>
		<tr>
			<th>Date</th> 
			<th>Details</th>
			<th>Type</th>
		</thead>

		<tbody>
			@foreach ($sms_promotions as $x)
			<tr>
				<td class="align-middle" width="15%">{
					{{ $x->created_at->toFormattedDateString() }}
				</td>
				<td class="text-left" width="70%">{!! nl2br($x->details) !!}</td>
				<td class="align-middle" width="15%">{{ $x->type }}</td>
			</tr>
			@endforeach
		</tbody>

	</table>


	@endsection