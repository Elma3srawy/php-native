<?php


define('ADMIN', '/admin');



route_get(ADMIN.'/test', 'admin.test@test');



route_get(ADMIN, view:'admin.index');
route_get(ADMIN.'/lang', 'admin.lang@set_lang');

// Admin Authenticate
route_get(ADMIN.'/login',  view:'admin.login');
route_post(ADMIN.'/sign-in', 'admin.authentication@login');
route_get(ADMIN.'/logout', 'admin.authentication@logout');

//categories CRUD
route_get(ADMIN.'/categories', 'category.category@index');
route_get(ADMIN.'/categories/create', 'category.category@create');
route_post(ADMIN.'/categories/store', 'category.category@store');
route_get(ADMIN.'/categories/show', 'category.category@show');
route_get(ADMIN.'/categories/edit', 'category.category@edit');
route_post(ADMIN.'/categories/update', 'category.category@update');
route_post(ADMIN.'/categories/delete', 'category.category@destroy');


//comments CRUD
route_get(ADMIN.'/comments', 'comment.comments@index');
route_get(ADMIN.'/comments/show', 'comment.comments@show');
route_get(ADMIN.'/comments/edit', 'comment.comments@edit');
route_post(ADMIN.'/comments/update', 'comment.comments@update');
route_post(ADMIN.'/comments/delete', 'comment.comments@destroy');


// News CRUD
route_get(ADMIN.'/news', 'news.news@index');
route_get(ADMIN.'/news/create', 'news.news@create');
route_post(ADMIN.'/news/store', 'news.news@store');
route_get(ADMIN.'/news/show', 'news.news@show');
route_get(ADMIN.'/news/edit', 'news.news@edit');
route_post(ADMIN.'/news/update', 'news.news@update');
route_post(ADMIN.'/news/delete', 'news.news@destroy');



// Users CRUD
route_get(ADMIN.'/users', 'user.user@index');
route_get(ADMIN.'/users/create', 'user.user@create');
route_post(ADMIN.'/users/store', 'user.user@store');
route_get(ADMIN.'/users/show', 'user.user@show');
route_get(ADMIN.'/users/edit', 'user.user@edit');
route_post(ADMIN.'/users/update', 'user.user@update');
route_post(ADMIN.'/users/delete', 'user.user@destroy');



