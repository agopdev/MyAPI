<?php

$root = ROOT_PATH;

require_once "{$root}/src/models/Greeting.php";

class GreetingsController{

    // Here you can administrate your routes
    const routes = array(
        '/greetings/greet' => 'GET@sayHelloWorld',
        '/greetings/greet-age/\d+' => 'GET@sayHelloWithAge',
        '/greetings/greet-full-data'=> 'POST@sayHelloFullData'
    );

    public static function sayHelloWorld(){
        try {
            Greeting::sayHelloWorld();
        } catch (Exception $e) {
            echo json_encode(['message' => $e->getMessage()]);
        }
    }

    public static function sayHelloWithAge(){
        try {
            $data = array(
                'age' => 
                $uri[3]
            );
            Greeting::sayHelloWithAge($data);
        } catch (Exception $e) {
            echo json_encode(['message'=> $e->getMessage()]);
        }
    }

    public static function sayHelloWorldFullData(){
        try {
            Greeting::sayHelloWorldFullData();
        } catch (Exception $e) {
            echo json_encode(['message'=> $e->getMessage()]);
        }
    }
    
}