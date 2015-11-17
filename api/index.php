<?php
require 'vendor/autoload.php';
require 'database/ConnectionFactory.php';
require 'guests/GuestService.php';

$app = new \Slim\Slim();

$app->get('/guests', function() use ( $app ) 
{
    $guests = GuestService::listGuests();
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($guests);
});

$app->run();
?>