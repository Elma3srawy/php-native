<?php




if(!function_exists("session")){
    function session(string $key ,  mixed $value = null){
        global $flash;
        if (!is_null($value)){
            if(is_array($value)){
                $value =json_encode($value);
                $_SESSION[$key] = encrypt($value);
            }
            $_SESSION[$key] = encrypt($value);
        }
        return isset($_SESSION[$key]) && !is_null($_SESSION[$key]) ? decrypt($_SESSION[$key]) : '';
    }
}

if(!function_exists("session_forget")){
    function session_forget(string $key ){
        if(!empty(session($key))) {
            unset($_SESSION[$key]);
        }
    }
}

if(!function_exists("session_flash")){
    function session_flash(string $key){
        $session = session($key);
        session_forget($key);
        return $session;
    }
}

if (!function_exists("session_has")) {
    function session_has(string $key)
    {
        return isset($_SESSION[$key]) && !is_null($_SESSION[$key]) ? True : False;
    }
}