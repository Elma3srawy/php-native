<?php 


if(!function_exists('request')){
    function request(string $key = null){
        if(isset($_REQUEST["_method"]) && $_SERVER["REQUEST_METHOD"] === strtoupper($_REQUEST["_method"]) ){
            $filter = ["_method" ];
            $request = array_filter($_REQUEST, fn ($key) => !in_array($key, $filter), ARRAY_FILTER_USE_KEY);
            if(is_null($key)){
                return $request;
            }
            return !is_null($key) && key_exists($key , $request) ? $request [$key] : null;
        }
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            if(is_null($key)){
                return $_REQUEST;
            }
            return !is_null($key) && key_exists($key, $_REQUEST) ? $_REQUEST[$key] : NULL;
        }
        
    }
}