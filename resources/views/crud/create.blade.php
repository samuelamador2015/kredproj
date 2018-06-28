
@extends('layouts.main')

@section('title', 'Create') 
@section('content')
<div class="container">

  @if ($errors->has('title'))  {{ $errors->first('title') }} <br>   @endif
  @if ($errors->has('body'))  {{ $errors->first('body') }} <br>   @endif

  <form action="{{ url('crud') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group row">
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="title" name="title">
      </div>
    </div>
    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Body</label>
      <div class="col-sm-10">
        <textarea name="body" rows="8" cols="80"></textarea>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary">
    </div>
  </form>
</div>
@endsection