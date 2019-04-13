@extends ('master')

@section ('heading')

List of Packages

@endsection

@section ('contents')
	<table class="table table-bordered table-sm bg-primary">
		
		<thead>
			<tr>
				<th width="10%">Status</th>
				<th width="30%">Name</th>
				<th width="30%">Package Breakdown</th>
				<th width="15%">Type</th>
				<th width="15%">Quantity</th>
			</tr>
		</thead>
	</table>


	@foreach ($packages as $x)
	<table class="table table-bordered table-sm bg-light" style="box-shadow: -1.5px 1.5px #F0F0F0;">
		<tr>
			<td rowspan="{{ $x->breakdowns->count() }}" class="text-center align-middle" width="10%">
				<h3><span class="badge {{ $x->is_active ? 'badge-success': 'badge-danger' }}">
					{{ $x->is_active ? 'Active' : 'Inactive' }} 
				</span></h3>
			</td>

			<td rowspan="{{ $x->breakdowns->count() }}" class="text-center align-middle" width="30%">
				<a class="text-secondary" href="/packages/{{ $x->id }}">{{ $x->name }}</a>
			</td>
			@foreach($x->breakdowns as $y)
				<td width="30%">{{ $y->sellable->name }}</td>
				<td width="15%">{{ substr($y->sellable_type,4) }}</td>
				<td width="15%">{{ $y->quantity }}</td>
				</tr>
			@endforeach

		</tr>
		

	</table>
	@endforeach

{{ $packages->links() }}	

@endsection