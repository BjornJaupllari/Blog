<div class="header">
	<div class="logo">
		<a href="<?php echo BASE_URL .'admin/dashboard.php' ?>">
			 <h1>Universe Blog - Admin</h1> 
		</a>
	</div>
	<div class="user-info">
	<span><?php echo $_SESSION['user']['first_name']." ". $_SESSION['user']['last_name'] ?></span> &nbsp; &nbsp; <a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout-btn">Logout</a>
	</div>
</div>