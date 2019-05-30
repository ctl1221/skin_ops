<div class="tab-pane fade show active" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
	<div class="card">
		<div class="card-body">
			<table class="table table-sm table-bordered">
				<tr>
					<th class="text-center">Date</th>
					<th class="text-center">Activity</th>
				</tr>

				@foreach($client->histories as $x)
					@if($x->parent_type == 'App\\SalesOrder')
						<tr>
							<td class="text-center" rowspan="3">{{  \Carbon\Carbon::parse($x->date)->toFormattedDateString() }}</td>
							<td>Sales Order : <u>{{ $x->parent->so_number }}</u> </td>
						</tr>
						<tr>
							<td>
								@foreach($x->parent->sales_order_lines as $y)
									{{ $y->sellable->name }}
									<br>
								@endforeach
							</td>
						</tr>

						
						<tr>
							<td>
								@if( $x->parent->payments->count() )
								Paid 
									@foreach( $x->parent->payments as $z)
									<b>{{ number_format($z->amount,2) }}</b> using <u>{{ $z->payment_type->name }}</u>
									@endforeach
								@else
								No payment made
								@endif
							</td>
						</tr>	

					@endif
				@endforeach

			</table>

			{{-- {{ $activities->appends([
				'activities' =>$activities->currentPage(),
				'payments' => $payments->currentPage(),
				])->links()}}

				@else
				<h6 class="text-center">No Records Found.</h6>
				@endif --}}

			</div>
		</div>
	</div>