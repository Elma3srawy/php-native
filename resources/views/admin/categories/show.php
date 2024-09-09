<?php

if(!$category){
    redirect(ADMIN . '/categories');
}

view('admin.layouts.header', ['title'=>trans('admin.CATEGORIES').'-'.trans('admin.SHOW')]);

?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> {{ trans('admin.CATEGORIES') }} - {{ trans('admin.SHOW') }} #{{ $category['name'] }}</h2>
		<a class="btn btn-info" href="{{ url(ADMIN.'/categories') }}">{{ trans('admin.CATEGORIES') }}</a>
	</div>



	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">{{trans('cat.NAME')}}</label>
				{{ $category['name'] }}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="icon">{{trans('cat.ICON')}}</label>

				{{ show_image(storage_url($category['icon'])) }}

			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label for="description">{{trans('cat.DESC')}}</label>
				{{ $category['description'] }}
			</div>
		</div>
	</div>
 
<?php
view('admin.layouts.footer');
?>