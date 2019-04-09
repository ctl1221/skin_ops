<!DOCTYPE html>
<html>

<head>
	<title>SkinPro System</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css')}}">
	<script src="{{ mix('js/app.js')}}"></script>
	
</head>

<body>
	@include('nav')
	
	<div id="app">
		@yield('contents')
	</div>
</body>



<script type="text/javascript">
	@yield('scripts')
</script>

</html>