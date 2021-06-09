<head>
	<?php require_once('config.php') ?>
	<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>

	<!-- Retrieve all posts from database  -->
	<?php $posts = getPublishedPosts(); ?>
	<?php require_once(ROOT_PATH.'/includes/head_section.php') ?>
	<title>UniverseBlog | Home </title>
</head>
<body>
	<!-- container - wraps whole page -->
	<div class="container-fluid">
		<!-- navbar -->
		<?php include( ROOT_PATH .'/includes/navbar.php') ?>
		<!-- // navbar -->
		
		

		<!-- banner-->
		<?php include( ROOT_PATH .'/includes/banner.php') ?>
		<!-- Page content -->
		<div class="content">
			<h2 class="content-title">Recent Articles</h2>
			<hr>

			<?php foreach ($posts as $post): ?>
			<div class="post" style="margin-left: 0px;">
				<img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
				<?php if (isset($post['category']['name'])): ?>
				<a href="<?php echo BASE_URL . 'filtered_posts.php?category=' . $post['category']['id'] ?>" class="btn category">
				<?php echo $post['category']['name'] ?>
				</a>
				<?php endif ?>
				<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
				<div class="post_info">
					<h3><?php echo $post['title'] ?></h3>
					<div class="info">
						<span><i class="fa fa-clock-o"></i><?php echo date("F j, Y ", strtotime($post["created_at"])); ?> by <?php echo $post['first_name']." ".$post['last_name'] ?></span>
						<h5 class="summary"><?php echo $post['summary']?></h5>
					</div>
					<h4 class="read_more">Read more...</h4>
				</div>
				</a>
			</div>
			<?php endforeach ?>
		</div>
		<!-- // Page content -->
	</div>
	<!-- footer -->
	<?php include( ROOT_PATH .'/includes/footer.php') ?>
</body>