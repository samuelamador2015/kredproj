<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Login | {{ config('app.name') }}</title> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
</head>
<body>
<div class="container">
    <h1 class="text-center projname">Project Compilation System</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            @if( session('error') )
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                          {!! implode('', $errors->all(':message <br>')) !!}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }} 
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required> 
                            </div>
                        </div>
 

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  
    </body>
</html>
