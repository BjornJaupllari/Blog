<?php  include('../config.php');
if ( !in_array($_SESSION['user']['role'], ["Admin"])){
	
    header('Location: '. BASE_URL . '/login.php');
    
 } ?>
<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>

<!-- Get all categories from DB -->
<?php $categories = getAllCategories();	?>


	<title>Admin | Manage Categories</title>
</head>
<body>
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

		<!-- Middle form - to create and edit -->
		<div class="action">
			<h1 class="page-title">Create/Edit Categories</h1>
			<form method="post" action="<?php echo BASE_URL . 'admin/categories.php'; ?>" >
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
				<!-- if editing category, the id is required to identify that category -->
				<?php if ($isEditingCategory === true): ?>
					<input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
				<?php endif ?>
				<input type="text" name="category_name" value="<?php echo $category_name; ?>" placeholder="Category">
				<!-- if editing category, display the update button instead of create button -->
				<?php if ($isEditingCategory === true): ?> 
					<button type="submit" class="btn" name="update_category">UPDATE</button>
				<?php else: ?>
					<button type="submit" class="btn" name="create_category">Save Category</button>
				<?php endif ?>
			</form>
		</div>
		<!-- // Middle form - to create and edit -->

		<!-- Display records from DB-->
		<div class="table-div">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/includes/messages.php') ?>
			<?php if (empty($categories)): ?>
				<h1>No categories in the database.</h1>
			<?php else: ?>
				<table class="table">
					<thead>
						<th>No.</th>
						<th>Category Name</th>
						<th colspan="2">Action</th>
					</thead>
					<tbody>
					<?php foreach ($categories as $key => $category): ?>
						<tr>
				
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $category['name']; ?></td>
							<td>
								<a class="fa fa-pencil btn edit"
									href="categories.php?edit-category=<?php echo $category['id'] ?>">
								</a>
							</td>
							<td>
								<a class="fa fa-trash btn delete"								
									href="categories.php?delete-category=<?php echo $category['id'] ?>">
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