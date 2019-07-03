<div class="card">
	<div class="card-body bg-light">
		@if(!$claims->count())
			<center>No Records Found</center>
		@else
		<table class="table table-bordered table-sm text-center align-middle my_table_shadow">
			<thead>
				<tr>
					<th>Reference</th>
					<th>Claim Date</th>
					<th>Service</th>
					<th>Claimed By</th>
					<th>Treated By</th>
					<th>Branch</th>
				</tr>
			</thead>
			<tbody>
				@foreach($claims as $x)
				<tr>
					<td>
						<a href="/sales_orders/{{$x->parent->id}}">SO {{ $x->parent->so_number }}</a>
					</td>
					<td>{{ $x->claimed_by_date ? $x->claimed_by_date : '---'}}</td>
					<td>{{ $x->sellable->name }}</td>
					<td>{{ $x->claimed_by_id ? $x->claimed_by->display_name() : '---'}}</td>
					<td>{{ $x->treated_by_id ? $x->treated_by->display_name() : '---'}}</td>
					<td>{{ $x->branch->name ? $x->branch->name : '---' }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endif
	</div>
</div>