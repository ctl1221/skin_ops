<!DOCTYPE html>
<html>

<head>
	<title>SkinPro System</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css')}}">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	
</head>

<body style="background-color: #FFFFFF">
	@include('nav')
	
	<div id="app">
		<body>
			<div class="container-fluid px-5 pb-5 mb-5">
				<h1 class="mt-4 mb-3">
					@yield('heading')
				</h1>

{{-- 				<div class="row mb-3 justify-content-center">
					@yield('subcontent')
				</div> --}}

					@yield('contents')
			</div>
		</body>
	</div>
</body>

<script src="{{ mix('js/app.js')}}"></script>

@yield('scripts')

</html>