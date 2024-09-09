<?php




if (!function_exists('config')) {
    function config(string $key)
    {
        $config = explode('.', $key);
        if ($config >  1) {
            $result = include __DIR__ . '/../config/' . $config[0] . '.php';
            return $result[$config[1]];
        }
    }
}

if (!function_exists('url')) {
    function url(string $path)
    {
        $path = $path[0] <> '/' ? '/' . $path : $path;
        // return $path;
        // $count = str_word_count($path, characters: '/');
        // if ($count > 0) {
        //     $path = str_replace('.', '/', $path, $count);
        // }
        return 'http://' . $_SERVER['HTTP_HOST'] . $path;
    }
}

if (!function_exists('redirect')) {
    // Enable output buffering
    ob_start();
    function redirect($url){
        
        $check_path = parse_url($url);
        if(isset($check_path['scheme']) && isset($check_path['host'])) {
            header('Location: ' . $url);
        } else {
            header('Location: ' . url($url));
        }
        exit();
    }
    // Flush the captured output (send headers and content)
    ob_flush();
}

if (!function_exists('base_path')) {
    function base_path()
    {
        return rtrim($_SERVER['SCRIPT_FILENAME'], 'index.php');
    }
}

if (!function_exists('back')) {
    function back()
    {
        if(isset($_SERVER['HTTP_REFERER'])){
            redirect ($_SERVER['HTTP_REFERER']);
        }
        
        redirect ('/');
    }
}


