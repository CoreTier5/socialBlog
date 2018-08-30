<?php 
	require_once(__DIR__.'/../iniseterror.php');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'phpsession01'); 
	define('DB_USER','root'); 
	define('DB_PASSWORD','toor'); 
	// database connectivity
	try {
    	$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',DB_USER, DB_PASSWORD);
	} catch(PDOException $ex) {
	    echo "Failed to connect the database. Expected error: ".$ex->getMessage();
	}
?>