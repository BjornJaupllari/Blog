<?php if (isset($_SESSION['user']['username'])) { ?>
	<div class="logged_in_info">
		<span>Welcome <?php echo $_SESSION['user']['first_name'] ?></span> 
		<span><a href="doSomething.php">Profil</a></span>	
		|
		<span><a href="logout.php">logout</a></span>
	</div>
<?php }else{ ?>
	<div class="jumbotron jumbotron-fluid">

	</div>
<?php } ?>