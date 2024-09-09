<?php
if(empty($new)){
    redirect(ADMIN.'/news');
}


view('admin.layouts.header', ['title'=>trans('admin.NEWS').'-'.trans('admin.SHOW')]);


?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> {{ trans('admin.NEWS') }} - {{ trans('admin.SHOW') }} #{{ $new['title'] }}</h2>
		<a class="btn btn-info" href="{{ url(ADMIN.'/news') }}">{{ trans('admin.NEWS') }}</a>
	</div>



	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label for="title">{{trans('news.TITLE')}}</label>
				{{ $new['title'] }}
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="category_id">{{trans('news.CATEGORY_ID')}}</label>

				<a href="{{ url(ADMIN.'/categories/show?id='.$new['category_id']) }}">{{ $new['category_name'] }}</a>

			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="user_id">{{trans('news.USER_ID')}}</label>

				<a href="{{ url(ADMIN.'/users/show?id='.$new['user_id']) }}">{{ $new['username'] }}</a>

			</div>
		</div>


		<div class="col-md-6">
			<div class="form-group">
				<label for="image">{{trans('news.IMAGE')}}</label>

				{{ show_image(storage_url($new['image'])) }}


			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label for="description">{{trans('news.DESCRIPTION')}}</label>
				{{ $new['description'] }}
			</div>
		</div>


		<div class="col-md-12">
			<div class="form-group">
				<label for="content">{{trans('news.CONTENT')}}</label>
				{{ $new['content'] }}
			</div>
		</div>
	</div>

 
<?php
view('admin.layouts.footer');
?>