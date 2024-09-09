<?php 


$route_get = isset($routes['GET'])? array_column($routes['GET'], 'segment') : []; 
$route_post = isset($routes['POST'])? array_column($routes['POST'], 'segment') : []; 
$routes = array_merge($route_get , $route_post);

if (in_array(segment(), $route_post) && !in_array(segment(), $route_get) && count($_POST) == 0 && !isset($_POST['_method'])) {
    view('404');
    exit();
}

if(!is_null(segment()) && !in_array(segment(), $routes)){
    view('404');
    exit();
}