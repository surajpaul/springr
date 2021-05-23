@extends('voyager::master')

@section('content')
<style type="text/css">
	.px-5{
		padding: 0px 4em;
	}
	.pt-3{
		padding-top: 20px;
	}
	.pb-4{
		padding-bottom: 30px;
	}
	label{
		padding-top: 9px;
	}
	a{
		text-decoration: none !important;
	}
</style>
    <div class="page-content container-fluid">
        <section class="container">
	        <div class="row">
	        	<div class="col-md-6 col-12" align="left">
	        		<h2 class="text-dark">User Records</h2>
	        	</div>
	        	<div class="col-md-6 col-12" align="right">
	        		<h2><a class="btn btn-info" data-toggle="modal" data-target="#addNewUser">Add New</a></h2>
	        	</div>

	        	<div class="col-md-12 col-12">
					<table class="table table-striped">
					    <thead>
					        <tr>
					          <th>S. no</th>
					          <th>Avatar</th>
					          <th>Name</th>
					          <th>Email</th>
					          <th>Experience</th>
					          <th>Edit</th>
					          <th>Remove</th>
					        </tr>
					    </thead>
					    <tbody>
					      @foreach($users as $key => $user)
					        <tr>
					        	<td>{{$key+1}}</td>
					        	<td><img src="{{ filter_var($user->avatar, FILTER_VALIDATE_URL) ? $user->avatar : Voyager::image( $user->avatar ) }}" width="60px"></td>
					            <td class="bold">{{$user->name}}</td>
					            <td>{{$user->email}}</td>
					            <td>{!!$user->exp!!}</td>
					            <td>
					            	<form method="POST" action="{{route('user.edit')}}">
					            		@csrf
					            		<input type="hidden" value="{{$user->id}}" name="id">
					            		<button type="submit" class="badge badge-success">Edit</button>
					            	</form>
					            </td>
					            <td>
					            	<form method="POST" action="{{route('user.delete')}}">
					            		@csrf
					            		<input type="hidden" value="{{$user->id}}" name="id">
					            		<button type="submit" class="badge badge-danger">Remove</button>
					            	</form>
					        </tr>
					      @endforeach
					    </tbody>
					</table>
	        	</div>
	        </div>
        </section>
    </div>


    <!-- Add User Modal -->
	<div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="addNewUserTitle"
	  aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title pt-3" id="exampleModalLongTitle" align="center">Add New Record</h4>
	      </div>
	      <div class="modal-body px-5 pt-3 pb-4">
	        <form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
	        	@csrf
	        	<div class="row">
	        		<div class="col-md-4 col-4">
	        			<label>Email: </label>
	        		</div>
	        		<div class="col-md-8 col-8">
	        			<input type="email" name="email" class="form-control" required>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-4 col-4">
	        			<label>Full Name: </label>
	        		</div>
	        		<div class="col-md-8 col-8">
	        			<input type="text" name="name" class="form-control" required>
	        		</div>
				</div>
				<div class="row">
	        		<div class="col-md-4 col-4">
	        			<label>Date of Joining: </label>
	        		</div>
	        		<div class="col-md-8 col-8">
	        			<input type="date" name="date_of_joining" class="form-control" required>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-4 col-4">
	        			<label>Date of Leaving: </label>
	        		</div>
	        		<div class="col-md-4 col-4">
	        			<input type="date" name="date_of_leaving" class="form-control dol" required>
	        		</div>
	        		<div class="col-md-4 col-4">
	        			<div class="form-check">
						    <input type="checkbox" class="form-check-input" name="working" id="working">
						    <label class="form-check-label" for="working"> Still Working</label>
						</div>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-4 col-4">
	        			<label>Upload Image: </label>
	        		</div>
	        		<div class="col-md-4 col-4">
	        			<input type="file" name="avatar" required>
	        		</div>
	        	</div>
	        	<div align="center">
	        		<button type="submit" class="btn btn-primary">Save New User</button>
	        	</div>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- delete user Modal -->


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(function() {
		  enable_cb();
		  $("#working").click(enable_cb);
		});

		function enable_cb() {
		  if (this.checked) {
		    

		    $("input.dol").attr("disabled", true);
		  } else {
		    $("input.dol").removeAttr("disabled");
		  }
		}
	</script>
@stop