<?php

if(empty($comment)){
    return redirect(ADMIN.'/comments');
}

view('admin.layouts.header', ['title'=>trans('admin.COMMENTS').'-'.trans('admin.EDIT')]);

?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> {{ trans('admin.COMMENTS') }} - {{ trans('admin.EDIT') }}</h2>
		<a class="btn btn-info" href="{{ url(ADMIN.'/comments') }}">{{ trans('admin.COMMENTS') }}</a>
	</div>
 

	@php
	$name = get_error('name');
	$icon = get_error('icon');
	$description = get_error('description');
	end_errors();

	@endphp

	<form method="post" action="{{url(ADMIN.'/comments/update')}}" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="post" />
		<input type="hidden" name="news_id" value="{{$comment['news_id']}}" />
		<input type="hidden" name="id" value="{{$comment['id']}}" />

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="name">{{trans('comment.NAME')}}</label>
					<input type="text" name="name" placeholder="{{trans('comment.NAME')}}"
						class="form-control {{ !empty(get_error('name'))?'is-invalid':'' }}" value="{{ $comment['name'] }}" />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="name">{{trans('comment.EMAIL')}}</label>
					<input type="text" name="email" placeholder="{{trans('comment.EMAIL')}}"
						class="form-control {{ !empty(get_error('email'))?'is-invalid':'' }}" value="{{ $comment['email'] }}" />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="name">{{trans('comment.NEWS')}}</label>
					<a href="{{url(ADMIN.'/news/show?id='.$comment['news_id'])}}" target="_blank">{{$comment['title']}}</a> 
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="name">{{trans('comment.STATUS')}}</label>
					<select name="status" class="form-select {{ !empty(get_error('status'))?'is-invalid':'' }}" >
						<option value="show" {{ $comment['status'] == 'show'?'selected':'' }}>{{trans('comment.SHOW')}}</option>
						<option value="hide" {{ $comment['status'] == 'hide'?'selected':'' }}>{{trans('comment.HIDE')}}</option>
					</select>
					 
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label for="description">{{trans('comment.COMMENT')}}</label>
					<textarea name="comment" placeholder="{{trans('comment.COMMENT')}}"
						class="form-control {{ !empty(get_error('comment'))?'is-invalid':'' }}">{{ $comment['comment'] }}</textarea>
				</div>
			</div>
		</div>
		<input type="submit" class="btn btn-success" value="{{trans('admin.SAVE')}}" />
	</form>
 
<?php
view('admin.layouts.footer');
?>