<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; //needed to use "Request"

//need for the Validator class to work
use Validator, Input, Redirect; //needed to use "Validator"

use Auth; //needed to use functions in auth library

class HomeController extends Controller 
{

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth'); //this doesn't seems needed here
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('content/login');
	}
	
	public function authenticate(Request $request)
	{
		//validate user input fields
		$rules = array(
                'email'     => 'Required|Between:3,64|Email',
                'password'  =>'Required|AlphaNum|Between:4,8'
        );
		
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) 
		{
			// redirect our user back to the form with the errors from the validator
			return Redirect::to('/')->withErrors($validator->messages());

		} else 
		{
			// form field validation successful ---------------------------
			
			// create our user data for the authentication
			$userdata = array(
			'email'     => $request->input('email'),
			'password'  => $request->input('password')
			);

			// attempt to do the login
			if (Auth::attempt($userdata)) 
			{
				// validation successful!
				echo 'SUCCESS!';
			} 
			else 
			{        
				// validation not successful, send back to form 
				return Redirect::to('login');
			}
		}//end outermost else
	}

}
