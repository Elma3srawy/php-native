<?php 

if(!function_exists('hashing')){
    function hashing(string $value):string{
        return password_hash($value , PASSWORD_BCRYPT);
    }

}


if(!function_exists('check_hash')){
    function check_hash(string $value ,string $hash):bool{
        return password_verify($value, $hash);
    }

}