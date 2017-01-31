<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//need for the Validator class to work
use Validator, Input, Redirect;

//needed to use database
use DB;

use Auth; //needed to use functions in auth library

use Illuminate\Http\Request;

class Main extends Controller 
{
	public function __construct()
	{
		/*this middleware call will check if user is login or not on every url request*/
		$this->middleware('auth');
	}
	
	//function to load view
	function view_dashboard(Request $request)
	{
		return view("content/dashboard");
	}
	
	function add_user(Request $request)
	{
		return view("content/add_user");
	}
	
	function insert_user(Request $request)
	{
		//validate user input fields
		$rules = array(
                'fname' => 'Required|Min:3|Max:80|Alpha',
				'lname' => 'Required|Min:3|Max:80|Alpha',
				'role' => 'Required|Max:5|Alpha',
                'email'     => 'Required|Between:3,64|Email|Unique:users',
                'pword'  =>'Required|AlphaNum|Between:4,8|Confirmed',
                'pword_confirmation'=>'Required|AlphaNum|Between:4,8'
        );
		
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) 
		{
			// redirect our user back to the form with the errors from the validator
			return Redirect::to('add/user')->withErrors($validator->messages());

		} else 
		{
			// validation successful ---------------------------
			//$password = Hash::make('yourpassword');
			$pword = $request->input('pword');
			$hashedpword = bcrypt($pword);
			
			$query = DB::table('users')->insert([
			'fname' => $request->input('fname'), 
			'lname' => $request->input('lname'), 
			'email' => $request->input('email'), 
			'role' => $request->input('role'), 
			'password' => $hashedpword
			]);
			
			if($query)
			{
				return Redirect::to('add/user')->with('response',['success']);
			}
		}
	}// end insert user
	
	function update_user(Request $request,$id)
	{
		//validate user input fields
		$rules = array(
                'fname' => 'Required|Min:3|Max:80|Alpha',
				'lname' => 'Required|Min:3|Max:80|Alpha',
				'role' => 'Required|Max:5|Alpha',
                'email'     => 'Required|Between:3,64'
               /** 'pword'  =>'Required|AlphaNum|Between:4,8|Confirmed',
                'pword_confirmation'=>'Required|AlphaNum|Between:4,8'**/
        );
		
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) 
		{
			// redirect our user back to the form with the errors from the validator
			return Redirect::to('edit/user/'.$id)->withErrors($validator->messages());

		} else 
		{
			// validation successful ---------------------------
			//$password = Hash::make('yourpassword');
			$pword = $request->input('pword');
			$hashedpword = bcrypt($pword);
			
			$query = DB::table('users')->update([
			'fname' => $request->input('fname'), 
			'lname' => $request->input('lname'), 
			'email' => $request->input('email'), 
			'role' => $request->input('role')
			//'password' => $hashedpword
			]);
			
			if($query)
			{
				return Redirect::to('edit/user/'.$id)->with('response',['success']);
			}
		}
	}// end insert user
	
	function view_users(Request $request)
	{
		$users = DB::select('select * from users');
		return view('content/view_users',['users'=>$users]);
	}
	
	function edit_user(Request $request,$id)
	{
		//$user = DB::select('select * from users where id = ?',[$id]);
		$user = DB::select( DB::raw("SELECT * FROM users WHERE id = '$id'") );
		return view('content/edit_user',['user'=>$user]);
		
	}
	
	public function logout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::to('/'); // redirect the user to the login screen
	}

}//end class
