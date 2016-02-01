<?php 

class HomeControllerTest extends TestCase {
    
    
    public function setUp()
    {
        parent::setUp();
        $this->mock =  Mockery::mock('App\Classes\Sharad');
        $this->app->instance('App\Classes\SharadInterface', $this->mock);
    }
   
    public function testindex()
    {
        $this->mock->shouldReceive('perform')->with(2)->andReturn('20','40');
        $this->mock->shouldReceive('perform')->with(3)->andReturn('30');
        
        $response = $this->call('GET', '/');
        $data = $response->original->getData()['data'];
        $this->assertViewHas('data', 20);

        $response = $this->call('GET', '/');
        $data = $response->original->getData()['data'];
        $this->assertViewHas('data', 40);
        

        
    }

      public function tearDown()
      {
          Mockery::close();
      }


}
