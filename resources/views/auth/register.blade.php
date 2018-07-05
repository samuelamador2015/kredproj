@extends('layouts.main')

@section('title', 'Add New User')
@section('content')
<div class="container"> 
    <div class="panel-heading">Add New User</div><hr>
 
      @if( session('error') )
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      @if ($errors->any())
        <div class="alert alert-danger">
          {!! implode('', $errors->all(':message <br>')) !!}
        </div>
      @endif

    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }} 
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus> 
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required> 
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required> 
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">Role</label> 
            <div class="col-md-6">
               <select class="form-control" name="role">
                   <option value="">-- Select Role --</option>
                   <option value="student">Student</option>
                   <option value="teacher">Teacher</option>
                   <option value="admin">Admin</option>
               </select>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
            </div>
        </div>
    </form>  
</div>
@endsection
