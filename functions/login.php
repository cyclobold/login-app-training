<?php 


function loginIn($email, $password){
	//check if this user can even make attempt to login
		
	$feedback = check_login_attempt($email);

	if($feedback){
		//echo "This user can still login";
		$login_feedback = continue_login($email, $password, $feedback);

		if($feedback['login_attempt'] < 3){
			$attempt_remaining = 2 - $feedback['login_attempt'];
		}

		


		if($login_feedback == "validated"){
			echo "Wrong Password used. You have {$attempt_remaining} left.";
		}


	}else{
		echo "This user cannot login";
	}


}


function continue_login($email, $password, $user_data){
	require("database/db_connect.php");

	$query = "SELECT * FROM users WHERE email='$email' AND password = '$password' LIMIT 1";

	$result = mysqli_query($conn, $query);

	if($result){

		//query ran
		if(mysqli_num_rows($result) != 1){
			//there is no match
			//add 1 to the login_attempt
			$login_attempt = $user_data['login_attempt'];

			$login_attempt = $login_attempt + 1;

			//update the table
			$update_query = "UPDATE users SET login_attempt = $login_attempt WHERE email = '$email' LIMIT 1";

			$update_result = mysqli_query($conn, $update_query);

			if($update_result){
				return "validated";
			}else{
				return "internal error";
			}
		}else{
			//there is match..
			//log the user in

		}


	}else{

		//query did not run
		echo "ERROR: ".mysqli_error($conn);
	}


}



function check_login_attempt($email){

	require("database/db_connect.php");


	$query = "SELECT * FROM users WHERE email='$email' AND login_attempt < 3";

	$result = mysqli_query($conn, $query);

	if($result){

		if(mysqli_num_rows($result) == 1){
			//there is a match
			//
			$user_details = mysqli_fetch_array($result, MYSQLI_ASSOC);

			return $user_details;
		}else{
			return null;
		}

	}else{
		//the query did not run
		echo "Error: ".mysqli_error($conn);
		return null;
	}


	

}