<?php 

 class User{



 	public function __construct(){



 	}

 	public function registerPassword($user_id, $password){
 		require "database/db_connect.php";

 		$user_id = (int)$user_id;

 		$check_id_query = "SELECT * FROM users_old_password WHERE id=$user_id LIMIT 1";

 		$check_id_result = mysqli_query($conn, $check_id_query);

 		if($check_id_result){
 			//the query ran
 			if(mysqli_num_rows($check_id_result) == 1){
 					//there is a match..
 					//retrieve the passwords...
 					
 					$old_passwords = $this->retrive_old_user_passwords($user_id, );


 					//convert to array
 					//add the new password 
 					$old_passwords = json_decode($old_passwords);

 					$old_passwords[] = $password;

 					$old_passwords = json_encode($old_passwords);

 					//update this user's records
 					$update_query = "UPDATE users_old_password SET passwords = '$old_passwords' WHERE id = $user_id LIMIT 1";

 					$update_query_result = mysqli_query($conn, $update_query);

 					if($update_query_result){

 						return 'done_registering_password';

 					}else{

 						return mysqli_error($conn);
 					}
 					

 			}else{

 				$passwords = [];

 				$passwords[] = $password;

 				$passwords = json_encode($passwords);

 				//there is no match..
 				$query = "INSERT INTO users_old_password (user_id, passwords) VALUES($user_id, '$passwords')";

 				$result = mysqli_query($conn, $query);

 				if($result){
 					return 'done_registering_password';
 				}else{
 					return mysqli_error($conn);
 				}

 			}
 		}else{

 			//the query did not run
 		}



 	}


 	private function retrive_old_user_passwords($user_id){

 			require "database/db_connect.php";

 			$query = "SELECT * FROM user_old_password WHERE user_id = $user_id LIMIT 1";

 			$result = mysqli_query($conn, $query);

 			$result = mysqli_fetch_array($result, MYSQLI_ASSOC);

 			return $result;


 	}



 	public function redirectUser($page = null){

 		echo "<script>
 					localStorage.setItem('show-signup', JSON.stringify('true'));
 			</script>";


 		Page::redirectPage($page);



 	}


 	public function loginUserWithEmail($email){
 		//

 	}



	public function verifyEmail($email){
		require "database/db_connect.php";


		//$email = mysqli_real_escape_string($conn, trim($email));

		$query = "SELECT * FROM users WHERE email='$email' LIMIT 1";

		$result = mysqli_query($conn, $query);

		if($result){

			if(mysqli_num_rows($result) == 1){
				//there is a match
				//change to 'verified'
				$update_query = "UPDATE users SET is_verified='verified' WHERE email = '$email' LIMIT 1";

				if(mysqli_query($conn, $update_query)){

					return true;

				}else{
					return false;
				}
			}


		}else{	
			//the query did not run
			return false;
		}

		return false;
		
	}



}



$user = new User();