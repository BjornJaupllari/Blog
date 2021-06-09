<head>	
	<?php  include('config.php'); ?>
	<?php  include('includes/public_functions.php'); ?>
	<?php 
		if (isset($_GET['post-slug'])) {
			$post = getPost($_GET['post-slug']);
			$related_posts  = array();
		}
		$categories = getAllCategories();
	?>
 
	<?php include('includes/head_section.php'); ?>
	<title> <?php echo $post['title'] ?> | UniverseBlog</title>
</head>
<body>
	<div class="container">
		<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
		<!-- // Navbar -->
	
		<div class="content" >
		<!-- Page wrapper -->
			<div class="post-wrapper">
			<!-- full post div -->
				<div class="full-post-div">
					<?php if ($post['published'] == false): ?>
					<h2 class="post-title">Sorry... This post has not been published</h2>
					<?php else: ?>

					<?php foreach (getRelatedPostsByCategory($post['category']['id'], $post['id']) as $relatedpost): ?>

					<?php array_push($related_posts, $relatedpost); ?>
					<?php endforeach ?>

                	<h2 class="post-title"><?php echo $post['title']; ?></h2>
               
					<div class="post-body-div">
						<span><?php echo date("F j, Y ", strtotime($post["created_at"])); ?> by <?php echo $post['first_name']." ".$post['last_name'] ?></span>
                		<div class="container-fluid"> <img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt=""></div>
						<?php echo html_entity_decode($post['body']); ?>
					</div>
					<?php endif ?>
				</div>
				<!-- // full post  -->
				<!--Related posts-->
				<div class="container">
					<h2 class="content-title">Related Articles</h2>
					<?php if(empty($related_posts)): ?>
					<?php echo "No related articles.";?>
					<?php else: ?>
					<?php foreach ($related_posts as $post): ?>
					<!-- <?php if(array_search($post,array_keys($related_posts))==0): ?>
					<?php endif ?> -->
					<div class="post" style="margin-left: 0px;">
						<img src="<?php echo BASE_URL . '/static/images/' . $post['image']; ?>" class="post_image" alt="">
		
						<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
						<div class="post_info">
							<h3><?php echo $post['title'] ?></h3>
							<div class="info">
								<span><i class="fa fa-clock-o"></i><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
					
								<h5 class="summary"><?php echo $post['summary']?></h5>
					
							</div>
							<h4 class="read_more">Read more...</h4>
						</div>
						</a>
					</div>
					<?php endforeach ?>
					<?php endif ?>
				</div>
				<!--end Related posts-->
				<!-- comments section -->
			</div>
			<!-- // Page wrapper -->
			<!-- post sidebar -->
			<div class="post-sidebar">
				<div class="card">
					<div class="card-header">
						<h2>Categories</h2>
					</div>
					<div class="card-content">
						<?php foreach ($categories as $category): ?>
						<a href="<?php echo BASE_URL . 'filtered_posts.php?category=' . $category['id'] ?>">
						<?php echo $category['name']; ?>
						</a> 
						<?php endforeach ?>
					</div>
				</div>
			</div>
			<!-- // post sidebar -->
		</div>
	</div>
	<!-- // content -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
</body>