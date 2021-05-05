const password = document.getElementById("password");
const formInfo = document.getElementById("form_info");


password.addEventListener("blur", function(){
	const passwordInfo = document.getElementById("password_info");

	inputPassword = this.value.trim();

	result = checkPassUpperCase(inputPassword);

	if(result == 'none'){
		passwordInfo.innerHTML = "No password entered";
		this.value = "";
	}

	if(result == false){
		passwordInfo.innerHTML = "Password must contain atleast one uppercase";
		this.value = "";
	}

	if(result == true){
		//we can check for other conditions...
		//
	}

})


function checkPassUpperCase(inputPassword){

	if(inputPassword.length == 0){
		//no password was entered
		return "none";
	}


	pattern = /[A-Z]+/;
	if(pattern.test(inputPassword)){
		return true;
	}


	return false;

}







