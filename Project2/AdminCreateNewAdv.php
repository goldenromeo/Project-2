<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Create New Admin</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>

     <script type="text/javascript">
    //   window.onload = function () {
    //       document.getElementById("PassW").onchange = validatePassword;
    //       document.getElementById("ConfP").onchange = validatePassword;
    //   }
    //   function validatePassword(){
    //     var pass2=document.getElementById("ConfP").value;
    //     var pass1=document.getElementById("PassW").value;
    //     if(pass1!=pass2)
    //         document.getElementById("ConfP").setCustomValidity("Passwords Don't Match");
    //     else
    //         document.getElementById("PassW").setCustomValidity('');  
    //     //empty string means no validation error
    //   }
    // </script>
  </head>
   <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h2>Create New Advisor Account</h2>
		<?php
      if($_SESSION["PassCon"] == true){
        echo "<h3 style='color:red'>Passwords do not match!!</h3>";
      }
    ?>
		<form action="AdminProcessCreateNew.php" method="post" name="Create">
		<div class="field">
	      		<label for="firstN">First Name</label>  <!--get first name  -->
	      		<input id="firstN" size="20" maxlength="50" type="text" name="firstN" required autofocus>
	    	</div>

	    	<div class="field">
	     		<label for="lastN">Last Name</label>	<!--get last name  -->
	      		<input id="lastN" size="20" maxlength="50" type="text" name="lastN" required>
	   	</div>	

		<div class="field">
	     		<label for="UserN">Username</label>	<!--get user name  -->
	      		<input id="UserN" size="20" maxlength="50" type="text" name="UserN" required>
	   	</div>	 

		<div class="field">
	     		<label for="Location">Appointment's Location</label> <!--get location where appointments will be made  -->
	      		<input id="Location" size="20" maxlength="50" type="text" name="Location" required>
	   	</div>	
		<div class="field">
	     		<label for="office">Office</label> <!--get Office location  -->
	      		<input id="office" size="20" maxlength="50" type="text" name="office" required>
	   	</div>	



		<div class="field">
	     		<label for="PassW">Password</label> <!--get password  -->
	      		<input id="PassW" size="20" maxlength="50" type="password" name="PassW" required>
	   	</div>	

		<div class="field">
	     		<label for="ConfP">Confirm Password</label> <!--get password again to make sure is the same -->
	      		<input id="ConfP" size="20" maxlength="50" type="password" name="ConfP" required>
	   	</div>	
		<br>

		<div class="nextButton">		<!--submit form  -->
			<input type="submit" name="next" class="button large go" value="Submit">
	    </div>
		</form>

							<!--if user cancels then go back to main admin menu  -->
		<form method="link" action="AdminUI.php">
			<input type="submit" name="home" class="button large" value="Cancel">
		</form>

	</div>
  </body>
  <footer>
	<?php include("footer.html"); ?>
  </footer>

	</div>
	</div>
</html>
