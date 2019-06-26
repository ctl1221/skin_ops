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
	    hints="Search: [Date],[Reference],[Amount],[Payment Type], Sort: [Date],[Reference],[Amount],[Payment Type]"
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
