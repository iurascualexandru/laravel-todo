<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

<!-- bootstrap cs CDN-->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<!-- bootstrap js CDN-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

	<title>Todo List App</title>
</head>
<font color=#736505> 
<body style="margin: 15px 0; background-color:#e1d57d">
<div class="container">
<div class="col-md-12">
<div class="row">
<h1 class="col-md-12" style="text-align: center;">Todo List</h1>
</div>

{{-- display success message --}}
@if (Session::has('success'))
	<div class="alert alert-success">
	<strong>Success:</strong> {{Session::get('success')}}
	</div>
@endif

<!-- display error message -->
@if (count($errors) > 0)
	<div class="alert alert-danger">
	<strong>Error:</strong>
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>
@endif

<div class="row" style='margin-top: 10px; margin-bottom: 10px;'>
	<form action="{{ route('tasks.store') }}" method='POST' class="container" style="padding: 0;">
	{{ csrf_field() }}

		<div class="col-md-9" style="float: left;">
			<input type="text" name='newTaskName' class='form-control'>
		</div>

		<div class="col-md-3" style="float: left;">
			<input type="submit" class='btn btn-primary btn-block' value='Add Task'>	
		</div>

		</form>
		</div>
		<br>

		{{-- display stored tasks --}}
		@if (count($storedTasks) > 0)
			<table class="table">
				<thead>
					<th>Done</th>
					<th>Task #</th>
					<th>Name</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>


				<tbody>
					@foreach ($storedTasks as $storedTask)
					<tr>
					<th>
						@if ($storedTask->done) <i class="fas fa-check" style="color:green;"></i>
						@else <i class="fas fa-times" style="color:red;"></i>
						@endif
					</th>

					<th>{{ $storedTask->id }}</th>
					@if (!$storedTask->done)	<td>{{ $storedTask->name }}</td>
					@else <td style="text-decoration: line-through;">{{ $storedTask->name }}</td>
					@endif
					<td><a href="{{ route('tasks.edit', ['tasks'=>$storedTask->id]) }}" class='btn btn-warning'>Edit</a></td>

					{{-- Butonul Delete --}}
					<td>
						<form action="{{ route('tasks.destroy', ['tasks'=>$storedTask->id]) }}" method='POST'>
							{{ csrf_field() }}
							<input type="hidden" name='_method' value='DELETE'>
							<input type="submit" class="btn btn-danger" value='Delete'>
						</form>
					</td>

					</tr>
					@endforeach
				</tbody>
			</table>
		@endif

		<div class="row text-center">
			{{ $storedTasks->links() }}
		</div>

	</div>
</div>
</body>
</html>