@extends('layouts.main')

@section('title', 'Activities')  

@section('content')

{{ csrf_field() }}
<div class="container-fluid">
  <a href="{{ route('create_activity') }}" class="btn btn-success pull-right">Add New</a>
  <h1>Activities</h1>
  <a href="#"   id="activities">Click Ajax</a>
  <table class="table table-striped">
    <tr> 
      <td>ID</td>
      <td>Activity Title</td>
      <td>Category</td>
      <td>Course</td>
      <td>Student Name</td>
      <td>Teacher</td>
      <td>Added By</td>
      <td>Date Added</td>
      <td width="50px">EDIT</td>
      <td width="50px">Delete</td>
    </tr> 
    @foreach($acts as $act)
    <tr>
      <td>{{ $act->id }}</td>
    </tr>
    @endforeach
  </table>  
</div>

@endsection