@extends ('master')

@section ('heading')
	
	List of Services
	<a href="/services/create"><button type="button" class="btn btn-outline-success">+ New</button></a> 

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
		@foreach ($services as $x)
			<tr>
				<td><a class="text-secondary" href="/services/{{ $x->id }}">{{ $x->name }} </a></td>
				<td>
	        		<span class="badge {{ $x->is_active ? 'badge-success': 'badge-danger' }}">
	        		{{ $x->is_active ? 'Active' : 'Inactive' }} 
	        		</span>
	        	</td>
	        </tr>
		@endforeach
		</tbody>

	</table>

	{{ $services->links() }} --}}	

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
