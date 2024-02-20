<?php

$root = ROOT_PATH;

require_once "{$root}/src/models/Greeting.php";

class GreetingsController{

    // Here you can administrate your routes
    const routes = array(
        'GET@/greetings/greet' => 'sayHelloWorld',
        'GET@/greetings/greet-age/\d+' => 'sayHelloWithAge',
        'POST@/greetings/greet-full-data'=> 'sayHelloFullData'
    );

    public static function sayHelloWorld($req){
        try {
            Greeting::sayHelloWorld();
        } catch (Exception $e) {
            echo json_encode(['message' => $e->getMessage()]);
        }
    }

    public static function sayHelloWithAge($req){
        try {
            $data = array(
                'age' => 
                $req->params[3]
            );
            Greeting::sayHelloWithAge($data);
        } catch (Exception $e) {
            echo json_encode(['message'=> $e->getMessage()]);
        }
    }

    public static function sayHelloWorldFullData($req){
        try {
            Greeting::sayHelloWorldFullData();
        } catch (Exception $e) {
            echo json_encode(['message'=> $e->getMessage()]);
        }
    }
    
}