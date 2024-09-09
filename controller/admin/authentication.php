<?php 


function login(){
    $validated = validation([
        'email' => 'required|email|max:30',
        'password' => 'required|string|min:8|max:30',
    ] , [
       trans('admin.EMAIL'),
       trans('admin.PASSWORD'),
    ]);

    $email = $validated['email'];
    $password = $validated['password'];

    if($admin = get_auth('users' , "email = '{$email}' AND type = 'admin'")){
        if(check_hash($password , $admin['password'])){
            session('admin' , $admin);
            return redirect(ADMIN);
        }
    }
    session('error_login', trans("admin.LOGIN_FAILED"));
    return back();
}

function logout(){
    if(auth('admin')){
        session_forget('admin');
        return redirect(ADMIN.'/login');
    }
}




