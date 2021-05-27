<?php 
ini_set("display_errors", 'on');
if(isset($_GET['em']) && !is_numeric($_GET['em'])){


	$email = trim($_GET['em']);


	require_once "Classes/User.php";
	require_once "Classes/Page.php";

	$feedback = $user->verifyEmail($email);

	if($feedback == true){

		//$user->loginUserWithEmail($user);
		$user->redirectUser('register');

	}else{

		Page::redirectUser('register');

	}



}