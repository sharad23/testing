<?php 

    namespace App\Classes;
    use Illuminate\Support\ServiceProvider as SharadProv;
    use App;
	class SharadServiceProvider extends SharadProv {
	 
	  public function register(){
         
       
        /*App::bind('Sharad',function($app){

        	   return new App\Classes\Sharad(); 
        });
        */
        
        $this->app->bind('App\Classes\SharadInterface','App\Classes\Sharad');
        
       
    }
	 
	}
?>