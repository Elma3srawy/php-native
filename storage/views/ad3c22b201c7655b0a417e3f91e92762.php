<?php
view('admin.layouts.header', ['title'=>trans('admin.NEWS')]);
?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> <?php echo  trans('admin.NEWS') ;?></h2>
		<a class="btn btn-primary" href="<?php echo  url(ADMIN.'/news/create') ;?>"><i class="fa-solid fa-plus"></i><?php echo  trans('admin.CREATE') ;?></a>
	</div>
	<div class="table-responsive small">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col"><?php echo  trans('news.TITLE') ;?></th>
					<th scope="col"><?php echo  trans('news.USER_ID') ;?></th>
					<th scope="col"><?php echo  trans('news.CATEGORY_ID') ;?></th>
					<th scope="col"><?php echo  trans('news.IMAGE') ;?></th>
					 
					<th scope="col"><?php echo  trans('admin.CREATED_AT') ;?></th>
					<th scope="col"><?php echo  trans('admin.UPDATED_AT') ;?></th>
					<th scope="col"><?php echo  trans('admin.ACTION') ;?></th>
				</tr>
			</thead>
			<tbody>
				<?php while($news = mysqli_fetch_assoc($news_list['query'])): ?>
				<tr>
					<td><?php echo  $news['id'] ;?></td>
					<td><?php echo  $news['title'] ;?></td>
					<td> 
					<a href="<?php echo  url('users/show?id='.$news['user_id']) ;?>"><?php echo  $news['username'] ;?></a>
					</td>
					<td>
						<a href="<?php echo  url(ADMIN.'/categories/show?id='.$news['category_id']) ;?>"><?php echo  $news['category_name'] ;?></a>
					</td>
					<td>
						<?php echo  show_image(storage_url($news['image'])) ;?>
					</td>
					 
				
					<td><?php echo  $news['created_at'] ;?></td>
					<td><?php echo  $news['updated_at'] ;?></td>
					<td>

						<a href="<?php echo  url(ADMIN.'/news/show?id='.$news['id']) ;?>"><i
								class="fa-regular fa-eye"></i></a>
						<a href="<?php echo  url(ADMIN.'/news/edit?id='.$news['id']) ;?>"><i
								class="fa-solid fa-pen-to-square"></i></a>
                        <form action="<?php echo  url(ADMIN . '/news/delete') ;?>" method="post">
                            <input type="hidden" name="_method" value="post">
                            <input type="hidden" name="id" value="<?php echo  $news['id'] ;?>">
                            <?php echo  delete_record(url(ADMIN.'/new/delete')) ;?>
                        </form>
					</td>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
	<?php echo  $news_list['render'] ;?>
 
<?php
view('admin.layouts.footer');
?>