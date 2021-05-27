<?php 
$host = 'localhost';
$user = 'root';
$db_password = 'root';
$database_name = "login_app";


$conn = mysqli_connect($host, $user, $db_password, $database_name) or die("Could not connect to the server at moment..");



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
			is_verified VARCHAR(18) NOT NULL DEFAULT 'not_verified',
			login_attempt INT NOT NULL DEFAULT 0,
			verification_link VARCHAR(128) NULL,
			date_registered TIMESTAMP NOT NULL
	)";

	$create_users_table_result = mysqli_query($conn, $create_users_query);

	if($create_users_table_result){
		//echo "Done";
	}else{
		//echo mysqli_error($conn);
	}



	//Users old password table
	$create_users_password_query = "CREATE TABLE IF NOT EXISTS `users_old_password`(

			id INT AUTO_INCREMENT PRIMARY KEY,
			user_id INT NOT NULL,
			passwords TEXT(5000) NOT NULL,
			date_updated TIMESTAMP NOT NULL
		)";

	$create_users_passwords = mysqli_query($conn, $create_users_password_query);

	if($create_users_passwords){
		//echo 'done creating passwords table';
	}else{
		echo mysqli_error($conn);
	}



}
