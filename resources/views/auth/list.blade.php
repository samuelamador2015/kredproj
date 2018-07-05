@extends('layouts.main')

@section('title', 'Users')
@section('content')
	<a href="{{ route('register') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Add new</a><br><br>
<div class="container">
	<div class="row">
		<table class="table  table-striped table-hover">
			<thead>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Role</th>
			</thead> 
			<tbody>
				@foreach($data as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->role }}</td> 
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $data->links() }}
	</div>
</div>
@endsection