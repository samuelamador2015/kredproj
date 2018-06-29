@extends('layouts.main')

@section('title', 'Courses')  

@section('content')

<div class="container">
  <h1>List Courses</h1>
  <table class="table table-striped">
    <tr> 
      <td>ID</td>
      <td>Title</td>
      <td>Description</td>
      <td>EDIT</td>
      <td>Delete</td>
    </tr>
    @foreach( $courses as $p)
    <tr>
      <td>{{{ $p->title }}}</td>
      <td>{!! $p->description !!}</td>
          <td><a href="{{action('CourseController@edit', $p->id)}}" class="btn btn-warning">Edit</a></td>
      <td>
            <form action="{{action('CourseController@destroy', $p->id)}}" method="post">
              {{csrf_field()}}
              <input name="_method" type="hidden" value="DELETE">
              <button class="btn btn-danger" type="submit">Delete</button>
            </form>
          </td>
    </tr>
    @endforeach
  </table>

  {{ $courses->links() }}
  <hr>
  <a class="btn btn-success btn-sm" href="{{ url('/courses/create') }}">+ Create</a>
</div>

@endsection