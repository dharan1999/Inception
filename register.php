<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
	<title>Welcome to Inception!</title>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/register_style.css"> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<!-- <script src="assets/js/register.js"></script> -->
	<link rel="stylesheet" type="text/css" href="assets/css/ultimate.css">
</head>
<body>

	

	<div class="container">

		<div class="forms-container">

			<div class="signin-signup">
				
			
			
			
				<form action="register.php" method="POST" class="sign-in-form">
				<h2 class="title">Sign in</h2>	
				<div class="input-field">
					<i class="fas fa-user"></i>
					<input type="email" name="log_email" placeholder="Email Address" value="<?php 
					if(isset($_SESSION['log_email'])) {
						echo $_SESSION['log_email'];
					} 
					?>" required>
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
					<input type="password" name="log_password" placeholder="Password">
					</div>

					<?php if(in_array("Email or password was incorrect<br>", $error_array)) echo  "Email or password was incorrect<br>"; ?>

					<input type="submit" name="login_button" value="Login" class="btn solid">
					 <!-- <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div> -->
					

				</form>

			

			

				<form action="register.php" method="POST" class="sign-up-form" enctype="multipart/form-data" >
					<h2 class="title">Sign up</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
					<input type="text" name="reg_fname" placeholder="First Name" value="<?php 
					if(isset($_SESSION['reg_fname'])) {
						echo $_SESSION['reg_fname'];
					} 
					?>" required>
					</div>
					<?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>
					
					

					<div class="input-field">
              <i class="fas fa-user"></i>
					<input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
					if(isset($_SESSION['reg_lname'])) {
						echo $_SESSION['reg_lname'];
					} 
					?>" required>
					</div>
					<?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>

				<div class="input-field">
              			<i class="fas fa-envelope"></i>
					<input type="email" name="reg_email" placeholder="Email" value="<?php 
					if(isset($_SESSION['reg_email'])) {
						echo $_SESSION['reg_email'];
					} 
					?>" required>
					</div>
					<div class="input-field">
              <i class="fas fa-envelope"></i>
					<input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
					if(isset($_SESSION['reg_email2'])) {
						echo $_SESSION['reg_email2'];
					} 
					?>" required>
					</div>
					<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; 
					else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
					else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>



                         
				 	<div class="input-field">
              		<i class="fas fa-lock"></i>
					<input type="password" name="reg_password" placeholder="Password" required>
					</div>
					<div class="input-field">
              		<i class="fas fa-lock"></i>
					<input type="password" name="reg_password2" placeholder="Confirm Password" required>
					</div>
					<?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
					else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
					else if(in_array("Your password must be betwen 5 and 30 characters<br>", $error_array)) echo "Your password must be betwen 5 and 30 characters<br>"; ?>

					<div style=" background-color: #f0f0f0;opacity: 0.5;
    border-radius: 55px;
    padding: 10px 120px;">
						<h3 style="align-items: center;  color: #333;">What are you?</h3>
					</div>
					<div class="input-field-radio">
						<input  type="radio" name="userType" id="normal"  value="normal" checked/>
                       		<label  for="normal">Normal User</label>
					</div>
                    
                    <div class="input-field-radio">
					<input class = "input-field-radio" type="radio" name="userType" id="investor"   value="investor" />
                        <label  for="investor">Investor</label>  
        			</div>
        			<div class="" id='inputfield' style='display:none'>  
                         <input type='file' name='fileToUpload'  />
                    </div>
                
                    <?php if(in_array("Sorry, there was an error uploading your file.<br>", $error_array)) { echo "Sorry, there was an error uploading your file.<br>";
                    } ?>


					<input type="submit" name="register_button" value="Register" class="btn">
					<br>
					<!-- <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div> -->

					<?php if(in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
					<!-- <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a> -->
				</form>
			</div>

		</div>
	<div class="panels-container">
        <div class="panel left-panel">
          <div class="content" style="position: relative;
    display: inline-block;">
            <!-- <h3>Inception</h3> -->
            <img src="assets/images/backgrounds/Final-logo-2.png" style="width: auto ;
  max-width: 70% ;
  height: auto ;">
            <div style="margin: 0 auto;
        left: 6%;
       /* right: 0;*/ 
        top: 62%;
        position: absolute;
        /*z-index: 999;*/
        padding-bottom: 0px;">
            <p>
              Live in your Inception, Play in ours!
            </p>
            </div>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="assets/images/backgrounds/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Join the Community</h3>
            <p>
              Trust us now, Thank us later.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="assets/images/backgrounds/register.svg" class="image" alt="" />
        </div>
      </div>

	</div>
<script src="assets/js/register_script.js"></script>

</body>
</html>

<script>
$(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'investor') {
            $('#inputfield').show();           
       }

       else {
            $('#inputfield').hide();   
       }
   });
});
</script>