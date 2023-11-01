<?php
class EmptyValueException extends Exception {

    public function __construct($message = "El valor no puede estar vacío", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}