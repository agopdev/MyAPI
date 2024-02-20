<?php

define('API_VERSION', '1.0.0'); // IMPORTANT! This controls the versions of your resources. If you don't update this every deploy, browsers will cache the last version of the resources, potentially causing issues with page visualization.
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
define('REQUEST_URI', $_SERVER['REQUEST_URI']);

// Require Api logic
require_once ROOT_PATH . '/src/Api.php';

// Include the required controller files
require_once ROOT_PATH . '/src/controllers/GreetingsController.php';

// SERVER CONFIGURATION
date_default_timezone_set('America/Mexico_City');
header("Content-Type: application/json");

// Controllers associations
$routesController = array(
    'greetings' => 'GreetingsController'
);

Api::handleCalls($routesController);