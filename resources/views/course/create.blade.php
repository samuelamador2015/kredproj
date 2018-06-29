@extends('layouts.main')

@section('title', 'Create Course')  

@section('content')

<div class="container">
  <h1>Create Course</h1><hr>
  @if ($errors->any())
    <div class="alert alert-danger">
      {!! implode('', $errors->all(':message <br>')) !!}
    </div>
  @endif
  <form action="{{ url('courses') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group row">
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="title" name="title">
      </div>
    </div>
    <div class="form-group row">
      <label for="smFormGroupInput" class="col-sm-2 col-form-label col-form-label-sm">Description</label>
      <div class="col-sm-10">
        <textarea name="description" rows="8" class="form-control"></textarea>
      </div>
    </div> 
    <div class="form-group row">
      <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Category</label>
      <div class="col-sm-10">
        <select class="form-control" name="category">
            <option value="">-- Select --</option>
            <option value="Web Design">Web Design</option>
            <option value="Web Development"> Web Development</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-2"></div>
      <div class="col-md-10">
        <input type="submit" class="btn btn-primary">
      </div>
    </div>
  </form>
  <hr>
  <a href="{{ url('/courses') }}">View All</a>
</div>

@endsection