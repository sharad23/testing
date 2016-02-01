<?php
use App\Classes\SharadInterface as Sharad;
class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
    public function __construct(Sharad $sharad){
          
        $this->sharad = $sharad;
    }
	public function index()
	{
	    $data = $this->sharad->perform(2);
        return View::make('hello')->with('data',$data);

    }
   

}