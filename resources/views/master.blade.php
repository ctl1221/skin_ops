<!DOCTYPE html>
<html>

<head>
	<title>SkinPro System</title>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	
	<script src="{{ mix('js/app.js')}}"></script>

</head>

<body>
	@include('nav')
	
	<div id="app">
		<body>

			<div class="container">
				<h1 class="mb-3">
					@yield('heading')
				</h1>

				<div class="row mb-3 justify-content-center">
					@yield('subcontent')
				</div>

				<div class="row">
					@yield('contents')
				</div>
			</div>
		</body>
	</div>
</body>

@yield('scripts')

</html>