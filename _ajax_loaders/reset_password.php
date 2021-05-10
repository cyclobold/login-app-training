<?php 
if(isset($_POST['email'])){
	$email = trim($_POST['email']);

	require "../functions/login.php";

	$feedback = send_password_reset_link($email);

	echo $feedback;




}