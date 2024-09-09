<?php
view('admin.layouts.header', ['title'=>trans('admin.NEWS')]);
?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> {{ trans('admin.NEWS') }}</h2>
		<a class="btn btn-primary" href="{{ url(ADMIN.'/news/create') }}"><i class="fa-solid fa-plus"></i>{{ trans('admin.CREATE') }}</a>
	</div>
	<div class="table-responsive small">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">{{ trans('news.TITLE') }}</th>
					<th scope="col">{{ trans('news.USER_ID') }}</th>
					<th scope="col">{{ trans('news.CATEGORY_ID') }}</th>
					<th scope="col">{{ trans('news.IMAGE') }}</th>
					 
					<th scope="col">{{ trans('admin.CREATED_AT') }}</th>
					<th scope="col">{{ trans('admin.UPDATED_AT') }}</th>
					<th scope="col">{{ trans('admin.ACTION') }}</th>
				</tr>
			</thead>
			<tbody>
				<?php while($news = mysqli_fetch_assoc($news_list['query'])): ?>
				<tr>
					<td>{{ $news['id'] }}</td>
					<td>{{ $news['title'] }}</td>
					<td> 
					<a href="{{ url('users/show?id='.$news['user_id']) }}">{{ $news['username'] }}</a>
					</td>
					<td>
						<a href="{{ url(ADMIN.'/categories/show?id='.$news['category_id']) }}">{{ $news['category_name'] }}</a>
					</td>
					<td>
						{{ show_image(storage_url($news['image'])) }}
					</td>
					 
				
					<td>{{ $news['created_at'] }}</td>
					<td>{{ $news['updated_at'] }}</td>
					<td>

						<a href="{{ url(ADMIN.'/news/show?id='.$news['id']) }}"><i
								class="fa-regular fa-eye"></i></a>
						<a href="{{ url(ADMIN.'/news/edit?id='.$news['id']) }}"><i
								class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ url(ADMIN . '/news/delete') }}" method="post">
                            <input type="hidden" name="_method" value="post">
                            <input type="hidden" name="id" value="{{ $news['id'] }}">
                            {{ delete_record(url(ADMIN.'/new/delete')) }}
                        </form>
					</td>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
	{{ $news_list['render'] }}
 
<?php
view('admin.layouts.footer');
?>