@extends('template.template')

@section('content')
<div class="validation-system">
 		
 		<div class="validation-form">
 	<!---->
  	    <div class="alert alert-primary" role="alert" style="border:5px; border-style:outset;">
        <strong>Well done!</strong> You successfully read this important alert message.
       </div>
	   
		<!--@if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif-->
		
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		
		@if (session()->has('response'))
			<div class="alert alert-success">
				<strong>success!</strong> User has been added successfully!.<br><br>
				
			</div>
		@endif
	   
	   
	   
        <form method="POST" action="{{ url('/insert/user') }}">
			<!--Must be in all form to be submitted to laravel controller-->
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			
         	<div class="vali-form">
            <div class="col-md-6 form-group1">
              <label class="control-label">Firstname</label>
              <input type="text" placeholder="Firstname" name="fname">
            </div>
            <div class="col-md-6 form-group1 form-last">
              <label class="control-label">Lastname</label>
              <input type="text" placeholder="Lastname" name="lname">
            </div>
            <div class="clearfix"> </div>
            </div>
			
            <div class="col-md-12 form-group1 group-mail">
              <label class="control-label">Email</label>
              <input type="text" placeholder="Email" name="email">
            </div>
            
            <div class="clearfix"> </div>
			
             <div class="vali-form vali-form1">
			 <div class="col-md-6 form-group1">
              <label class="control-label">Create a password</label>
              <input type="password" placeholder="Create a password" name="pword">
            </div>
            <div class="col-md-6 form-group1 form-last">
              <label class="control-label">Repeated password</label>
              <input type="password" placeholder="Repeated password" name="pword_confirmation">
            </div>
			<div class="clearfix"> </div>
			</div>
            
             <div class="clearfix"> </div>
              <div class="col-md-12 form-group2 group-mail">
              <label class="control-label">Role</label>
            <select name="role">
				<option value="">--Select--</option>
            	<option value="Admin">Admin</option>
            	<option value="User">User</option>
            </select>
            </div>
             <div class="clearfix"> </div>
          
            <div class="col-md-12 form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-default">Reset</button>
            </div>
          <div class="clearfix"> </div>
        </form>
    
 	<!---->
 </div>

</div>
@endsection