<?php
view('admin.layouts.header', ['title'=>trans('admin.COMMENTS')]);

?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> {{ trans('admin.COMMENTS') }}</h2>
	 
	</div>
	<div class="table-responsive small">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">{{ trans('comment.NEWS') }}</th>
					<th scope="col">{{ trans('comment.NAME') }}</th>
					<th scope="col">{{ trans('comment.EMAIL') }}</th>
					<th scope="col">{{ trans('comment.COMMENT') }}</th>
					<th scope="col">{{ trans('comment.STATUS') }}</th>
					<th scope="col">{{ trans('admin.ACTION') }}</th>
				</tr>
			</thead>
			<tbody>
				<?php while($comment = mysqli_fetch_assoc($comments['query'])): ?>
                    <tr>
					<td>{{ $comment['id'] }}</td>
					<td>{{ $comment['title'] }}</td>
					<td>{{ $comment['name'] }}</td>
					<td>{{ $comment['email'] }}</td>
					<td>{{ $comment['comment'] }}</td>
					<td>{{ trans('comment.'.strtoupper($comment['status'])) }}</td>
					<td>

						<a href="{{ url(ADMIN.'/comments/show?id='.$comment['id']) }}"><i
								class="fa-regular fa-eye"></i></a>
						<a href="{{ url(ADMIN.'/comments/edit?id='.$comment['id']) }}"><i
								class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ url(ADMIN.'/comments/delete') }}" method="post">
                                    <input type="hidden" name="id" value="{{ $comment['id'] }}">
                                    {{ delete_record(url(ADMIN.'/comments/delete')) }}   
                                </form>
					</td>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
	{{ $comments['render'] }}
 
<?php
view('admin.layouts.footer');
?>