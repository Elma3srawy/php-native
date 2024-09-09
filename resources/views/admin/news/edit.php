<?php

if(!$new){
    return redirect(ADMIN . '/news');
}
view('admin.layouts.header', ['title'=>trans('admin.NEWS').'-'.trans('admin.EDIT')]);

?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> {{ trans('admin.news') }} - {{ trans('admin.EDIT') }}</h2>
		<a class="btn btn-info" href="{{ url(ADMIN.'/news') }}">{{ trans('admin.NEWS') }}</a>
	</div>

	 
	 
	<form method="post" action="{{url(ADMIN.'/news/update')}}" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="post" />
		<input type="hidden" name="id" value="{{ $new['id'] }}" />
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="title">{{trans('news.TITLE')}}</label>
					<input type="text" id="title" name="title" placeholder="{{trans('news.TITLE')}}"
						class="form-control {{ !empty(get_error('title'))?'is-invalid':'' }}" value="{{$new['title']}}" />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="category_id">{{trans('news.CATEGORY_ID')}}</label>
					<select class="form-select {{ !empty(get_error('category_id'))?'is-invalid':'' }}" name="category_id">
						<option disabled selected>{{ trans('admin.CHOOSE') }}</option>
						<?php while($category  = mysqli_fetch_assoc($categories['query'])): ?>
						<option {{ $new['category_id'] == $category['id']?'selected':'' }} value="{{ $category['id'] }}">{{ $category['name'] }}</option>
						<?php endwhile; ?>
					</select>

				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="image">{{trans('news.IMAGE')}}</label>
					<input type="file" id="image" name="image" placeholder="{{trans('news.IMAGE')}}"
						class="form-control {{ !empty(get_error('image'))?'is-invalid':'' }}" />
						{{ show_image(storage_url($new['image'])) }}
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label for="description">{{trans('news.DESCRIPTION')}}</label>
					<textarea name="description" placeholder="{{trans('news.DESCRIPTION')}}"
						class="form-control {{ !empty(get_error('description'))?'is-invalid':'' }}">{{$new['description']}}</textarea>
				</div>
			</div>


			<div class="col-md-12">
				<div class="form-group">
					<label for="content">{{trans('news.CONTENT')}}</label>
					<textarea name="content" id="content" placeholder="{{trans('news.CONTENT')}}"
						class="form-control {{ !empty(get_error('content'))?'is-invalid':'' }}">{{$new['content']}}</textarea>
				</div>
			</div>
		</div>
		<input type="submit" class="btn btn-success" value="{{trans('admin.SAVE')}}" />
	</form>
 
<script>

	ClassicEditor
		.create(document.querySelector('#content'),{
			language: '{{ session_has("locale")?session("locale"):"en" }}',
		})
		.catch(error => {
			console.error(error);
		});
</script>
<?php
view('admin.layouts.footer');
?>