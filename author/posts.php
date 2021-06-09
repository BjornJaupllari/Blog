<?php  include('../config.php');
 if ( !in_array($_SESSION['user']['role'], ["Author"])){
	
    header('Location: '. BASE_URL . '/login.php');
    
 }
?>

<?php  include(ROOT_PATH . '/author/includes/author_functions.php'); ?>
<?php  include(ROOT_PATH . '/author/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/author/includes/head_section.php'); ?>

<!-- Get all admin posts from DB -->
<?php $posts = getAllPosts(); ?>
	<title>Author | Manage Posts</title>
</head>
<body>
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/author/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/author/includes/menu.php') ?>

		<!-- Display records from DB-->
		<div class="table-div"  style="width: 80%;">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/includes/messages.php') ?>

			<?php if (empty($posts)): ?>
				<h1 style="text-align: center; margin-top: 20px;">No posts in the database.</h1>
			<?php else: ?>
				<table class="table">
						<thead>
						<th>No.</th>
						<th>Author</th>
						<th>Title</th>
						
						<!-- Only Admin can publish/unpublish post -->
						<?php if ($_SESSION['user']['role'] == "Admin"): ?>
							<th><small>Publish</small></th>
						<?php endif ?>
						<th><small>Edit</small></th>
						<th><small>Delete</small></th>
					</thead>
					<tbody>
					<?php foreach ($posts as $key => $post): ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $post['author']; ?></td>
							<td>
								<a 	target="_blank"
								href="<?php echo BASE_URL . 'single_post.php?post-slug=' . $post['slug'] ?>">
									<?php echo $post['title']; ?>	
								</a>
							</td>
							
							
							<!-- Only Admin can publish/unpublish post -->
							
								<td>
								<?php if ($post['published'] == true): ?>
									<a class="fa fa-check btn unpublish"
										href="posts.php?unpublish=<?php echo $post['id'] ?>">
									</a>
								<?php else: ?>
									<a class="fa fa-times btn publish"
										href="posts.php?publish=<?php echo $post['id'] ?>">
									</a>
								<?php endif ?>
								</td>
							

							<td>
								<a class="fa fa-pencil btn edit"
									href="create_post.php?edit-post=<?php echo $post['id'] ?>">
								</a>
							</td>
							<td>
								<a  class="fa fa-trash btn delete" 
									href="create_post.php?delete-post=<?php echo $post['id'] ?>">
								</a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>
		</div>
		<!-- // Display records from DB -->
	</div>
</body>
</html>