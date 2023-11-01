<?php

$root = ROOT_PATH;

require_once("{$root}/src/models/DatabaseConnection.php");

class Greeting{
    public static function sayHelloWorld(){
        echo json_encode(['message' => 'Hello world!']);
    }

    public static function sayHelloWithAge($data){
        $message = "Hi! You're " . $data['age'] . " years old.";
        echo json_encode(['message'=> $message]);
    }

    public static function sayHelloFullData(){
        echo json_encode(['message'=> '']);
    }
    
}