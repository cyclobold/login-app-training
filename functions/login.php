<?php 


function loginIn($email, $password){
	//check if this user can even make attempt to login
		
	$feedback = check_make_attempt($email);


}



function check_make_attempt($email){

	require("database/db_connect.php");


	

}