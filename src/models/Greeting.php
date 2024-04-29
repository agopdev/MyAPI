<?php

$root = ROOT_PATH;

require_once("{$root}/src/models/DatabaseConnection.php");

class Greeting{
    public static function sayHelloWorld(){
        echo json_encode(['message' => 'Hello world!']);
    }

    public static function sayHelloWithName($data){
        $message = "Hi! You're name is " . $data['name'] . ".";
        echo json_encode(['message'=> $message]);
    }

    public static function sayHelloWithAge($data){
        $message = "Hi! You're " . $data['age'] . " years old.";
        echo json_encode(['message'=> $message]);
    }

    public static function sayHelloWithNameAndAge($data){
        $message = "Hi! You're name is " . $data['name'] . " and you're " . $data['age'] . ".";
        echo json_encode(['message'=> $message]);
    }
    
}