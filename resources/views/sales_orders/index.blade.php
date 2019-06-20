@extends ('master')

@section ('heading')
	
	List of Sales Orders

@endsection

@section ('contents')

	<my-vuetable
	index_url="{{ $index_url }}"
    :fields="{{ $fields }}"
    api_url="{{ $api_url }}"
    per_page="{{ $per_page }}"
    hints="Search: [Date],[Reference],[Client], Sort: [Date], [Reference]"
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
