@extends('master')

@section ('heading')

	List of Payments
	
@endsection

@section ('contents')

	<my-vuetable
		index_url="{{ $index_url }}"
	    :fields="{{ $fields }}"
	    api_url="{{ $api_url }}"
	    per_page="{{ $per_page }}"
    ></my-vuetable>	

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


{{-- @section('contents')

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

@endsection --}}