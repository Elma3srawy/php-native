<?php

if(is_null($user)){
    return redirect(ADMIN.'/users');
}

view('admin.layouts.header', ['title'=>trans('admin.USERS').'-'.trans('admin.SHOW')]);
?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> {{ trans('admin.USERS') }} - {{ trans('admin.SHOW') }} #{{ $user['name'] }}</h2>
		<a class="btn btn-info" href="{{ url(ADMIN.'/users') }}">{{ trans('admin.USERS') }}</a>
	</div>
 

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">{{trans('user.NAME')}}</label>
				{{ $user['name'] }}
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="form-group">
				<label for="description">{{trans('user.EMAIL')}}</label>
				{{ $user['email'] }}
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="description">{{trans('user.MOBILE')}}</label>
				{{ $user['mobile'] }}
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="description">{{trans('user.USER_TYPE')}}</label>
				{{ trans('user.'.strtoupper($user['type'])) }}
			</div>
		</div>
	</div>

 
<?php
view('admin.layouts.footer');
?>