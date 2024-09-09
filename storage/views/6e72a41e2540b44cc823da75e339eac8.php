<?php

if(!$new){
    return redirect(ADMIN . '/news');
}
view('admin.layouts.header', ['title'=>trans('admin.NEWS').'-'.trans('admin.EDIT')]);

?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> <?php echo  trans('admin.news') ;?> - <?php echo  trans('admin.EDIT') ;?></h2>
		<a class="btn btn-info" href="<?php echo  url(ADMIN.'/news') ;?>"><?php echo  trans('admin.NEWS') ;?></a>
	</div>

	 
	 
	<form method="post" action="<?php echo url(ADMIN.'/news/update');?>" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="post" />
		<input type="hidden" name="id" value="<?php echo  $new['id'] ;?>" />
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="title"><?php echo trans('news.TITLE');?></label>
					<input type="text" id="title" name="title" placeholder="<?php echo trans('news.TITLE');?>"
						class="form-control <?php echo  !empty(get_error('title'))?'is-invalid':'' ;?>" value="<?php echo $new['title'];?>" />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="category_id"><?php echo trans('news.CATEGORY_ID');?></label>
					<select class="form-select <?php echo  !empty(get_error('category_id'))?'is-invalid':'' ;?>" name="category_id">
						<option disabled selected><?php echo  trans('admin.CHOOSE') ;?></option>
						<?php while($category  = mysqli_fetch_assoc($categories['query'])): ?>
						<option <?php echo  $new['category_id'] == $category['id']?'selected':'' ;?> value="<?php echo  $category['id'] ;?>"><?php echo  $category['name'] ;?></option>
						<?php endwhile; ?>
					</select>

				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="image"><?php echo trans('news.IMAGE');?></label>
					<input type="file" id="image" name="image" placeholder="<?php echo trans('news.IMAGE');?>"
						class="form-control <?php echo  !empty(get_error('image'))?'is-invalid':'' ;?>" />
						<?php echo  show_image(storage_url($new['image'])) ;?>
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label for="description"><?php echo trans('news.DESCRIPTION');?></label>
					<textarea name="description" placeholder="<?php echo trans('news.DESCRIPTION');?>"
						class="form-control <?php echo  !empty(get_error('description'))?'is-invalid':'' ;?>"><?php echo $new['description'];?></textarea>
				</div>
			</div>


			<div class="col-md-12">
				<div class="form-group">
					<label for="content"><?php echo trans('news.CONTENT');?></label>
					<textarea name="content" id="content" placeholder="<?php echo trans('news.CONTENT');?>"
						class="form-control <?php echo  !empty(get_error('content'))?'is-invalid':'' ;?>"><?php echo $new['content'];?></textarea>
				</div>
			</div>
		</div>
		<input type="submit" class="btn btn-success" value="<?php echo trans('admin.SAVE');?>" />
	</form>
 
<script>

	ClassicEditor
		.create(document.querySelector('#content'),{
			language: '<?php echo  session_has("locale")?session("locale"):"en" ;?>',
		})
		.catch(error => {
			console.error(error);
		});
</script>
<?php
view('admin.layouts.footer');
?>