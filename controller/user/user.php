<?php 

function index(){
   
    $users = db_paginate("users", "", 12);
    return view('admin.users.index' , ['users' => $users]);
}


function create(){
    return view('admin.users.create');
}

function store(){
    $validated =  validation([
        'name'=>'required|string|min:3|max:255|unique:users,name',
        'email'=>'required|email|unique:users,email',
        'password'=>'required|string|min:8|max:50',
        'mobile'=>'string',
        'type'=>'required|string|in:user,admin',
    ] ,[
        'name'=>trans('user.NAME'),
        'email'=>trans('user.EMAIL'),
        'password'=>trans('user.PASSWORD'),
        'mobile'=>trans('user.MOBILE'),
        'type'=>trans('user.USER_TYPE'),
    ]);

    $validated['password'] = hashing($validated['password']);
    db_create('users' , $validated);

    session('success' , trans('admin.ADDED'));

    return redirect(ADMIN.'/users/create');
}

function show(){
    $user = db_find('users', request('id'));
    return view(ADMIN.'/users/show' , ['user' => $user]);
}

function edit(){
    $user = db_find('users', request('id'));
    return view(ADMIN.'/users/edit' , ['user' => $user]);
}

function update(){
    $validated =  validation([
        'name'=>'required|string|min:3|max:255|unique:users,name,id,'.request('id'),
        'email'=>'required|email|unique:users,email,id,'.request('id'),
        'password'=>'string',
        'mobile'=>'string',
        'type'=>'required|string|in:user,admin',
    ] ,[
        'name'=>trans('user.NAME'),
        'email'=>trans('user.EMAIL'),
        'password'=>trans('user.PASSWORD'),
        'mobile'=>trans('user.MOBILE'),
        'type'=>trans('user.USER_TYPE'),
    ]);

    if(isset($validated['password']) && empty($validated['password'])) {
        unset($validated['password']);
    }elseif(isset($validated['password']) && !empty($validated['password'])){
        $validated['password'] = hashing($validated['password']);
    }
    
    db_update('users' , $validated , request('id'));

    session('success' , trans('admin.EDIT'));

    return back();
}

function destroy(){
    db_delete('users' , request('id'));
    session('success' , trans('admin.DELETE'));
    return back();
}