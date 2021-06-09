<?php 
	session_start();
	// connect to database
    $db = "nensi-blog";
    $dbserver = "localhost";
    $username = "root";
    $password = "";
     
    try {
        $conn = new PDO("mysql:host=$dbserver;dbname=$db", $username, $password);
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
        die();
    }
	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/nensi-blog1/');
?>