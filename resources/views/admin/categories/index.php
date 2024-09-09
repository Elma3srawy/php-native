<?php
view('admin.layouts.header', ['title'=>trans('admin.CATEGORIES')]);

?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> {{ trans('admin.CATEGORIES') }}</h2>
		<a class="btn btn-primary" href="{{ url('admin/categories/create') }}"><i class="fa-solid fa-plus"></i> {{ trans('admin.CREATE') }}</a>
	</div>
	<div class="table-responsive small">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">{{ trans('cat.NAME') }}</th>
					<th scope="col">{{ trans('cat.ICON') }}</th>
					<th scope="col">{{ trans('cat.DESC') }}</th>
					<th scope="col">{{ trans('admin.ACTION') }}</th>
				</tr>
			</thead>
			<tbody>
            <?php while($category = mysqli_fetch_assoc($categories['query'])): ?>
				<tr>
					<td>{{ $category['id'] }}</td>
					<td>{{ $category['name'] }}</td>
					<td>
						{{ show_image(storage_url($category['icon'])) }}

					</td>
					<td>{{ $category['description'] }}</td>
					<td>

						<a href="{{ url(ADMIN.'/categories/show?id='.$category['id']) }}"><i
								class="fa-regular fa-eye"></i></a>
						<a href="{{ url(ADMIN.'/categories/edit?id='.$category['id']) }}"><i
								class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ url(ADMIN . '/categories/delete') }}" method="post">
                            <input type="hidden" name="_method" value="post">
                            <input type="hidden" name="id" value="{{ $category['id'] }}">
                            {{ delete_record(url(ADMIN.'/categories/delete')) }}
                        </form>
					</td>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
    {{ $categories['render'] }}

<?php
view('admin.layouts.footer');
?>