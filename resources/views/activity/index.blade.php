@extends('layouts.main')

@section('title', 'Activities')  

@section('content')
 
{{csrf_field()}}
<div class="container-fluid">

  @if( session('success') )
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif
  <div class="pull-right">
    <form class="form-inline" action="{{ route('activity') }}" method="GET"> 
      <input type="text" name="s" value="{{{ Input::get('s') }}}" class="form-control mb-3 mr-sm-2 mb-sm-0" placeholder="Activity title or name of student..." id="search_input">  
      <button type="submit" class="btn btn-default">
          <i class="fa fa-search"></i>&nbsp;Search</button>
    </form>
  </div>
  <h3>Activity</h3> 
<br>  <hr>
  <label>Filter</label> 
  <a href="{{ route('create_activity') }}" class="btn btn-success pull-right">
    <i class="fa fa-plus"></i> Add New</a>
  <form action="{{ route('activity') }}" method="GET">
  <div class="row">
    <div class="col-md-3"> 
      <select class="form-control" name="category">
        <option value="">-- Category --</option>
        <option value="Portfolio" {{ (Input::get('category')=='Portfolio') ? 'selected' : '' }}>Portfolio</option> 
        <option value="Exercise" {{ (Input::get('category')=='Exercise') ? 'selected' : '' }}>Exercise</option> 
        <option value="Assignment" {{ (Input::get('category')=='Assignment') ? 'selected' : '' }}>Assignment</option> 
      </select>
    </div>
    <div class="col-md-3"> 
      <select class="form-control" name="course">
        <option value="">-- Course --</option>
        @foreach(\App\Course::all() as $c)
        <option value="{{ $c->title }}" {{ ($c->title==Input::get('course')) ? 'selected' : '' }}>{{ $c->title }}</option> 
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <select class="form-control" name="front">
        <option value="">-- All --</option>
        <option value="Yes" {{ (Input::get('front')=='Yes') ? 'selected' : '' }}>Yes</option>
        <option value="No" {{ (Input::get('front')=='No') ? 'selected' : '' }}>No</option>
      </select>
    </div>
    <input type="submit" class="btn btn-default" value="Filter" name="filter"> 
  </div>
  </form>
  <br>
 
  <table class="table table-striped">
    <thead>
      <tr> 
        <th>ID</th>
        <th>Activity Title</th>
        <th class="text-center">Category</th>
        <th>Course</th>
        <th>Student Name</th>  
        <th width="50px">Front</th>
        <th width="30px">View</th>
        <th width="50px">EDIT</th>
        <th width="50px">Delete</th>
      </tr> 
    </thead>
    <tbody>
    @if( $acts->count() > 0 )
      @foreach($acts as $act)
      <tr>
        <td>{{ $act->act_id }}</td>
        <td>{{{ $act->act_name }}}</td>
        <td style="color:red;" class="text-center">{{{ $act->activity_category }}}</td>
        <td>{{{ $act->course_title }}}</td>
        <td>{{{ $act->stud_name }}}</td> 
        <td>
          <form action="{{ route('activity_front') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $act->act_id }}">
            <input type="hidden" name="front" value="{{ $act->front }}">
            <div class="btn-group" role="group">
                @if( $act->front == 'No')
                <button type="button" class="btn btn-default btn-sm" disabled>No</button>
                <button type="submit" title="Click to Display in Front Page" name="publish" class="btn btn-success btn-sm"><i class="fa fa-circle"></i></button>
                @else
                <button type="button" class="btn btn-default btn-sm" disabled>Yes</button>
                <button type="submit" title="Hide this in front page" name="publish" class="btn btn-danger btn-sm"><i class="fa fa-circle-o"></i></button> 
                @endif
            </div> 
          </form>
        </td>
        <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" id="activities" data-id="{{ $act->act_id }}" data-target="#activityModal"><i class="fa fa-search"></i></button>
        </td> 
        <td><a href="{{action('ActivityController@edit', $act->act_id)}}" class="btn btn-warning btn-sm">
          <i class="fa fa-pencil"></i>
        </a></td>
        <td>
              <form action="{{ route('activity_destroy') }}"  method="POST"> 
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{ $act->act_id }}"> 
                <button class="btn btn-danger btn-sm btndelete" type="submit"><i class="fa fa-trash"></i></button>
              </form>
            </td>
      </tr>
      @endforeach
    @else
      <tr><td colspan="8" align="center"><p>Sorry, no record found</p></td></tr>
    @endif
    </tbody>
  </table>  
  {{ $acts->appends(request()->query())->links() }}
</div>


<div id="activityModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Student's Activity</h4>
      </div>
      <div class="modal-body">
        Loading...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection

