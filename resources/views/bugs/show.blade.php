@extends('master')

@section ('heading')
	Issue Number: {{ $bug->id }}
@endsection

@section ('contents')

	<div class="container">

	<table class="table table-sm table-bordered">

		<tr>	
			<th>Title:</th>
			<td>{{ $bug->title }}</td>
		</tr>
		
		<tr>		
			<th>Details:</th>
			<td>{{ $bug->details }}</td>
		</tr>

		<tr>
			<th>Image:</th>
			<td class="text-center"><img src="{{ Storage::url($bug->filepath) }}"></td>
		</tr>

	</table>

	</div>

@endsection