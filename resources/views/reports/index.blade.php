@extends ('master')


@section ('heading')

	List of Generated Reports

	<a href="/reports/create">
		<button type="button" class="btn btn-outline-success" >+ New</button>
	</a>
	
@endsection


@section ('contents')

	<table class="table table-striped table-bordered table-sm text-center">
		
		<thead>
			<tr>
				<th>Reference</th>
				<th>Name</th>
				<th>Date Range</th>
				<th>Branch</th>
				<th>Type</th>
				<th>User</th>
				<th>View</th>
			</tr>
		</thead>

		<tbody>
			@foreach($reports as $x)
			<tr>
				<td class="align-middle">RT {{ $x->rt_number }}</td>
				<td class="align-middle">{{ $x->name }}
				<td class="align-middle">{{ \Carbon\Carbon::parse($x->from)->toFormattedDateString() }} 
					-
					{{ \Carbon\Carbon::parse($x->to)->toFormattedDateString() }}
				</td>
				<td class="align-middle">{{ $x->branch }}</td>
				<td class="align-middle">{{ $x->type }}</td>
				<td class="align-middle">{{ $x->user->name }}</td>
				<td class="align-middle">
					@if($x->is_generated)
						<span class="form-inline justify-content-center">
							<form method="post" action="/reports/download">
								@csrf
								<input type="hidden" name="file_name" value="{{$x->rt_number}}">
								<button type="submit" class="btn btn-link">Download</button>	
							</form>

							<form method="post" action="/reports/{{$x->rt_number}}/delete">
								@csrf
								@method('delete')
								<button type="submit" class="btn btn-link" style="color:#FF0000">Delete</button>	
							</form>
						</span>
					@else
						<span class="btn btn-link">Generating...</span>
					@endif					
				</td>
			</tr>
			@endforeach
		</tbody>

	</table>
	
	{{ $reports->links() }} 

@endsection
