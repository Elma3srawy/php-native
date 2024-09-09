<?php



if (!$category){
    redirect(ADMIN.'/categories');
}

view('admin.layouts.header', ['title'=>trans('admin.CATEGORIES').'-'.trans('admin.EDIT')]);


?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> {{ trans('admin.CATEGORIES') }} - {{ trans('admin.EDIT') }}</h2>
		<a class="btn btn-info" href="{{ url(ADMIN.'/categories') }}">{{ trans('admin.CATEGORIES') }}</a>
	</div>
 

	@php
	$name = get_error('name');
	$icon = get_error('icon');
	$description = get_error('description');
	end_errors();

	@endphp

	<form method="post" action="{{ url(ADMIN.'/categories/update') }}" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="post" />
		<input type="hidden" name="id" value={{ $category['id'] }} />
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="name">{{trans('cat.NAME')}}</label>
					<input type="text" name="name" placeholder="{{trans('cat.NAME')}}"
						class="form-control {{ !empty(get_error('name'))?'is-invalid':'' }}" value="{{ $category ["name"] }}" />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="icon">{{trans('cat.ICON')}}</label>
					<input type="file" name="icon" placeholder="{{trans('cat.ICON')}}"
						class="form-control {{ !empty(get_error('icon'))?'is-invalid':'' }}" />
                        {{ show_image(storage_url($category['icon'])) }}
                </div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label for="description">{{trans('cat.DESC')}}</label>
					<textarea name="description" placeholder="{{trans('cat.DESC')}}"
						class="form-control {{ !empty(get_error('description'))?'is-invalid':'' }}">{{ $category['description'] }}</textarea>
				</div>
			</div>
		</div>
		<input type="submit" class="btn btn-success" value="{{trans('admin.SAVE')}}" />
	</form>
 
<?php
view('admin.layouts.footer');
?>