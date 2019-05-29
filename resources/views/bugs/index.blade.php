@extends('master')

@section ('heading')

	List of Issues
	
@endsection

@section('contents')

<div class="container">
	<table class="table table-striped table-bordered table-sm" id="bug_list">

		<thead>
			<tr>
				<th>Date</th>
				<th>Name</th>
				<th>Title</th>
				<th>Details</th>
				<th>Status</th>
				<th>View</th>
				{{-- <th>Image</th> --}}
		</thead>

		<tbody>
			@foreach ($bugs as $x)
				<tr>
					<td>{{ $x->created_at }}</td>
					<td>{{ $x->user->name }}</td>
					<td>{{ $x->title }}</td>
					<td>{{ $x->details }}</td>
					<td>
						@if($x->status == 'New')
							<span class="badge badge-success">New</span>
						@elseif($x->status == 'Open')
							<span class="badge badge-warning">Open</span>
						@else
							<span class="badge badge-secondary">Close</span>
						@endif
		  			</td>
		  			<td><a href="/bugs/{{ $x->id }}">View</a></td>
					{{-- <td><img height="75px" src="{{ Storage::url($x->filepath) }}"></td> --}}
				</tr>
			@endforeach
		</tbody>

	</table>
</div>

{{ $bugs->links() }}

@endsection
