<?php

require_once(__DIR__ .'/includes/app.php');
require_once(__DIR__ . '/routes/web.php');
require_once(__DIR__ . '/includes/exception.php');

// symlink(__DIR__ . '/storage' , __DIR__ . '/public/storage');

// route_init();


// var_dump(session('test'));

// var_dump(db_create('users' , [
//     'name' => 'fda' ,
//     'phone' => '0512',
//     'email' => 'kok@gmail.com'
// ]));
// set_locale('en');
// var_dump(db_update('users' , [
//     'name' => 'mohamed' , 
//     'email' => 'gadgs@gmail.com']
//     ,51));

// var_dump(db_delete('users' ,51));

// var_dump(db_find('users' ,53));

// var_dump(db_get('users' , "WHERE id = 52"));

// var_dump(db_first('users'));


// session('test' , 'new test');
// echo session('test');
// echo session_forget('test');
// echo session('test');
// echo config('test');


// var_dump(config('database.username'));

// echo config('view.path');
// echo "<pre>";
// print_r (uri('test'));

// echo url('test');

// redirect();
// echo "<pre>";
// var_dump( request());
// set_locale('ar');
// session_forget('locale');
// var_dump(trans('main.HOME'));
// var_dump(include __DIR__. '/lang/ar/main.php');


// echo hashing('123123123');
// echo session_flash('success');

// var_dump($_SESSION);
// var_dump(session_has('success'));

// var_dump (request());  

    // var_dump(validation('email' , 'required')) ; 
    // echo '<br>';
//    validation('email' , 'required|email|min:15|') ; 
    // echo '<br>';
    // validation('name' , 'required') ; 
    // validation('email' , 'required|email|min:8') ; 
    // echo '<br>';
    // var_dump(validation('name', 'required')); 
    // echo '<br>';
    // var_dump(validation('name' , 'string')) ; 
    // echo '<br>';
    // var_dump(validation('name' , 'min:6')) ; 
    // echo '<br>';
    // // var_dump(validation('name' , 'integer')) ; 
    // echo '<br>';
    
    
    // echo '<br>';
    // echo '<br>';
    // echo '<br>';
    // echo '<pre>';
    // var_dump(any_errors());

    // var_dump(change_attribute_name('email' , 'The Email :Attribute Is Not Valid'));
// var_dump(storage(decrypt('AQ9rHwl3cok20N+EfKSu/YYyHyUnu43vAcVOu/HafUOanWC4Ylsh/ppbeTkaaaNH09oJ1QVyrPsZXlTnEZ5SV5dXATKO0sRebY9Lh+tpWuHX2OiQTPCZaCt2Xq2f1PConP4jRo0jPZSpScUwAp9x+ZoOBoTXAW4e6xxJWHNwT2eAzTev3cCfLZvbkHIPSb2r')));

// var_dump(unique('unique:table,column,except' ,'test'));

// var_dump(glob(base_path().'/storage/views/*') );
