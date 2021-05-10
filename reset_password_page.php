<?php 

if(isset($_GET['em']) && !is_numeric($_GET['em'])){

	$email = trim($_GET['em']);



	if(isset($_POST['reset_password'])){
		
	}


	//present a reset form
	echo " 

	<form action='' method='POST'>
	<div class='form-group'>
      <!-- E-mail -->
      <label class='control-label' for='email'>New Password</label>
      <div class='controls'>
        <input type='text' id='email' name='password' placeholder='' class='form-control'>
      </div>

       <label class='control-label' for='email'>New Password Confirm</label>
      <div class='controls'>
        <input type='text' id='email' name='password_confirm' placeholder='' class='form-control'>
      </div>

      <button name='reset_password'>Reset Password</button>
    </div>
    </div>";
	

}else{
	echo 'not workinf';
}