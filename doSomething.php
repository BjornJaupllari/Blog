<?php  include('config.php'); ?>
<?php 
    if ( in_array($_SESSION['user']['role'], ["Admin"])) {
                            
        // redirect to admin area
        header('location: ' . BASE_URL . 'admin/dashboard.php');
        exit(0);
    } 
    else {
        // redirect to author area
        header('location: ' . BASE_URL . 'author/posts.php');
        exit(0);
    }
?>