<?php

ob_start();


$includes =  ['hashing','request' , "helper" , "database" ,'AES' , "session" ,'auth' , "route","validation","translation" , 'storage',"view" ,"media" , "api"];

array_map(function($include){
    require __DIR__.'/../helper/'.$include . '.php';
}, $includes);

session_save_path(config("session.save_path"));
ini_set('session.gc_probability', 1);
session_start(['cookie_lifetime' => config('session.timeout')]);

require __DIR__. '/../database/connection.php';


ob_end_clean();
ob_end_flush();