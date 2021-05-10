<div class="card">
  <div class="card-body">
    <div class="card-title">
      <div id="legend">
            <legend class="">Log in</legend>
         
            <span id='form_info'></span>
        </div>

    </div>

       <form class="form-horizontal" action='' method="POST">
  <fieldset>

 
    <div class="form-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="" class="form-control">
      </div>
    </div>
 
    <div class="form-group">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="form-control" required>
      
        <p class="help-block" id="password_info"></p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" name='login'>Log in</button>
        <span>Forgot Password? <a href='reset_password.php'>Reset Password</a></span>
      </div>

      <div class='controls mt-3'>
        <button type='button' class='btn btn-primary' id='registerBtn_id'>Not Registered? Sign up</button>
      </div>
    </div>
  </fieldset>
</form>
  </div>
</div>

<script>
    //when the register button is clicked
  $("#registerBtn_id").click(function(){
      //Remove appropriate data from localStorage
      localStorage.removeItem("show-signup");
      location.reload();

    })  
</script>