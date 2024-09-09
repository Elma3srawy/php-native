<?php
if(empty($comment)){
    redirect(ADMIN.'/comments');
}



view('admin.layouts.header', ['title'=>trans('admin.COMMENTS').'-'.trans('admin.SHOW')]);


?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> {{ trans('admin.COMMENTS') }} - {{ trans('admin.SHOW') }} #{{ $comment['name'] }}</h2>
		<a class="btn btn-info" href="{{ url(ADMIN.'/comments') }}">{{ trans('admin.COMMENTS') }}</a>
	</div>



	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">{{trans('comment.NAME')}}</label>
				{{ $comment['name'] }}
			</div>
		</div>
		 
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">{{trans('comment.EMAIL')}}</label>
				{{ $comment['email'] }}
			</div>
		</div>
		 
		 
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">{{trans('comment.NEWS')}}</label>
				{{ $comment['title'] }}
			</div>
		</div>
		 
		 
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">{{trans('comment.STATUS')}}</label>
				{{ trans('comment.'.strtoupper($comment['status'])) }}
			</div>
		</div>
		 

		<div class="col-md-12">
			<div class="form-group">
				<label for="comment">{{trans('comment.COMMENT')}}</label>
				{{ $comment['comment'] }}
			</div>
		</div>
	</div>
 
<?php
view('admin.layouts.footer');
?>