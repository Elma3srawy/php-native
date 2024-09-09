<?php

if(empty($comment)){
    return redirect(ADMIN.'/comments');
}

view('admin.layouts.header', ['title'=>trans('admin.COMMENTS').'-'.trans('admin.EDIT')]);

?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> <?php echo  trans('admin.COMMENTS') ;?> - <?php echo  trans('admin.EDIT') ;?></h2>
		<a class="btn btn-info" href="<?php echo  url(ADMIN.'/comments') ;?>"><?php echo  trans('admin.COMMENTS') ;?></a>
	</div>
 

	<?php
	$name = get_error('name');
	$icon = get_error('icon');
	$description = get_error('description');
	end_errors();

	?>

	<form method="post" action="<?php echo url(ADMIN.'/comments/update');?>" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="post" />
		<input type="hidden" name="news_id" value="<?php echo $comment['news_id'];?>" />
		<input type="hidden" name="id" value="<?php echo $comment['id'];?>" />

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="name"><?php echo trans('comment.NAME');?></label>
					<input type="text" name="name" placeholder="<?php echo trans('comment.NAME');?>"
						class="form-control <?php echo  !empty(get_error('name'))?'is-invalid':'' ;?>" value="<?php echo  $comment['name'] ;?>" />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="name"><?php echo trans('comment.EMAIL');?></label>
					<input type="text" name="email" placeholder="<?php echo trans('comment.EMAIL');?>"
						class="form-control <?php echo  !empty(get_error('email'))?'is-invalid':'' ;?>" value="<?php echo  $comment['email'] ;?>" />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="name"><?php echo trans('comment.NEWS');?></label>
					<a href="<?php echo url(ADMIN.'/news/show?id='.$comment['news_id']);?>" target="_blank"><?php echo $comment['title'];?></a> 
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="name"><?php echo trans('comment.STATUS');?></label>
					<select name="status" class="form-select <?php echo  !empty(get_error('status'))?'is-invalid':'' ;?>" >
						<option value="show" <?php echo  $comment['status'] == 'show'?'selected':'' ;?>><?php echo trans('comment.SHOW');?></option>
						<option value="hide" <?php echo  $comment['status'] == 'hide'?'selected':'' ;?>><?php echo trans('comment.HIDE');?></option>
					</select>
					 
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label for="description"><?php echo trans('comment.COMMENT');?></label>
					<textarea name="comment" placeholder="<?php echo trans('comment.COMMENT');?>"
						class="form-control <?php echo  !empty(get_error('comment'))?'is-invalid':'' ;?>"><?php echo  $comment['comment'] ;?></textarea>
				</div>
			</div>
		</div>
		<input type="submit" class="btn btn-success" value="<?php echo trans('admin.SAVE');?>" />
	</form>
 
<?php
view('admin.layouts.footer');
?>