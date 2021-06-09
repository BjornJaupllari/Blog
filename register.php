<head>
    <?php  include('config.php'); ?>
    <?php
        $errors = array();
        if(isset($_POST['btnRegister'])) {
		    // Get data from FROM
            $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
		    $password1 = trim($_POST['password1']);
            $password2 = trim($_POST['password2']);
            //ensure fields are not empty
		    if (empty($first_name)) {  array_push($errors, "What's your name?"); }
	    	if (empty($last_name)) {  array_push($errors, "What's your surname?"); }
    		if (empty($username)) {  array_push($errors, "Uhmm...We gonna need your username"); }
		    if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
	    	if (empty($password1)) { array_push($errors, "Uh-oh you forgot the password"); }
    		if ($password1 != $password2) { array_push($errors, "The two passwords do not match");}
        
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
            $result = $conn->query($user_check_query);
            $user=$result->fetch(PDO::FETCH_ASSOC);
            if ($user) { // if user exists
			    if ($user['username'] === $username) {
		    	    array_push($errors, "Username already exists");
	    		}
    			if ($user['email'] === $email) {
			        array_push($errors, "Email already exists");
			    }
            }
            // register user if there are no errors in the form
	    	if (empty($errors)) {
    			$password = md5($password1);//encrypt the password before saving in the database

			    try {    
		    		$stmt = $conn->prepare("INSERT INTO users ( username, first_name, last_name, email, role, password, cr_at,update_at) VALUES ('$username', '$first_name', '$last_name', '$email',  'Author', '$password', now(),now())");
	    			$stmt->execute();
    				header('Location: register.php?action=joined');
				    exit;
			    }
			    catch(PDOException $e) {
				    array_push($errors,$e->getMessage());
			    }
		    }
	    }

	    if(isset($_GET['action']) && $_GET['action'] == 'joined') {
            echo '<div class="alert alert-success" role="alert">
            Registration successful. Now you can <a href="login.php">Login</a>
            </div>';
	    }
    ?>
    <?php include('includes/head_section.php'); ?>

    <title>UniverseBlog | Sign up </title>
</head>
<body>
    <div class="container">
	    <!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	    <!-- // Navbar -->

	    <div class="row">
            <div class="col-md-3"> </div>
            <div class="col-md-5 well">
                <h4>Register on UniverseBlog</h4>
                <?php include(ROOT_PATH . '/includes/errors.php') ?>
            
                <form action="register.php" method="post">
                    <div class="form-group">
                        <label for="">First Name</label>
                        <input type="text" name="first_name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" name="last_name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password1" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="">Password Confirmation</label>
                        <input type="password" name="password2" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="btnRegister" class="btn btn-primary" value="Register"/>
                    </div>
                    <p>Already a member? <a href="login.php">Log in</a></p>
                </form>
            </div>
        </div>
    </div>
    <!-- // container -->
    <!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
    <!-- // Footer -->
</body>