<?php 

function index(){
    $comments = db_paginate(
        "comments",
        "JOIN news on comments.news_id = news.id",
        12,
        "desc",
        "comments.id,
        comments.name,
        comments.email,
        comments.status,
        comments.comment,
        news.title as title"
    );
    
    return view('admin.comments.index' , ['comments' => $comments]);
}
function store(){
    $data =  validation([
        'news_id'=>'required|integer|exists:news,id',
        'name'=>'required|string',
        'email'=>'required|email',
        'comment'=>'required|string',
    ], [
        'news_id'=>trans('main.NEW_ID'),
        'name'=>trans('main.NAME'),
        'email'=>trans('main.EMAIL'),
        'comment'=>trans('main.COMMENTS'),
    ]);
    
    db_create('comments', $data);
    session('success' , trans('admin.ADDED'));
    return back();
}

function show(){
    $comment = db_first('comments',"
    JOIN news on comments.news_id = news.id
    
    where comments.id=".request('id'),"
    
    news.title as title,
    comments.id,
    comments.name,
    comments.email,
    comments.status,
    comments.comment,
    comments.news_id
    ");

    return view('admin.comments.show' , ['comment' => $comment]);
}
function edit(){
    $comment = db_first('comments',"
        JOIN news on comments.news_id = news.id
        
        where comments.id=".request('id'),"
        
        news.title as title,
        comments.id,
        comments.name,
        comments.email,
        comments.status,
        comments.comment,
        comments.news_id
        ");

    return view('admin.comments.edit' , ['comment' => $comment]);
}

function update(){
    $validated = validation(
        [
            'news_id' => 'required|integer',
            'id' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|email',
            'status' => 'required|in:show,hide',
            'comment' => 'required|string',
        ] 
        ,
        [
            trans('comment.NEWS'),
            trans('comment.COMMENT'),
            trans('comment.NAME'),
            trans('comment.EMAIL'),
            trans('comment.STATUS'),
            trans('comment.COMMENT'),
        ]
    );
    db_update('comments' , $validated,request('id'));
    
    session('success' , trans('admin.UPDATED'));
    return back();
}

function destroy(){
    db_delete('comments' , request('id'));
    session('success' , trans('admin.DELETE'));
    return back();
}