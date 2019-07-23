@extends('master')

@section('heading')

@endsection

@section('contents')

	<table>
		@foreach($category->items->where('sellable_type','App\Service') as $x)
			<tr>
				<td>
					{{ $x->sellable->name }}
					<a href="/categories/{{ $category->id }}/delete_service/{{ $x->sellable->id }}">X
					</a>
				</td>
			</tr>
		@endforeach
	</table>
	
	<form method="post" action="/categories/{{ $category->id }}/add_service">
		@csrf

		<select name="service_id">
			@foreach($services as $x)
				@if(!in_array($x->id, $service_items))
					<option value="{{ $x->id }}">{{ $x->name }}</option>
				@endif
			@endforeach
		</select>

		<input type="submit" value="Add to Category">

	</form>

@endsection
