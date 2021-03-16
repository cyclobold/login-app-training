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


	checkUserIfExists($username, $type='username');

		
}



function checkUserIfExists($data, $type = 'email'){
	require("database/db_connect.php");


}