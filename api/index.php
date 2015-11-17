<?php
require 'vendor/autoload.php';
require 'database/ConnectionFactory.php';
require 'guests/GuestService.php';

$app = new \Slim\Slim();


$app->get('/guests', function() use ($app) 
{
    $guests = GuestService::listGuests();
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($guests);
});



$app->post('/guests', function() use ($app)
{
    $guestJson = $app->request()->getBody();
    $newGuest = json_decode($guestJson, true);
    if($newGuest) 
    {
        $guest = GuestService::add($newGuest);
        $result = array('name'=>'This is a test','email'=>'test@gmail.com','id'=>'1');
        
        $app->response()->header('Content-Type','application/json');
        echo json_encode($result);
    }
    else 
    {
        $app->response->setStatus(400);
        echo "Not possible save :(";
    }
});



$app->delete('/guests/:id', function($id) use ($app)
{
    $app->response()->header('Content-Type','application/json');
    $result;
    
    if(GuestService::delete($id)) 
    {
      $result = array('status'=>'true','message'=>'Guest deleted!');
    }
    else
    {
      $app->response->setStatus('404');
      $result = array('status'=>'false','message'=>'Guest with ' .$id .' does not exit');
    }
    
    echo json_encode($result);
});


$app->run();
?>