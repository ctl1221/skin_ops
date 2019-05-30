@extends ('master')


@section('heading')
Calendar: {{ Auth::user()->branch->name }}
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
