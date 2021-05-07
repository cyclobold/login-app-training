 <?php 



if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(isset($_POST['register'])){

		$errors = [];
		$username = trim($_POST['username']);
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$password_confirm = trim($_POST['password_confirm']);

		if(empty($username)){
			$errors[] = "Please enter username";
		}

		if(empty($email)){
			$errors[] = "Please enter email";
		}

		if(empty($password)){
			$errors[] = "Please enter password";
		}

		if(empty($password_confirm)){
			$errors[] = "Confirm your password";
		}

		if($password != $password_confirm){
			$errors[] = "Two passwords MUST match!";
		}

		if(empty($errors)){

			//proceed 
			require "functions/register.php";

			$feedback = registerUser($username, $email, $password_confirm);

			echo "<div class='alert alert-success'>
			<div class='alert-header'><h5>$feedback</h5></div>
			<p>You need to verify your email.</p></div>";

		}else{

			foreach($errors as $error){
				echo "{$error}<br>";
			}

		}

	}



	if(isset($_POST['login'])){

		$email = trim($_POST['email']);
		$password = trim($_POST['password']);

		require "functions/login.php";

		loginIn($email, $password);

	}





}