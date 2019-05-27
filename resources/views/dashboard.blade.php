@extends ('master')


@section('heading')

@endsection


@section ('contents')
	
	<my-calendar></my-calendar>

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
