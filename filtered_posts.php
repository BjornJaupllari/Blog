<head>
	<?php include('config.php'); ?>
	<?php include('includes/public_functions.php'); ?>
	<?php include('includes/head_section.php'); ?>
	<?php 
		// Get posts under a particular topic
		if (isset($_GET['category'])) {
			$category_id = $_GET['category'];
			$posts = getPublishedPostsByCategory($category_id);
		}
	?>
	<title>Universe Blog | Home </title>
</head>
<body>
	<div class="container">
		<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
		<!-- // Navbar -->
		<!-- content -->
		<div class="content">
			<h2 class="content-title">Articles on <u><?php echo getCategoryNameById($category_id); ?></u></h2>
			<hr>
			<?php foreach ($posts as $post): ?>
			<div class="post" style="margin-left: 0px;">
				<img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
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
		<!-- // content -->
	</div>
	<!-- // container -->
	<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
	<!-- // Footer -->
</body>	