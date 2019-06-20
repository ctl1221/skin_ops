<table class="table table-sm table-bordered my_table_shadow">

	<tr>
		<td class="text-center align-middle" rowspan="5" style="width: 30%">
			{{ $x->parent->branch->name }} <br/>

			@if($x->parent->claimed_by_id == $client->id && $x->parent->parent->client_id == $client->id)
			Claimed Own Package
			
			@elseif($x->parent->claimed_by_id == $client->id && $x->parent->parent->client_id != $client->id)
			Received A Package
			
			@else
			
			Gave A Package
			@endif
			<br/> {{ \Carbon\Carbon::parse($x->parent->claimed_by_date)->toFormattedDateString() }}
		</td>
	</tr>

	<tr>
		<td>
			<u>{{ $x->parent->sellable->name}}</u>
		</td>
	</tr>

	@if($x->parent->claimed_by_id == $client->id && $x->parent->parent->client_id == $client->id)
		<tr>
			<td>
				Treated By: <u>{{ $x->parent->treated_by ? $x->parent->treated_by->display_name() : 'No One' }}</u>
			</td>
		</tr>

		<tr>
			<td>
				Assisted By: <u>{{ $x->parent->assisted_by ? $x->parent->assisted_by->display_name() : 'No One' }}</u>
			</td>
		</tr>
	
	@elseif($x->parent->claimed_by_id == $client->id && $x->parent->parent->client_id != $client->id)
		<tr>
			<td>
				Received from: <u>{{ $x->parent->parent->client->display_name() }}</u>
			</td>
		</tr>

		<tr>
			<td>
				Treated By: <u>{{ $x->parent->treated_by ? $x->parent->treated_by->display_name() : 'No One' }}</u>
			</td>
		</tr>

		<tr>
			<td>
				Assisted By: <u>{{ $x->parent->assisted_by ? $x->parent->assisted_by->display_name() : 'No One' }}</u>
			</td>
		</tr>

	@else

		@if( $x->parent->claimed_by_id != $client->id)
			<tr>
				<td>
					Used by: <u>{{ $x->parent->claimed_by->display_name() }}
				</td>
			</tr>

			<tr>
				<td>
					Sales Order: {{ $x->parent->parent->so_number }}</u>
				</td>
			</tr>
		@endif
	
	@endif

	</table>