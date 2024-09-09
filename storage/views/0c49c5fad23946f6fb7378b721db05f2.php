<?php
view('admin.layouts.header', ['title'=>trans('admin.COMMENTS')]);

?>
 
	<div
		class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2> <?php echo  trans('admin.COMMENTS') ;?></h2>
	 
	</div>
	<div class="table-responsive small">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col"><?php echo  trans('comment.NEWS') ;?></th>
					<th scope="col"><?php echo  trans('comment.NAME') ;?></th>
					<th scope="col"><?php echo  trans('comment.EMAIL') ;?></th>
					<th scope="col"><?php echo  trans('comment.COMMENT') ;?></th>
					<th scope="col"><?php echo  trans('comment.STATUS') ;?></th>
					<th scope="col"><?php echo  trans('admin.ACTION') ;?></th>
				</tr>
			</thead>
			<tbody>
				<?php while($comment = mysqli_fetch_assoc($comments['query'])): ?>
                    <tr>
					<td><?php echo  $comment['id'] ;?></td>
					<td><?php echo  $comment['title'] ;?></td>
					<td><?php echo  $comment['name'] ;?></td>
					<td><?php echo  $comment['email'] ;?></td>
					<td><?php echo  $comment['comment'] ;?></td>
					<td><?php echo  trans('comment.'.strtoupper($comment['status'])) ;?></td>
					<td>

						<a href="<?php echo  url(ADMIN.'/comments/show?id='.$comment['id']) ;?>"><i
								class="fa-regular fa-eye"></i></a>
						<a href="<?php echo  url(ADMIN.'/comments/edit?id='.$comment['id']) ;?>"><i
								class="fa-solid fa-pen-to-square"></i></a>
                                <form action="<?php echo  url(ADMIN.'/comments/delete') ;?>" method="post">
                                    <input type="hidden" name="id" value="<?php echo  $comment['id'] ;?>">
                                    <?php echo  delete_record(url(ADMIN.'/comments/delete')) ;?>   
                                </form>
					</td>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
	<?php echo  $comments['render'] ;?>
 
<?php
view('admin.layouts.footer');
?>