<?php 


include base_path().'routes/admin.php';



route_get('/' , view:'front.home');
route_get('/language' , 'main.language@set_language');


route_get('/news/archive', view:'front.archive');
route_get('/category', view:'front.categories.category');
route_get('/news', view:'front.categories.news');
route_post('/comment/store' , 'comment.comments@store');

