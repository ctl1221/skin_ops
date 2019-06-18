@extends('master')

@section ('heading')

	List of Payments
	<a href="/payments/create">
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
				<th>Name</th> 
				<th>Branch</th>
				<th>Email</th>
		</thead>

		<tbody>
			<tr>
				<td></td>
			</tr>
		</tbody>

	</table>
</div>

@endsection