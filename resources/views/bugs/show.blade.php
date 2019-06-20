@extends('master')

@section ('heading')
	Issue Number: {{ $bug->id }} 

	<a href="/bugs"><button type="button" class="btn btn-outline-primary">Back</button></a> 

	@if($bug->status == 'New')
		<a href="/bugs/{{ $bug->id }}/open"><button type="button" class="btn btn-outline-warning">Open</button>

	@elseif($bug->status == 'Open')
		<a href="/bugs/{{ $bug->id }}/close"><button type="button" class="btn btn-outline-secondary">Close</button>

	@endif

	<a href="/bugs/{{ $bug->id }}/delete"><button type="button" class="btn btn-outline-danger">Delete</button></a>	

@endsection

@section ('contents')

	<div class="container">

	<table class="table table-sm table-bordered">

		<tr>	
			<th>Title:</th>
			<td>{{ $bug->title }}</td>
		</tr>

		<tr>
			<th>Status:</th>
			<td>{{ $bug->status }}</td>
		</tr>
		
		<tr>		
			<th>Details:</th>
			<td>{{ $bug->details }}</td>
		</tr>

		<tr>
			<th>Image:</th>
			<td class="text-center"><img src="{{ Storage::url($bug->filepath) }}" width="80%"></td>
		</tr>

	</table>

	</div>

@endsection