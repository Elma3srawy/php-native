<?php
if(!function_exists('trans')){
    function trans(string $trans){
        $count = str_word_count($trans, characters: '.');
        if ($count > 0) {
            $path = str_replace('.', '/', $trans, $count);
            $word  = explode('/' , $path)[$count];
            $dir   = rtrim($path, '/' . $word); 
            if(session_has('locale') && in_array(session('locale') , config('lang.langs'))){
                $default = session('locale');
            }else{
                $default = !empty(config('lang.default') )? config('lang.default') : config('lang.fallback');
            }
            $path = config('lang.path') . '/' . $default . '/' . $dir . '.php';
        }
        if(file_exists($path)){
            $dict = include $path;
            return  array_key_exists($word , $dict) ? $dict[$word] : $trans;
            
        }
        else{
            return $trans;
        }
        
    }
}

if(!function_exists('set_locale')){
    function set_locale(string $lang){  
        session('locale' , $lang);
    }
}