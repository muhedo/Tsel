<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') | Telkomsel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset ('dist/img/Telkomsel-logo.png') }}">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('dist/css/bootstrap.min.css') }}">
    <!-- animate CSS
		============================================ -->
    {{-- <link rel="stylesheet" href="{{ asset ('dist/css/animate.css') }}"> --}}
    <!-- main CSS
		============================================ -->
    {{-- <link rel="stylesheet" href="{{ asset ('dist/css/main.css') }}"> --}}
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('dist/css/style.css') }}">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('dist/css/responsive.css') }}">
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

  <div class="bg-login">
    <div class="error-pagewrap">
      <div class="error-page-int">
        <div class="text-center m-b-md custom-login">
          <img class="imgborder logo" src="{{ asset ('dist/img/mainlogo-2022.png') }}" alt="logo">
          <h3>@yield('page_title')</h3>
        </div>
        {{-- Main content --}}
        <div class="content-error">
          <div class="hpanel">
            @yield('content')  
          </div>
        </div>
          {{-- End content --}}
        <div class="text-center login-footer">
          <br><br><br><br><br><br><br>
          <p><strong>Copyright © Telkomsel Branch Madiun</strong></p>
        </div>
      </div>   
    </div>
  </div>
    <!-- jquery
		============================================ -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>