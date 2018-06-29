@extends('layouts.main')

@section('title', 'Create Activity')  

@section('content')

<div class="container">
  <h1>Create Activity</h1><hr>
  @if ($errors->any())
    <div class="alert alert-danger">
      {!! implode('', $errors->all(':message <br>')) !!}
    </div>
  @endif
  <form action="{{ route('create_activity') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }} 
    <div class="row">
      <div class="col-md-5">
          <label>Activity Name *</label>
          <input type="text" class="form-control" name="activity_name"><br>
          <div class="well">
            <label>Category *</label>&nbsp;&nbsp;&nbsp;
            <input type="radio" name="category" value="Portfolio">&nbsp;Portfolio&nbsp;
            <input type="radio" name="category" value="Exercise">&nbsp;Exercise&nbsp;
            <input type="radio" name="category" value="Assignment">&nbsp;Assignment <br>
          </div>
          <label>Course *</label>
          <select class="form-control" name="course">
            <option value="">-- Select --</option>
            @foreach($courses as $c)
            <option value="{{ $c->id }}">{{{ $c->title }}}</option>
            @endforeach
          </select><br>
          <label>Student's Name *</label>
          <input type="text" class="form-control" name="student"><br>
          <label>Teachers's Name *</label>
          <input type="text" class="form-control" name="teacher"><br>
      </div>
      <div class="col-md-7">
        <label>Activity Details *</label>
        <textarea placeholder="Tell Something about this activity" class="form-control" rows="9" name="details"></textarea><br>
        <label>Link (Optional)</label>
        <input type="text" placeholder="Type here the Link of this activity" name="link" class="form-control"><br>
        <label>Upload File (Optional)</label>
        <input type="file" name="file" class="form-control">
      </div>
    </div>
    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
  </form>
  <hr>
  <a href="{{ route('activity') }}">View All</a>
</div>

@endsection