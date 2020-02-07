<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title') {{ config('app.name', 'DNS Manager') }}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link rel="shortcut icon" type="image/x-icon" href="https://cdn4.iconfinder.com/data/icons/web-hosting-2-2/32/DNS_Track-512.png"/>
</head>
<body style="background-color: #F4F5F7">
	@include('layouts.header')
	<div class="container">
    	@yield('conteudo')
	</div>
	@include('layouts.scripts')
</body>
</html>
