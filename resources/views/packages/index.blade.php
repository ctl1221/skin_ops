@extends ('master')

@section ('heading')
	
List of Packages

<a href="/packages/create"><button type="button" class="btn btn-outline-success" >+ New</button></a>
	
@endsection

@section ('contents')

	<my-vuetable
	index_url="{{ $index_url }}"
    :fields="{{ $fields }}"
    api_url="{{ $api_url }}"
    per_page="{{ $per_page }}"
    ></my-vuetable>

	{{-- <table class="table table-bordered table-sm">
	
		<thead class="thead-light">
			<tr>
				<th>Name</th>
				<th>Status</th>
			</tr>
		</thead>

		<tbody>
		@foreach ($packages as $x)
			<tr>
				<td><a class="text-secondary" href="/packages/{{ $x->id }}">{{ $x->name }}</a></td>
				@if($x->is_active)
		        <td><span class="badge badge-success">Active</span></td>
		        @else
		        <td><span class="badge badge-danger">Inactive</span></td>
		        @endif
			</tr>
		@endforeach
		</tbody>

	</table>

	{{ $packages->links() }}	 --}}

@endsection

@section('scripts')
  
  <script type="text/javascript">
	var app = new Vue({
  		
  		el: '#app',
  		data: {			  				
  		},
	});
  </script>

@endsection
