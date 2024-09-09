<?php 

function index(){
    $news = db_paginate("news", " JOIN categories on news.category_id = categories.id
        JOIN users on news.user_id = users.id ", 12,"asc","
        news.title,
        news.content,
        news.category_id,
        news.created_at,
        news.updated_at,
        news.user_id,
        news.image,
        news.description,
        news.id,
        users.name as username , 
        categories.name as category_name"
    );
    return view('admin.news.index' , ['news_list' => $news]);
}


function create(){
    $categories = db_get('categories', "");
    return view('admin.news.create' , ['categories' =>$categories]);
}

function store(){

    $validated =  validation([
        'title'=>'required|string|min:3|max:255',
        'category_id'=>'required|integer',
        'image'=>'image',
        'description'=>'',
        'content'=>'required|string',
    ] ,[
        'title'=>trans('news.TITLE'),
        'category_id'=>trans('news.CATEGORY_ID'),
        'image'=>trans('news.IMAGE'),
        'description'=>trans('news.DESCRIPTION'),
        'content'=>trans('news.CONTENT'),
    ]);


    if(!empty($_FILES['image']['tmp_name'])){
        $path = upload_file('image' , 'news');
        $validated['image']  = $path;
    }else{
        unset($validated['image']);
    }
    $validated['user_id']  = auth('admin')['id'];
    $validated['created_at']  = date('y-m-d h:i:s');
    $validated['updated_at']  = date('y-m-d h:i:s');
    

    db_create('news' , $validated);

    session('success' , trans('admin.ADDED'));

    return redirect(ADMIN.'/news/create');

}

function show(){
    $new = db_first('news',"
        JOIN categories on news.category_id = categories.id
        JOIN users on news.user_id = users.id 
        where news.id=".request('id'),"
        news.title,
        news.content,
        news.category_id,
        news.user_id,
        news.image,
        news.description,
        news.id,
        users.name as username , 
        categories.name as category_name"
    );
    return view('admin.news.show' , ['new' => $new]);
}

function edit(){

    $new = db_find('news', request('id'));
    $categories = db_get('categories', "");
    return view('admin.news.edit' , ["new" => $new , 'categories' => $categories]);
}

function update(){
    $validated =  validation([
        'title'=>'required|string|min:3|max:255',
        'category_id'=>'required|integer',
        'image'=>'image',
        'description'=>'',
        'content'=>'required|string',
    ] ,[
        'title'=>trans('news.TITLE'),
        'category_id'=>trans('news.CATEGORY_ID'),
        'image'=>trans('news.IMAGE'),
        'description'=>trans('news.DESCRIPTION'),
        'content'=>trans('news.CONTENT'),
    ]);

    $new = db_find('news' , request('id'));

    if(!empty($_FILES['image']['tmp_name'])){
        if(!is_null($new['image'])){
            delete_file($new['image']);
        }
        $path = upload_file('image' , 'news');
        $validated['image']  = $path;
    }else{
        $validated['image']  = $new['image'];
    }
    $validated['user_id']  = auth('admin')['id'];
    $validated['updated_at']  = date('y-m-d h:i:s');


    db_update('news' , $validated , request('id'));

    session('success' , trans('admin.ADDED'));

    return back();
}

function destroy(){
    $new =db_find('news', request('id'));
    delete_file($new['image']);
    db_delete('news' ,request('id'));
    session('success' , trans('admin.DELETED'));
    back();
}