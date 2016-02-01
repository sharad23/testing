<?php

use App\Classes\Shiraj;
class FoodsController extends \BaseController {
    
     public function __construct(Food $food,Shiraj $shiraj){
          
        $this->food = $food;
        $this->shiraj = $shiraj;
     }
	public function index(){

		 $foods = $this->food->all();
         return View::make('hello')->with('foods',$foods);
	}

	public function show($id){
		 
		 $food = $this->food->finds($id);
		 return View::make('hello',compact('food','shiraj'));
	}
	public function store()
	{
		$input = Input::all();
        $v = Validator::make($input, ['title' => 'required']);
	    if($v->fails())
	    {  
	    	return Redirect::route('foods.create');
	    }
	    $this->food->create($input);
        return Redirect::route('foods.index')->with('flash', 'Your post has been created!');
	  

	   
   }

   public function esarz(){

   	    $validator = Validator::make(Input::all(),["title"=> "required"]);
        if($validator->fails()) {
		   
		   return Redirect::route('foods.create');
		  
	    }
	  
        Mail::send("emails.post", Input::all(), function($email) {
		         $email->to("cgpitt@gmail.com", "Chris");
		          
		}); 
		$this->food->create(["title" => Input::get("title")]);
		return Redirect::route("foods.index");
		  


	 }
}
