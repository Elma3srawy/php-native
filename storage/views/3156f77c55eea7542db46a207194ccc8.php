<?php
view('admin.layouts.header',['title'=>trans('admin.CATEGORIES')]);
?>
 
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>  <?php echo  trans('admin.CATEGORIES') ;?> - <?php echo  trans('admin.CREATE') ;?></h2>
<a class="btn btn-info" href="<?php echo  url('admin/categories') ;?>"><?php echo  trans('admin.CATEGORIES') ;?></a>      
</div>

 

  <form method="post" action="<?php echo url('admin/categories/store');?>" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post" />
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
          <label for="name"><?php echo trans('cat.NAME');?></label>
          <input type="text" name="name" placeholder="<?php echo trans('cat.NAME');?>"  class="form-control <?php echo  !empty(get_error('name'))?'is-invalid':'' ;?>"/>
         </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label for="icon"><?php echo trans('cat.ICON');?></label>
          <input type="file" name="icon" placeholder="<?php echo trans('cat.ICON');?>"  class="form-control <?php echo  !empty(get_error('icon'))?'is-invalid':'' ;?>"  />
         </div>
        </div>

        <div class="col-md-12">
        <div class="form-group">
          <label for="description"><?php echo trans('cat.DESC');?></label>
          <textarea name="description" placeholder="<?php echo trans('cat.DESC');?>"  class="form-control <?php echo  !empty(get_error('description'))?'is-invalid':'' ;?>"></textarea>
         </div>
        </div>
    </div>
    <input type="submit" class="btn btn-success" value="<?php echo trans('admin.CREATE');?>" />
  </form>
</main>
<?php
view('admin.layouts.footer');
?>
