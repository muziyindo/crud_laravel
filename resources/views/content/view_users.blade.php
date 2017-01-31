@extends('template.template')

@section('content')
<div class="typo-grid"> 	  
 <div class="typo-1">
<div class="grid_3 grid_5">
     <h3 class="head-top">USERS</h3>
       <div class="but_list">
	    <div class="col-md-12 page_1">
			<p>Add modifier classes to change the appearance of a badge.</p>
              <table class="table table-bordered">
				<thead>
					<tr>
						<th >FIRST NAME</th>
						<th >LAST NAME</th>
						<th >EMAIL</th>
						<th >ROLE</th>
						<th >DATE CREATED</th>
						<th ></th>
						<th ></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
					<tr>
						<td>{{ $user->fname }}</td>
						<td>{{ $user->lname }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->role }}</td>
						<td>{{ $user->created_at }}</td>
						
						<td><a href="{{ url('/edit/user/'.$user->id) }}">EDIT</a></td>
						<td><a href="{{ url('/delete/user/'.$user->id) }}">DELETE</a></td>
					</tr>
					@endforeach
					
				</tbody>
			  </table>                    
		</div>
		
	   <div class="clearfix"> </div>
	   </div>
     </div>
	 </div>
     </div>
	 
	 @endsection