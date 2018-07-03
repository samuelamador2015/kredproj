<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Login | {{ config('app.name') }}</title> 
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">
        <i class="fa fa-fw fa-user"></i>&nbsp;Authentication
      </div>
      <div class="card-body">
      @if( session('error') )
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      @if ($errors->any())
        <div class="alert alert-danger">
          {!! implode('', $errors->all(':message <br>')) !!}
        </div>
      @endif
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }} 
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" value="{{ old('email') }}" required autofocus name="email" placeholder="Email Address">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" name="password">
          </div><br>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div> <br>
          <button type="submit" class="btn btn-primary btn-block">
            Login
          </button> 
        </form> 
      </div>
    </div>
  </div>  
    </body>
</html>
