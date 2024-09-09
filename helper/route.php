<?php

$routes = [];

if(!function_exists('route_get')){
    function route_get(string $segment, string|NULL $controller = NULL, string|NULL $view = NULL){
        global $routes;
        $routes["GET"][]=[
            'segment' => segmentIsValid($segment), 
            'view' => $view, 
        ];
        if(isset($controller) && !empty($controller)){
            return route_init($segment ,$controller ,NULL,'GET');
        }
        if(isset($view) && !empty($view) && count($_POST) === 0){
            return route_init($segment , NULL ,$view, "GET");
        }
    }
}

if(!function_exists('route_post')){
    function route_post(string $segment, string|NULL $controller = NULL , string|NULL $view = NULL){
        global $routes;
        $routes["POST"][]=[
            'segment' => segmentIsValid($segment), 
            'view' => $view, 
        ];
        if (isset($controller) && !empty($controller)) {
            return route_init($segment, $controller, NULL, 'POST');
        }
        if(isset($view) && !empty($view) ){
            if(isset($_POST) && count($_POST) > 0 && isset($_POST['_method']) && strtolower($_POST['_method']) === 'post'){
                return route_init($segment , NULL , $view , "POST");
            }
        }
    }
}

if(!function_exists('segment')){
    function segment(): string{
        return str_contains($_SERVER['REQUEST_URI'],'?') ? substr($_SERVER['REQUEST_URI'] , 0,strpos($_SERVER['REQUEST_URI'], '?')) : $_SERVER['REQUEST_URI'];
    }
}


if(!function_exists('segmentIsValid')){
    function segmentIsValid(string $segment){
        return $segment[0] == '/' ? $segment : '/'. $segment;
    }
}


if(!function_exists('route_init')){
    function route_init(string $segment , string|NULL $controller= NULL , string|NULL  $view= NULL, string $method = NULL){
    
        global $routes; 
        $valid_routes = isset($routes[strtoupper($method)]) ? array_column($routes[strtoupper($method)], 'segment') : [];
       
        $route_get = isset($routes['GET'])? array_column($routes['GET'], 'segment') : []; 
        $route_post = isset($routes['POST'])? array_column($routes['POST'], 'segment') : []; 

        if (in_array(segment(), $route_post) && !in_array(segment(), $route_get) && count($_POST) == 0 && !isset($_POST['_method'])) {
            view('404');
            exit();
        }

        if (in_array($segment , $valid_routes) && $segment == segmentIsValid(segment())) {
            if(!is_null($view)){
                return view($view);
            }
            if(!is_null($controller)){
                return controller($controller);
            }
            
        }

    }
}


if(!function_exists('controller')){
    function controller(string $name){
        if(!empty($name)){
            $name = explode('.',$name);
            if(count($name) > 0){
                $dir = implode('/',array_slice($name , 0 , count($name) - 1));
                $file = substr(end($name) , 0 , strpos(end($name) , '@')) . '.php';
                $path =  config('controller.path').'/'.$dir.'/'. $file;
                $function_name = substr(end($name), strpos(end($name), '@') + 1);
             
                if(file_exists($path)){
                    include $path;
                    if(function_exists($function_name)){
                        return $function_name();
                    }
                }
            }
        }
    }
}