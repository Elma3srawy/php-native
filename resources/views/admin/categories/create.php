<?php
view('admin.layouts.header',['title'=>trans('admin.CATEGORIES')]);
?>
 
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>  {{ trans('admin.CATEGORIES') }} - {{ trans('admin.CREATE') }}</h2>
<a class="btn btn-info" href="{{ url('admin/categories') }}">{{ trans('admin.CATEGORIES') }}</a>      
</div>

 

  <form method="post" action="{{url('admin/categories/store')}}" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post" />
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
          <label for="name">{{trans('cat.NAME')}}</label>
          <input type="text" name="name" placeholder="{{trans('cat.NAME')}}"  class="form-control {{ !empty(get_error('name'))?'is-invalid':'' }}"/>
         </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label for="icon">{{trans('cat.ICON')}}</label>
          <input type="file" name="icon" placeholder="{{trans('cat.ICON')}}"  class="form-control {{ !empty(get_error('icon'))?'is-invalid':'' }}"  />
         </div>
        </div>

        <div class="col-md-12">
        <div class="form-group">
          <label for="description">{{trans('cat.DESC')}}</label>
          <textarea name="description" placeholder="{{trans('cat.DESC')}}"  class="form-control {{ !empty(get_error('description'))?'is-invalid':'' }}"></textarea>
         </div>
        </div>
    </div>
    <input type="submit" class="btn btn-success" value="{{trans('admin.CREATE')}}" />
  </form>
</main>
<?php
view('admin.layouts.footer');
?>
