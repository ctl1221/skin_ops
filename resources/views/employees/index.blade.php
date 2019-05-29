@extends('master')

@section ('heading')

	List of Employees
	<a href="/employees/create"><button type="button" class="btn btn-outline-success">+ New</button></a>
	
@endsection

@section('contents')

	<my-vuetable
	index_url="{{ $index_url }}"
    :fields="{{ $fields }}"
    api_url="{{ $api_url }}"
    per_page="{{ $per_page }}"
    ></my-vuetable>

{{-- <div class="container">
	<table class="table table-striped table-bordered table-sm" id="employee_list">

		<thead>
			<tr>
				<th>Name</th> 
				<th>Branch</th>
				<th>Status</th>
		</thead>

		<tbody>
			@foreach ($employees as $x)
				<tr>
					<td><a href="/employees/{{ $x->id }}">{{ $x->display_name() }}<a></td>
					<td>{{ $x->branch->name }}</td>
					<td>
		        		<span class="badge {{ $x->is_active ? 'badge-success': 'badge-danger' }}">
		        		{{ $x->is_active ? 'Active' : 'Inactive' }} 
		  				</span>
		        	</td>
				</tr>
			@endforeach
		</tbody>

	</table>
</div>

{{ $employees->links() }}
 --}}

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

