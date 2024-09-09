<?php
if(empty($comment)){
    redirect(ADMIN.'/comments');
}



view('admin.layouts.header', ['title'=>trans('admin.COMMENTS').'-'.trans('admin.SHOW')]);


?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> <?php echo  trans('admin.COMMENTS') ;?> - <?php echo  trans('admin.SHOW') ;?> #<?php echo  $comment['name'] ;?></h2>
		<a class="btn btn-info" href="<?php echo  url(ADMIN.'/comments') ;?>"><?php echo  trans('admin.COMMENTS') ;?></a>
	</div>



	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="name"><?php echo trans('comment.NAME');?></label>
				<?php echo  $comment['name'] ;?>
			</div>
		</div>
		 
		<div class="col-md-6">
			<div class="form-group">
				<label for="name"><?php echo trans('comment.EMAIL');?></label>
				<?php echo  $comment['email'] ;?>
			</div>
		</div>
		 
		 
		<div class="col-md-6">
			<div class="form-group">
				<label for="name"><?php echo trans('comment.NEWS');?></label>
				<?php echo  $comment['title'] ;?>
			</div>
		</div>
		 
		 
		<div class="col-md-6">
			<div class="form-group">
				<label for="name"><?php echo trans('comment.STATUS');?></label>
				<?php echo  trans('comment.'.strtoupper($comment['status'])) ;?>
			</div>
		</div>
		 

		<div class="col-md-12">
			<div class="form-group">
				<label for="comment"><?php echo trans('comment.COMMENT');?></label>
				<?php echo  $comment['comment'] ;?>
			</div>
		</div>
	</div>
 
<?php
view('admin.layouts.footer');
?>