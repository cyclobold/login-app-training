<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="thirdparties/css/bootstrap.min.css">
<link href="css/register.css" rel="stylesheet" id="bootstrap-css">
<!------ Include the above in your HEAD tag ---------->
  <title>Reset Password</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
  <div class="container">
    
    <div class='row'>
      <div class='col-md-6 m-auto' id="register_login_id">

        <div class='card'>
            <div class='card-body'>
            <div class='card-title'>
            <div id="legend">
            <legend class="">Reset Password</legend>
            
            <span id='form_info'></span>
        </div>
        </div>
        <form class="form-horizontal" method="POST" id='reset_password_form'>
  <fieldset>

 
    <div class="form-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="" class="form-control">
        <p class="help-block">Enter Email to get Password reset link</p>
      </div>
    </div>
 
 
    <div class="form-group">
      <!-- Password -->
    
     
    </div>
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" name='register'>Send Reset Link</button>
        <span id='reset_password_info'></span>
      </div>

      <div class='controls mt-3'>
        <button type='button' class='btn btn-primary' id='loginBtn_id'>Already Registered? Log in instead</button>
      </div>
    </div>
  </fieldset>
</form>
            </div>
      

        </div>
  
      </div>
    </div>


  </div>





<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
<script src="js/jquery.min.js"></script>
<script src="thirdparties/js/bootstrap.min.js"></script>
</body>

<script>
  $("#loginBtn_id").click(function(){



  //set the signup page
  localStorage.setItem("show-signup", JSON.stringify("true"));

  //bring in the sign in form
  $("#register_login_id").load("_ajax_loaders/login.php");


});


//Once the form is submitted..
$("#reset_password_form").submit((e) =>{
  e.preventDefault();

   //send an email to the user with the password reset link
    $.ajax({
        url: "_ajax_loaders/reset_password.php",
        method: 'POST',
        data: $("#reset_password_form").serialize(),
        success: function(result){

          if(result == "success"){
              $("#reset_password_info").html("<small> ➣ Your password reset link has been delivered</small>");
          }

        

        }, 
        beforeSend(){

          $("#reset_password_info").html("<small> ➣ Your password reset link has been sent...</small>");

        }, 
        error(){

        }
        



    })


}) 
</script>
</html>