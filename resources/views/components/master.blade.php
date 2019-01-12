<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	@include('components.head')
	
</head>
<body>
	@include('components.nav')
	<div class="container px-5 mb-5">
		@yield('content')
	</div>
</body>
</html>