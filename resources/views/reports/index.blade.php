@extends ('master')


@section('heading')

@endsection


@section ('contents')
	
	<form method="post" action="/reports/download">

		@csrf

		<button type="submit">Download</button>	

	</form>

@endsection
