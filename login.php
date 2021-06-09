<head>
    <?php  include('config.php'); ?>
    <?php
        $errors = array();
	    if(isset($_POST['btnLogin'])) {
            // Get data from FORM
		    $username = trim($_POST['username']);
	    	$password = trim($_POST['password']);

            if(empty($username)){
                array_push($errors, "Enter username");
            }
            if(empty($password)){
                array_push($errors, "Enter password");
            }
		    if (empty($errors)) {
	    		try {
                    $password = md5($password);
                    $stmt = $conn->prepare("SELECT * FROM users WHERE username = '$username' AND password = '$password' AND is_deleted=0 LIMIT 1");
                
				    $stmt->execute();
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);
                    $result = $conn->query("SELECT * FROM users WHERE username= '$username' AND password = '$password' AND is_deleted=0");
                    $count=$count=$result->rowCount();
                    if($count<=0) {
                        array_push($errors, "Wrong credentials.");
                        //header('location: login.php');	
                    }
    			    else if($count>0) {
                        $user_id = $data['user_id'];
                        $_SESSION['user']=getUserById($user_id);
						
                        if ( in_array($_SESSION['user']['role'], ["Admin"])) {
                            $_SESSION['message'] = "You are now logged in";
                            // redirect to admin area
                            header('location: index.php');
                            exit(0);
                        } 
                        else {
                            $_SESSION['message'] = "You are now logged in";
                            // redirect to author area
                            header('location: index.php');
                            exit(0);
                        }
                    }
                }
                catch(PDOException $e) {
                    array_push($errors,  $e->getMessage());
                }
            }
        }
        // Get user info from user id
	    function getUserById($id){
            global $conn;
            if(!empty($id)){
	    	    $sql = "SELECT * FROM users WHERE user_id=$id LIMIT 1";
    		    $result =$conn->query($sql);
	    	    $user = $result->fetch(PDO::FETCH_ASSOC);
            }
            else{
                array_push($errors, "Wrong credentials.");
            }
    	    // returns user in an array format: 
		    return $user; 
        }
	?>
    <?php  include('includes/head_section.php'); ?>
	<title>UniverseBlog | Login </title>
</head>
<body>
    <?php include( ROOT_PATH .'/includes/navbar.php') ?>

    <div class="row">
        <div class="col-md-3"> </div>
        <div class="col-md-5 well">
            <h4>Login</h4>
            <?php include(ROOT_PATH . '/includes/errors.php') ?>
           
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control"/>
                </div>
                <div class="form-group">
                    <input type="submit" name="btnLogin" class="btn btn-primary" value="Login"/>
                </div>
				<p>Not a member yet? <a href="register.php">Register</a></p>
            </form>
        </div>
    </div>
</body>
<?php include( ROOT_PATH .'/includes/footer.php') ?>