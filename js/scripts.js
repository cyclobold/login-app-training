window.addEventListener("DOMContentLoaded", function(){

	//check the localstorage
	//
	let showSignup = localStorage.getItem("show-signup");



	if(showSignup == null || showSignup == 'undefined'){

		//the signup page is not active

	}else{

		//the signup page might be active
		showSignup = JSON.parse(showSignup);

		if(showSignup == 'true'){
			//bring in the sign in form
			$("#register_login_id").load("_ajax_loaders/login.php");
		}



	}
	

})



$("#loginBtn_id").click(function(){



	//set the signup page
	localStorage.setItem("show-signup", JSON.stringify("true"));

	//bring in the sign in form
	$("#register_login_id").load("_ajax_loaders/login.php");


})


