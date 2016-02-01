<?php 

class FoodsControllerTest extends TestCase {
    
    public function setUp()
    {
        parent::setUp();
        $this->mock =  Mockery::mock('Food');


    }

    public function testShow(){

    	  $this->mock->shouldReceive('finds')
                   ->andReturn('foo');
        $this->app->instance('Food', $this->mock);
        
     
        
        
        $response = $this->call('GET', '/foods/5');
        $this->assertViewHas('food','foo');
      
       
        
    }
    
    public function testStore(){
        
        
        $this->mock->shouldReceive('create');
        $this->app->instance('Food', $this->mock);
        Validator::shouldReceive('make')
                  ->once()
                  ->andReturn(Mockery::mock(['fails' => false]));
        $this->call('POST', 'foods', array('title'=>'dasdasd'));
        $this->assertRedirectedToRoute('foods.index');
        
    }

    public function testIndex(){

        $this->mock->shouldReceive('all')
                   ->andReturn('foo');
        $this->app->instance('Food', $this->mock);
        $response = $this->call('GET', 'foods');
        $this->assertViewHas('foods','foo');
    }

    public function testEsarz(){
      
        $this->mock->shouldReceive('create')
                   ->once();
        $this->app->instance('Food', $this->mock);

        Validator::shouldReceive('make')
                  ->once()
                  ->andReturn(Mockery::mock(['fails' => false]));

        Mail::shouldReceive('send')
              ->once()
              ->with('emails.post',['title'=>'dasdasd'],$this->getSendCallbackMock());
        
        $this->call('POST', 'esarz', array('title'=>'dasdasd'));
        $this->assertRedirectedToRoute('foods.index');
       

    }
    public function getSendCallbackMock(){

       return Mockery::on(function($callback) {
                    $emailMock = Mockery::mock("stdClass");
                    $emailMock->shouldReceive("to")
                              ->once()
                              ->with("cgpitt@gmail.com", "Chris");
                    $callback($emailMock);
                    return true;
              
              });
    }

     public function tearDown()
      {
          Mockery::close();
      }
}