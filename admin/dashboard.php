<?php  include('../config.php');
 if ( !in_array($_SESSION['user']['role'], ["Admin"])){
	
    header('Location: '. BASE_URL . '/login.php');
    
 }
?>
	<?php include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
	<?php include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
	<?php include(ROOT_PATH . '/admin/includes/head_section.php'); 
	$usersNumber = getNumberOfUsers();
	$postsNumber = getNumberOfPublishedPosts();
	?>
	<title>Admin | Dashboard</title>
</head>
<body>
	<div class="header">
		<div class="logo">
			<a href="<?php echo BASE_URL .'admin/dashboard.php' ?>">
				<h1>Universe Blog - Admin</h1>
			</a>
		</div>
		<?php if (isset($_SESSION['user'])): ?>
			<div class="user-info">
				<span><?php echo $_SESSION['user']['first_name']." ". $_SESSION['user']['last_name'] ?></span> &nbsp; &nbsp; 
				<a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout-btn">Logout</a>
			</div>
		<?php endif ?>
	</div>
	<div class="container dashboard">
		<h1>Welcome</h1>
        
		<div class="stats">
        <div class="row">
        <div class="col-md-6">
			<a href="users.php" class="first">
				<span><?php echo $usersNumber ?></span> <br>
				<span>Registered users</span>
			</a>
            </div>
            <div class="col-md-6">
			<a href="posts.php">
				<span><?php echo $postsNumber ?></span> <br>
				<span>Published posts</span>
			</a>
            </div>
            <div class="col-md-4">
			
            </div>
		</div>
		<br><br><br>
		
    </div>
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-6">
    <div class="buttons">
			<a href="users.php">Add Users</a>
			<a href="posts.php">Add Posts</a>
        </div>
        </div>
        <div class="col-md-2"> </div>
    </div>
   
    
    </div>
</body>
</html>