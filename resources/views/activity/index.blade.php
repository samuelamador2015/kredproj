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

  <a href="{{ route('create_activity') }}" class="btn btn-success pull-right">Add New</a>
  <h1>Activities</h1> 
  <table class="table table-striped">
    <thead>
      <tr> 
        <th>ID</th>
        <th>Activity Title</th>
        <th class="text-center">Category</th>
        <th>Course</th>
        <th>Student Name</th>  
        <th>View</th>
        <th width="50px">EDIT</th>
        <th width="50px">Delete</th>
      </tr> 
    </thead>
    @foreach($acts as $act)
    <tr>
      <td>{{ $act->act_id }}</td>
      <td>{{{ $act->act_name }}}</td>
      <td style="color:red;" class="text-center">{{{ $act->activity_category }}}</td>
      <td>{{{ $act->course_title }}}</td>
      <td>{{{ $act->stud_name }}}</td> 
      <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" id="activities" data-id="{{ $act->act_id }}" data-target="#activityModal">View</button></td> 
      <td><a href="{{action('ActivityController@edit', $act->act_id)}}" class="btn btn-warning">Edit</a></td>
      <td>
            <form action="{{action('CourseController@destroy', $act->act_id)}}" method="post">
              
              {{csrf_field()}}
              <input name="_method" type="hidden" value="DELETE">
              <button class="btn btn-danger" type="submit">Delete</button>
            </form>
          </td>
    </tr>
    @endforeach
  </table>  
  {{ $acts->links() }}
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

