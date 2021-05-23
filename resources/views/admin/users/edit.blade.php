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
	        		<h2 class="text-dark">Edit User {{$user->name}} Records</h2>
	        	</div>


	        	<div class="col-md-12 col-12">
					<form method="POST" action="{{route('user.update')}}" enctype="multipart/form-data">
			        	@csrf
			        	<div class="row">
			        		<div class="col-md-4 col-4">
			        			<label>Email: </label>
			        		</div>
			        		<div class="col-md-8 col-8">
			        			<input type="hidden" name="id" value="{{$user->id}}">
			        			<input type="email" name="email" value="{{$user->email}}" class="form-control" required>
			        		</div>
			        	</div>
			        	<div class="row">
			        		<div class="col-md-4 col-4">
			        			<label>Full Name: </label>
			        		</div>
			        		<div class="col-md-8 col-8">
			        			<input type="text" name="name" class="form-control" required  value="{{$user->name}}">
			        		</div>
						</div>
						<div class="row">
			        		<div class="col-md-4 col-4">
			        			<label>Date of Joining: </label>
			        		</div>
			        		<div class="col-md-8 col-8">
			        			<input type="date" name="date_of_joining" class="form-control" required  value="{{$user->date_of_joining}}">
			        		</div>
			        	</div>
			        	<div class="row">
			        		<div class="col-md-4 col-4">
			        			<label>Date of Leaving: </label>
			        		</div>
			        		<div class="col-md-4 col-4">
			        			<input type="date" name="date_of_leaving" class="form-control dol" required  value="{{$user->date_of_leaving}}"  <?php if($user->date_of_leaving == null){echo "disabled";}else{} ?>>
			        		</div>
			        		<div class="col-md-4 col-4">
			        			<div class="form-check">
								    <input type="checkbox" class="form-check-input" name="working" id="working" <?php if($user->date_of_leaving == null){echo "checked";}else{} ?>>
								    <label class="form-check-label" for="working"> Still Working</label>
								</div>
			        		</div>
			        	</div>
			        	<div class="row">
			        		<div class="col-md-4 col-4">
			        			<label>Upload Image: </label>
			        		</div>
			        		<div class="col-md-4 col-4">
			        			<input type="file" name="avatar">
			        			<input type="hidden" name="hidden_avatar" value="{{$user->avatar}}">
			        		</div>
			        	</div>
			        	<div align="center">
			        		<button type="submit" class="btn btn-primary">Save New User</button>
			        	</div>
			        </form>
	        	</div>
	        </div>
        </section>
    </div>

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