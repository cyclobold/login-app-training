<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


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



function send_password_reset_link($email){
	require "../database/db_connect.php";

	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/PHPMailer.php';
	require '../PHPMailer/src/SMTP.php';


	//build the link
	$url = $_SERVER['HTTP_HOST'];	

	$link = "localhost:8888/login-app/reset_password_page.php?em={$email}";


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
				    $mail->Subject = 'Password Reset Link';
				    $mail->Body    = "Please click this link to reset your password!</b><br>
				    	<a href='{$link}'>{$link}</a>
				    ";
				

				    $mail->send();
				    return "success";
				} catch (Exception $e) {
				    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}





}