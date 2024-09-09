<?php
view('admin.layouts.header', ['title'=>trans('admin.CATEGORIES')]);

?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> <?php echo  trans('admin.CATEGORIES') ;?></h2>
		<a class="btn btn-primary" href="<?php echo  url('admin/categories/create') ;?>"><i class="fa-solid fa-plus"></i> <?php echo  trans('admin.CREATE') ;?></a>
	</div>
	<div class="table-responsive small">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col"><?php echo  trans('cat.NAME') ;?></th>
					<th scope="col"><?php echo  trans('cat.ICON') ;?></th>
					<th scope="col"><?php echo  trans('cat.DESC') ;?></th>
					<th scope="col"><?php echo  trans('admin.ACTION') ;?></th>
				</tr>
			</thead>
			<tbody>
            <?php while($category = mysqli_fetch_assoc($categories['query'])): ?>
				<tr>
					<td><?php echo  $category['id'] ;?></td>
					<td><?php echo  $category['name'] ;?></td>
					<td>
						<?php echo  show_image(storage_url($category['icon'])) ;?>

					</td>
					<td><?php echo  $category['description'] ;?></td>
					<td>

						<a href="<?php echo  url(ADMIN.'/categories/show?id='.$category['id']) ;?>"><i
								class="fa-regular fa-eye"></i></a>
						<a href="<?php echo  url(ADMIN.'/categories/edit?id='.$category['id']) ;?>"><i
								class="fa-solid fa-pen-to-square"></i></a>
                        <form action="<?php echo  url(ADMIN . '/categories/delete') ;?>" method="post">
                            <input type="hidden" name="_method" value="post">
                            <input type="hidden" name="id" value="<?php echo  $category['id'] ;?>">
                            <?php echo  delete_record(url(ADMIN.'/categories/delete')) ;?>
                        </form>
					</td>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
    <?php echo  $categories['render'] ;?>

<?php
view('admin.layouts.footer');
?>