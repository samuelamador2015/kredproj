@extends('layouts.main')

@section('title', 'Create Activity')  

@section('content')

<div class="container" id="activity-container">
  <h1>Create Activity</h1> <br>
  @if ($errors->any())
    <div class="alert alert-danger">
      {!! implode('', $errors->all(':message <br>')) !!}
    </div>
  @endif
 

  <form action="{{ route('create_activity') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }} 

    <div class="rdn"> 
      <label>Category *</label>&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="category" value="Portfolio" checked="">&nbsp;Portfolio&nbsp;
      <input type="radio" name="category" value="Exercise">&nbsp;Exercise&nbsp;
      <input type="radio" name="category" value="Assignment">&nbsp;Assignment <br>
    </div>
    <div class="row">
      <div class="col-md-5">
          <label>Activity Title *</label>
          <input type="text" class="form-control" name="activity_name" value="{{{ old('activity_name') }}} required"><br>
          <label>Course *</label>
          <select class="form-control" name="course">
            <option value="">-- Select --</option>
            @foreach($courses as $c)
            <option value="{{ $c->id }}">{{{ $c->title }}}</option>
            @endforeach
          </select><br>
          <label>Student's Name *</label>
          <div class="form-group"> 
            <div class="input-group col-xs-12"> 
              <input type="text"  id="studname" disabled class="form-control" name="student" value="{{{ old('studname') }}}"> 
              <input type="hidden" name="studid" id="studid" value="{{{ old('studid') }}}">
              <span class="input-group-btn">
                <button class="browse btn btn-warning" type="button" data-toggle="modal" id="browseStudents" data-target="#studentModal">Browse</button>
              </span>
            </div>
          </div> 
      </div>
      <div class="col-md-7"> 
          <label>Teacher's Name *</label>
          <input type="text" class="form-control" name="teacher"  value="{{{ old('teacher') }}}" required><br>
        <label>Upload File (Optional) [maximum: 50MB] [jpeg, bmp, png, zip, rar, html, pdf]</label>
        <input type="file" name="file" class="form-control"><br>
        <label>Primary Image (Optional) [jpeg,jpg,png] </label>
        <input type="file" name="photo" class="form-control">
      </div>
    </div>
    <br>
    <label>Activity Details * (max:3000)</label>
    <textarea placeholder="Tell Something about this activity" class="form-control" rows="9" name="details">{{{ old('details')}}}</textarea><br>
    <label for="tags">Tags (Separated by comma) </label><br>
    <input type="text" name="tags" placeholder="Example. Web design, Web development"  class="form-control"><br><br>
    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
  </form>
  <hr>
  <a href="{{ route('activity') }}">View All</a>
</div>
 

 <!--  MODAL ini -->
<div id="studentModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Search Students</h4> 
      </div>
      <div class="modal-body">   
        <div class="input-group"> 
            <input class="form-control" id="student-search" name="q" placeholder="Type the Name of Student" required>
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default btn-go">GO</button>
            </span>
        </div> 
        <br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th><th>Student Name</th><th>Email</th><th>Select</th>
            </tr>
          </thead>
          <tbody>
            @foreach($students as $stud)
            <tr>
              <td>{{ $stud->id }}</td>
              <td>{{ $stud->name }}</td>
              <td>{{ $stud->email }}</td>
              <td><button data-id="{{ $stud->id }}" data-studname="{{ $stud->name }}" class="btn btn-xs btn-primary selectStudent">Select</button></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection 
