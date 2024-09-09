<?php
if(empty($new)){
    redirect(ADMIN.'/news');
}


view('admin.layouts.header', ['title'=>trans('admin.NEWS').'-'.trans('admin.SHOW')]);


?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> <?php echo  trans('admin.NEWS') ;?> - <?php echo  trans('admin.SHOW') ;?> #<?php echo  $new['title'] ;?></h2>
		<a class="btn btn-info" href="<?php echo  url(ADMIN.'/news') ;?>"><?php echo  trans('admin.NEWS') ;?></a>
	</div>



	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="title"><?php echo trans('news.TITLE');?></label>
				<?php echo  $new['title'] ;?>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="category_id"><?php echo trans('news.CATEGORY_ID');?></label>

				<a href="<?php echo  url(ADMIN.'/categories/show?id='.$new['category_id']) ;?>"><?php echo  $new['category_name'] ;?></a>

			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="user_id"><?php echo trans('news.USER_ID');?></label>

				<a href="<?php echo  url(ADMIN.'/users/show?id='.$new['user_id']) ;?>"><?php echo  $new['username'] ;?></a>

			</div>
		</div>


		<div class="col-md-6">
			<div class="form-group">
				<label for="image"><?php echo trans('news.IMAGE');?></label>

				<?php echo  show_image(storage_url($new['image'])) ;?>


			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label for="description"><?php echo trans('news.DESCRIPTION');?></label>
				<?php echo  $new['description'] ;?>
			</div>
		</div>


		<div class="col-md-12">
			<div class="form-group">
				<label for="content"><?php echo trans('news.CONTENT');?></label>
				<?php echo  $new['content'] ;?>
			</div>
		</div>
	</div>

 
<?php
view('admin.layouts.footer');
?>