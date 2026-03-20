<?php

function validate($data){
    if (
        !isset(
            $data["campo1"],
            $data["campo2"],
            $data["campo3"],
            $data["campo4"],
            $data["campo5"],
            $data["campo6"]
        )
    ){
        return false;
    }
    
    return is_string($data["campo1"]) &&
           is_string($data["campo2"]) &&
           is_string($data["campo3"]) &&
           is_int($data["campo4"]) &&
           (is_float($data["campo5"]) || is_numeric($data["campo5"])) &&
           is_bool($data["campo6"]);
}