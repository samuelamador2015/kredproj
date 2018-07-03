
@extends('layouts.main')

@section('title', 'Dashboard') 
@section('content')  
<div class="row">
	<div class="col-xl-3 col-sm-6 mb-3">
	  <div class="card text-white bg-primary o-hidden h-100">
	    <div class="card-body">
	      <div class="card-body-icon">
	        <i class="fa fa-fw fa-users"></i>
	      </div>
	      <div class="mr-5">26 Users</div>
	    </div>
	    <a class="card-footer text-white clearfix small z-1" href="#">
	      <span class="float-left">View Details</span>
	      <span class="float-right">
	        <i class="fa fa-angle-right"></i>
	      </span>
	    </a>
	  </div>
	</div><!-- first -->
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-warning o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-fw fa-list"></i>
          </div>
          <div class="mr-5">11 Activities</div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="#">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div><!-- Second -->
     <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-success o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fa fa-fw fa-pencil"></i>
          </div>
          <div class="mr-5">123 Courses!</div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="#">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fa fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div><!-- Third --> 
</div>

@endsection