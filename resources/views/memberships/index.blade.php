@extends('master')

@section ('heading')

List of Memberships

<a href="/memberships/create"><button type="button" class="btn btn-outline-success">+ New</button></a>

{{-- <td><a href="/memberships/edit"><button type="button" class="btn btn-outline-warning">Edit</button></a></td> --}}

@endsection

@section('contents')

<table class="table table-striped table-bordered table-sm" id="client_list">

	<thead>
		<tr>
			<th width="60%" class="text-center">Name</th>
			<th width="10%" class="text-center">Days Valid</th>
			<th width="15%" class="text-center">Price</th>
			<th width="15%" class="text-center">Status</th>
		</tr>
	</thead>

</table>

	@foreach ($memberships as $x)
	<table class="table table-sm table-bordered table-fullwidth mt-3">
		@foreach ($x->breakdowns as $y)
		<tr>
			@if($loop->first)
			<td rowspan="{{ count($x->breakdowns) }}" class="text-center align-middle" width="30%">{{ $x->name }}</td>
			@endif

			<td width="30%">{{ $y->quantity . " x " . $y->sellable->name }}</td>

			@if($loop->first)
			<td rowspan="{{ count($x->breakdowns) }}" class="text-center align-middle" width="10%">{{ $x->days_valid }}</td>
			@endif

			@if($loop->first)
			<td rowspan="{{ count($x->breakdowns) }}" class="text-center align-middle" width="15%">{{ $x->pricelists[0]->price }}</td>
			@endif

			@if($loop->first)
			<td rowspan="{{ count($x->breakdowns) }}" class="text-center align-middle" width="15%">
				<span class="badge {{ $x->is_active ? 'badge-success': 'badge-danger' }}">
					{{ $x->is_active ? 'Active' : 'Inactive' }} 
				</span>
			</td>
			@endif
		</tr>	
		@endforeach	
	</table>
	@endforeach

	@endsection
