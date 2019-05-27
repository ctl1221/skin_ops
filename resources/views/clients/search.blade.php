@extends ('master')

@section('heading')
	Search for Client
@endsection

@section('contents')
	
	<client-search 
		min_char_first_name = 3
		min_char_last_name = 2
		mode = "search"
	/>

@endsection

@section('scripts')

<script type="text/javascript">

var app = new Vue({
  el: '#app', 
  data: {},
})

</script>

@endsection

