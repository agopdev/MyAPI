<?php

$root = ROOT_PATH;

require_once "{$root}/src/models/Greeting.php";

class GreetingsController{

    // Here you can administrate your routes
    const routes = array(
        'GET@/greetings/hello-world' => 'sayHelloWorld',
        'GET@/greetings/greet-name/.*' => 'sayHelloWithName',
        'GET@/greetings/greet-age/\d+' => 'sayHelloWithAge',
        'POST@/greetings/greet-name-age'=> 'sayHelloWithNameAndAge'
    );

    public static function sayHelloWorld($req){
        try {
            Greeting::sayHelloWorld();
        } catch (Exception $e) {
            echo json_encode(['message' => $e->getMessage()]);
        }
    }

    public static function sayHelloWithName($req){
        try {
            $data = array(
                'name' => 
                    $req->params[3]
            );
            Greeting::sayHelloWithName($data);
        } catch (Exception $e) {
            echo json_encode(['message'=> $e->getMessage()]);
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

    public static function sayHelloWithNameAndAge($req){
        try {
            $data = array(
                'name' => 
                    $req->body['name'],
                'age' => 
                    $req->body['age']
            );
            Greeting::sayHelloWithNameAndAge($data);
        } catch (Exception $e) {
            echo json_encode(['message'=> $e->getMessage()]);
        }
    }
    
}