<?php
view('admin.layouts.header', ['title'=>trans('admin.USERS')]);

?>

	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> {{ trans('admin.USERS') }} - {{ trans('admin.CREATE') }}</h2>
		<a class="btn btn-info" href="{{ url(ADMIN.'/users') }}">{{ trans('admin.USERS') }}</a>
	</div>

 
	<form method="post" action="{{url(ADMIN.'/users/store')}}" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="post" />
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="name">{{trans('user.NAME')}}</label>
					<input type="text" name="name" placeholder="{{trans('user.NAME')}}"
						class="form-control {{ !empty(get_error('name'))?'is-invalid':'' }}"/>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="email">{{trans('user.EMAIL')}}</label>
					<input type="text" name="email" placeholder="{{trans('user.EMAIL')}}"
						class="form-control {{ !empty(get_error('email'))?'is-invalid':'' }}"/>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="password">{{trans('user.PASSWORD')}}</label>
					<input type="password" name="password" placeholder="{{trans('user.PASSWORD')}}"
						class="form-control {{ !empty(get_error('password'))?'is-invalid':'' }}" />
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="mobile">{{trans('user.MOBILE')}}</label>
					<input type="text" name="mobile" placeholder="{{trans('user.MOBILE')}}"
						class="form-control {{ !empty(get_error('mobile'))?'is-invalid':'' }}" />
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="user_type">{{trans('user.USER_TYPE')}}</label>

					<select class="form-select {{ !empty(get_error('type'))?'is-invalid':'' }}" name="type">
						<option disabled selected>{{trans('admin.CHOOSE')}}</option>
						<option value="user">{{trans('user.USER')}}
						</option>
						<option value="admin">{{trans('user.ADMIN')}}
						</option>
					</select>

				</div>
			</div>

		</div>
		<input type="submit" class="btn btn-success" value="{{trans('admin.CREATE')}}" />
	</form>

<?php
view('admin.layouts.footer');
?>