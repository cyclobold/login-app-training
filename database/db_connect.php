<?php 
$host = 'localhost';
$user = 'root';
$password = '';
$database_name = "login_app";


$conn = mysqli_connect($host, $user, $password, $database_name) or die("Could not connect to the server at moment..");



if($conn){

	//create the necessary tables if they dont exist...
	//
	//
	//Create users table
	
	$create_users_query = "CREATE TABLE IF NOT EXISTS `users`(
			id INT AUTO_INCREMENT PRIMARY KEY ,
			firstname VARCHAR(32) NULL,
			lastname VARCHAR(32) NULL,
			username VARCHAR(32) NOT NULL,
			email VARCHAR(32) NOT NULL,
			password VARCHAR(128) NOT NULL,
			date_registered TIMESTAMP NOT NULL
	)";

	$create_users_table_result = mysqli_query($conn, $create_users_query);

	if($create_users_table_result){
		echo "Done";
	}else{
		echo mysqli_error($conn);
	}


}
