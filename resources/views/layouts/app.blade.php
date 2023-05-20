<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<link href="{{ asset("css/app.css") }}" rel="stylesheet" />

		<title>{{ config("app.name", "Laravel") }}</title>

		<link rel="dns-prefetch" href="//fonts.gstatic.com" />
		<link
			href="https://fonts.bunny.net/css?family=Nunito"
			rel="stylesheet"
		/>

		<!-- Font Awesome -->
		<script
			src="https://kit.fontawesome.com/55aa416c9f.js"
			crossorigin="anonymous"
		></script>
	</head>

	<body>
		<div
			id="app"
			style="
				background: linear-gradient(
					to bottom,
					#99ffe700,
					#2a1ed329
				) !important;
			"
		>
			@include("widgets.header")
			<div class="pb-5" style="min-height: 600px; padding-top: 90px">
				@yield("content")
			</div>
			@include("widgets.footer")
		</div>
		<script src="{{ mix("/js/app.js") }}"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script
			src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
			integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
			crossorigin="anonymous"
		></script>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
			integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
			crossorigin="anonymous"
		></script>
		@yield("scripts")
	</body>
</html>
