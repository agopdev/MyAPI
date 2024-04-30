<?php

// Constants
define('API_VERSION', '1.0.0');
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
define('REQUEST_URI', $_SERVER['REQUEST_URI']);

// Require MyApi logic
require_once ROOT_PATH . '/src/MyApi.php';

// Include the required controller files
require_once ROOT_PATH . '/src/controllers/GreetingsController.php';

// Server configuration
date_default_timezone_set('America/Mexico_City');
header("Content-Type: application/json");


// Controllers associations
$routesController = array(
    'greetings' => 'GreetingsController'
);

// Handle the call of the current endpoint
MyApi::handleCalls($routesController);