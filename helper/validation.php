<?php 


$errors = [];


if(!function_exists('validation')){
    function validation(array $attributes  , array $trans, $http_header = 'redirect'){
        global $errors;
        $data = [];
        foreach ($attributes as $attribute => $rules) {
            $rules = explode('|' , trim($rules, '|')) ;
            $value = request($attribute);
            $data[$attribute] = $value;
            $attr_name = !is_null($trans) && count($trans)  > 0 ? array_shift($trans) : $attribute;
            foreach($rules as $rule){
                if($rule == 'required'){
                    required($attribute , $attr_name);
                }
                if($rule == 'image'){
                    image($attribute , $attr_name);
                }
                if($rule == 'email'){
                    email($attribute , $attr_name);
                }
                if(substr($rule , 0 , strpos($rule , ':')) == 'max'){
                    max_validation($attribute , $attr_name ,$rule);
                }
                if(substr($rule , 0 , strpos($rule , ':')) == 'min'){
                    min_validation($attribute , $attr_name ,$rule);
                }
                if($rule == 'string'){
                    str_validation($attribute , $attr_name);
                }
                if($rule == 'integer'){
                    int_validation($attribute , $attr_name);
                }
                if(substr($rule , 0 , strpos($rule , ':'))  == 'in'){
                    in($attribute , $rule , $attr_name);
                }
                if(substr($rule , 0 , strpos($rule , ':')) == 'unique'){
                    unique($attribute , $attr_name , $rule);
                }
                if(preg_match('/^exists:/i', $rule)){
                    exists($attribute , $rule , $attr_name);
                }
            }
        }
        if(!is_null($errors) && count($errors) > 0){
            set_session_errors();
            if($http_header == 'redirect'){
                back();
            }elseif($http_header == "api"){
                return json_encode($errors , JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
            }
        }else{
            return $data;
        }
    }
}

if (!function_exists('required')) {
    function required(string $attribute , string $attr_name){
         global  $errors;
            $value = request($attribute);
        if((is_null($value) || empty($value))  && empty($_FILES[$attribute]['tmp_name'])){
            $errors[$attribute][] = change_attribute_name($attr_name , trans('validation.REQUIRED'));
        }
    }
}

if (!function_exists('exists')) {
    function exists(string $attribute ,string $rule , string $attr_name){
        global  $errors;
        $value = request($attribute);
        $ex_rule = explode(':', $rule);
        if(count($ex_rule) > 1 && isset($ex_rule[1])) {
            $get_exists_info = explode(',', $ex_rule[1]);
            $table = $get_exists_info[0];
            $column = isset($get_exists_info[1])?$get_exists_info[1]:$attribute;
            
            if(isset($get_exists_info[2])) {
                $sql = "where  ".$column."='".$value."'";
            } else {
                $sql = "where  id='".$value."'";
            }
            
            $check_exists_db = db_first($table, $sql);
            if(empty($check_exists_db)) {
                $errors[$attribute][] =change_attribute_name($attr_name , trans('validation.EXISTS'));
            }
        }
    }
}
if(!function_exists('email')){
    function email(string $attribute ,string $attr_name){
    
        global  $errors;
        $value = request($attribute);
        $value = filter_var($value , FILTER_SANITIZE_EMAIL);
        if (!is_null($value) && !filter_var($value , FILTER_VALIDATE_EMAIL)){
            $errors[$attribute][] = change_attribute_name($attr_name , trans('validation.EMAIL'));
        }
    }
}
if(!function_exists('in')){
    function in(string $attribute ,string $rule , string $attr_name ){
    
        global  $errors;
        $value = request($attribute);
        $valid_array = explode(',',explode(':' , $rule)[1]);
        if(is_null($value) || !in_array($value , $valid_array)){
            $errors[$attribute][] = change_attribute_name($attr_name , trans('validation.IN'));
        }
    }
}

if(!function_exists('unique')){
    function unique(string $attribute ,string $attr_name , $rule){
        global  $errors;
    
        $rule = explode(',' , explode(':' ,$rule)[1]);
        $table  = $rule[0];
        $column = $rule[1];
        $column_except = $rule[2] ?? NULL;
        $except = $rule[3] ?? "";
        $value = request($attribute);

        $sql = "SELECT ". "COUNT(".$column.") AS count" ." FROM " . $table . " WHERE " . $column . " = " ."'".$value ."'";
        $count = mysqli_fetch_column(mysqli_query($GLOBALS['connect'], $sql));

        if(is_null($column_except)){
            $sql = "SELECT ". "COUNT(".$column.") AS count" ." FROM " . $table . " WHERE " . $column . " = " ."'".$value ."'";
            $count = mysqli_fetch_column(mysqli_query($GLOBALS['connect'], $sql));
        }else{
            $sql .= " AND ". $column_except . " != " .$except;
            $count = mysqli_fetch_column(mysqli_query($GLOBALS['connect'], $sql));
        }
        if($count > 0){
            $errors[$attribute][] = change_attribute_name($attr_name , trans('validation.UNIQUE'));
        }
    }
}

if(!function_exists('image')){
    function image(string $attribute ,string $attr_name){
    
        global  $errors;
        $value = $_FILES[$attribute]['tmp_name'];
        if ((!empty($value) && getimagesize($value) == false) || pathinfo($_FILES[$attribute]['name'] , PATHINFO_EXTENSION) == 'php'){
            $errors[$attribute][] = change_attribute_name($attr_name , trans('validation.IMAGE'));
        }
    }
}

if(!function_exists('max_validation')){
    function max_validation(string $attribute , string $attr_name ,string $rule){
        global  $errors;
        $value = request($attribute);
        $size = substr($rule , strpos($rule , ":") + 1);
        if(!is_null($value) && strlen($value) > $size){
            $errors[$attribute][] = change_attribute_name($attr_name,trans('validation.MAX') , $size);
        }
    }
}

if(!function_exists('min_validation')){
    function min_validation(string $attribute ,string $attr_name  ,string $rule){
        global  $errors;
        $value = request($attribute);
        $size = substr($rule , strpos($rule , ":") + 1);
        if(!is_null($value) && strlen($value) < $size){
            $errors[$attribute][] = change_attribute_name($attr_name,trans('validation.MIN'), $size);
        }
    }
}

if(!function_exists('str_validation')){
    function str_validation(string $attribute , string $attr_name){
        global  $errors;
        $value = request($attribute);
        if(!is_null($value) && !is_string($value)){
            $errors[$attribute][] = change_attribute_name($attr_name ,trans('validation.STRING'));
        }
    }
}

if(!function_exists('int_validation')){
    function int_validation(string $attribute , string $attr_name){
        global  $errors;
        $value = request($attribute);
        if(!is_null($value) && !filter_var($value , FILTER_VALIDATE_INT)){
            $errors[$attribute][]= change_attribute_name($attr_name ,trans('validation.INTEGER'));
        }
    }
}

if(!function_exists('change_attribute_name')){
    function change_attribute_name(string $attribute , string $error , int $number =null):string{
        $result = str_replace(':attribute' , $attribute , $error);
        if(!is_null($number)){
            $result = str_replace([':attribute' , ':num'], [$attribute ,$number], $error);
        }   
        return $result;
    }
}

if (!function_exists('any_errors')) {
    function any_errors($attribute = null){
        $errors_form_session = json_decode(session('errors') , True);
        if (isset($errors_form_session[$attribute]) && !is_null($attribute)) {
            $text = $errors_form_session[$attribute];
            return is_array($text) ? $text :[];
        } elseif (!empty($errors_form_session) && count($errors_form_session) > 0) {
            return  $errors_form_session;
        }
        return [];
    }
}

if (!function_exists('set_session_errors')) {
    function set_session_errors()
    {
        global  $errors;
        if (!empty($errors) && is_array($errors) &&  count($errors) > 0) {
            session('errors', json_encode($errors));
        }
    }
}

if (!function_exists('all_errors')) {
    function all_errors()
    {
       $all = [];
       foreach(any_errors() as $errors){
            foreach($errors as $error){
                $all[] = $error;
            }
       }
       return $all;
    }
}
if (!function_exists('get_error')) {
    function get_error($offset)
    {
       $get_error = '';
       foreach(any_errors($offset) as $error){
            if(is_string($error)){
                $get_error .= $error;
            }
       }
       return $get_error;
    }
}
if (!function_exists('end_errors')) {
    function end_errors()
    {
        session_flash('errors');
    }
}