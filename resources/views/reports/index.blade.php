@extends ('master')


@section ('heading')

	List of Generated Reports

	<a href="/reports/create">
		<button type="button" class="btn btn-outline-success" >+ New</button>
	</a>
	
@endsection


@section ('contents')

	<table class="table table-bordered table-sm">
		<thead>
			<tr>
				<th>Report</th>
				<th>Date Range</th>
			</tr>
		</thead>
		<tbody>
			<tr>

			</tr>
		</tbody>
	</table>
	
	<form method="post" action="/reports/download">

		@csrf

		<button type="submit">Download</button>	

	</form>

@endsection
