<?php 
ini_set("display_errors", "on");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



/**
 * [registerUser registers a new user]
 * @param  [string] $username [username of the new applicant]
 * @param  [string] $email    [email of the new applicant]
 * @param  [string] $password [password of the new applicant]
 * @return [type]           [description]
 */
function registerUser($username, $email, $password){
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';



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
			$new_registered_user_id = mysqli_insert_id($conn);
			require_once "Classes/User.php";
			//Add the user's password to the old passwords table
			$user->registerPassword($new_registered_user_id, $password);
			
			//1 . Create the posts table
			
			//echo $new_registered_user_id;
			$feedback = createUserPostsTable($new_registered_user_id);



			if($feedback == 1){
				//"User registered successfully!";
				//1. create a verification link
				//2. store the verfification in the database..
				//3. send the verification link to the user's email
				
				//url of the site is login-app.test
				//get the url from the host
				$url = $_SERVER['HTTP_HOST'];

				//$link = "http://".$url."/verify.php?em={$email}";
				$link = "http://localhost:8888/login-app/verify.php?em=${email}";

				//Send an email to the user
				$mail = new PHPMailer(true);

				try {
				    //Server settings
				    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
				    $mail->isSMTP();                                            //Send using SMTP
				    $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
				    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				    $mail->Username   = '2f76ed5c75f26a';                     //SMTP username
				    $mail->Password   = 'a9eb09efea59aa';                               //SMTP password
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
				    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

				    //Recipients
				    $mail->setFrom('no-reply@login-app.com', 'Thank You');
				    $mail->addAddress($email, 'User');     //Add a recipient

				    //$mail->addReplyTo('info@example.com', 'Information');
				    //$mail->addCC('cc@example.com');
				    //$mail->addBCC('bcc@example.com');

				    //Attachments
				    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
				    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

				    //Content
				    $mail->isHTML(true);                                  //Set email format to HTML
				    $mail->Subject = 'Thank you for registering';
				    $mail->Body    = "Please click this link to verfiy your email!</b><br>
				    	<a href='{$link}'>{$link}</a>
				    ";
				    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				    $mail->send();
				    echo 'Message has been sent';
				} catch (Exception $e) {
				    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}



				

				return "User registered successfully.";


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