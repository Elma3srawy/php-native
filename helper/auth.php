<?php 



if(!function_exists('auth')){
    function auth($guard):array|null{
        if(!empty($guard) && $guard == "admin"){
            if(session_has('admin')){
                return json_decode(session('admin') , true);
            }
        }
        return null;
    }
}

