<?php 


function index(){
    $categories = db_paginate('categories' , '' , 12);
    return view('admin.categories.index' , ['categories' => $categories]);
}


function create(){
    return view('admin.categories.create');
}

function store(){

    $validated = validation([
        'name' => 'required|min:3|max:50|unique:categories,name',
        'description' => 'required|min:3|max:2000',
        'icon' => 'required|image',
    ] 
    , 
    [
        'name' => trans('cat.NAME'),
        'description' => trans('cat.DESC'),
        'icon' => trans('cat.ICON'),
    ]);

    $path = upload_file('icon' , 'category');
    
    $validated['icon'] = $path;
    
    db_create('categories' , $validated);

    session('success' , trans('admin.ADDED'));

    return redirect(ADMIN.'/categories/create');
}

function show(){
    $category =db_find('categories' , request('id'));
    return view('admin.categories.show' , ['category' => $category]);
}

function edit(){
    $category =db_find('categories' , request('id'));
    return view('admin.categories.edit' , ["category" => $category]);
}

function update(){
    $validated = validation([
        'id' => 'required|integer',
        'name' => 'required|min:3|max:50|unique:categories,name,id,'.request('id'),
        'description' => 'required|min:3|max:2000',
        'icon' => 'image',
    ] 
    , 
    [
        'name' => trans('cat.NAME'),
        'description' => trans('cat.DESC'),
        'icon' => trans('cat.ICON'),
    ]);

    $category =db_find('categories', $validated['id']);
    
    if(!empty($_FILES['icon']['tmp_name'])){
        delete_file($category['icon']);
        $path = upload_file('icon' , 'category');
        $validated['icon'] = $path;
    }else{
        $validated['icon'] = $category['icon'];
    }

    
    db_update('categories' , $validated , $validated['id']);
    session('success' , trans('admin.UPDATED'));
    return back();
}

function destroy(){
    $category =db_find('categories', request('id'));
    delete_file($category['icon']);
    db_delete('categories' ,request('id'));
    session('success' , trans('admin.DELETED'));
    back();
}
