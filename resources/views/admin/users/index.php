<?php
view('admin.layouts.header', ['title'=>trans('admin.USERS')]);

?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> {{ trans('admin.USERS') }}</h2>
		<a class="btn btn-primary" href="{{ url(ADMIN.'/users/create') }}"><i class="fa-solid fa-plus"></i> {{ trans('admin.CREATE') }}</a>
	</div>
	<div class="table-responsive small">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">{{ trans('user.NAME') }}</th>
					<th scope="col">{{ trans('user.EMAIL') }}</th>
					<th scope="col">{{ trans('user.MOBILE') }}</th>
					<th scope="col">{{ trans('user.USER_TYPE') }}</th>
					<th scope="col">{{ trans('admin.ACTION') }}</th>
				</tr>
			</thead>
			<tbody>
				<?php while($user = mysqli_fetch_assoc($users['query'])): ?>
				<tr>
					<td>{{ $user['id'] }}</td>
					<td>{{ $user['name'] }}</td>
					<td>{{ $user['email'] }}</td>
					<td>{{ $user['mobile'] }}</td>
					<td>{{ trans('user.'.strtoupper($user['type'])) }}</td>
					<td>
						<a href="{{ url(ADMIN.'/users/show?id='.$user['id']) }}"><i
								class="fa-regular fa-eye"></i></a>
						<a href="{{ url(ADMIN.'/users/edit?id='.$user['id']) }}"><i
								class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{url(ADMIN.'/users/delete')}}" method="post">
                                    <input type="hidden" name="_method" value="post">
                                    <input type="hidden" name="id" value="{{ $user['id'] }}">
                                    {{ delete_record(url(ADMIN.'/users/delete')) }}   
                                </form>
					</td>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
	{{ $users['render'] }}
 
<?php
view('admin.layouts.footer');
?>