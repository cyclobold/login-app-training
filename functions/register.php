<?php 

/**
 * [registerUser registers a new user]
 * @param  [string] $username [username of the new applicant]
 * @param  [string] $email    [email of the new applicant]
 * @param  [string] $password [password of the new applicant]
 * @return [type]           [description]
 */
function registerUser($username, $email, $password){

	//registering the user..
	//1 checks that the user exists..
	require("database/db_connect.php");


	$response = checkUserIfExists($username, $email);

	if($response == true){
		return "User registered already!";
	}else{

		//register the user
		
		$register_query = "INSERT INTO users(username, email, password, date_registered) VALUES('$username', '$email', '$password', NOW())";

		$register_query_result = mysqli_query($conn, $register_query);

		if($register_query_result){
			//return "User registered successfully!";
			//Create the posts table and 
			//Create the followers table
			//
			
			//1 . Create the posts table
			$new_registered_user_id = mysqli_insert_id($conn);
			//echo $new_registered_user_id;
			$feedback = createUserPostsTable($new_registered_user_id);
			if($feedback == 1){
				return "User registered successfully!";
			}
		}else{

			return "An error occurred";
		}

	}

		
}


/**
 * Creates the posts table for the newly registered user
 * @return [type] [description]
 */
function createUserPostsTable($id){
	require("database/db_connect.php");

	$posts_table = "posts_".$id."_user";
	$create_posts_table_query = "CREATE TABLE IF NOT EXISTS `$posts_table`(
			id INT PRIMARY KEY AUTO_INCREMENT, 
			post_title TEXT(400) NOT NULL,
			post_summary TEXT(400) NULL,
			post_content LONGTEXT NOT NULL,
			date_created TIMESTAMP NOT NULL

	)";

	$create_posts_result = mysqli_query($conn, $create_posts_table_query);

	if($create_posts_result){
		return 1;
	}else{
		return mysqli_error($conn);
	}


}



function checkUserIfExists($username, $email){
	require("database/db_connect.php");

	//use the email and	the username for checking
	$check_user_query = "SELECT * FROM users WHERE username = '$username' || email = '$email' LIMIT 1";


	

	$check_user_result = mysqli_query($conn, $check_user_query);

	if($check_user_result){

		if(mysqli_num_rows($check_user_result) == 1){
			//the user has been registered
			return true;
		}else{
			//there is no match
			return false;
		}

	}else{
		echo "Error";
	}




}