<?php
$news = db_first('news',"
JOIN categories on news.category_id = categories.id
JOIN users on news.user_id = users.id where news.id='".request('id')."'
","
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
categories.name as category_name
");
if(empty($news)){
    redirect('/');
}

?>
<?php echo view('front.layouts.header', ['title'=>$news['title']]);?>
 

<div class="row mb-2">
 <div class="col-md-12">
 <article class="blog-post">
        <h2 class="display-5 link-body-emphasis mb-1"><?php echo  $news['title'] ;?></h2>
        <p class="blog-post-meta"><?php echo  $news['created_at'] ;?>   <span><?php echo  $news['username'] ;?></span></p>
        <hr>
        <?php
if(!empty($news['image'])) {
    $img = url('storage/'.$news['image']);
} else {
    $img = url('assets/images/icon.jpeg');
}
	    ?>
        <img src="<?php echo $img;?>" style="width:100%;max-height:500px;"/>
        <p><?php echo  $news['content'] ;?></p>
      </article>
      <hr />
      <div class="col-md-12">
         <?php echo  view('front.categories.comments') ;?>
      </div>
    </div>
</div>


<?php echo view('front.layouts.footer');?>