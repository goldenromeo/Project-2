<?php
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Exit Message</title>
   <link rel='stylesheet' type='text/css' href='../css/standard.css'/> 
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
	    <div class="statusMessage">
	    <?php
			$status = $_SESSION["status"];
			$_SESSION["resch"] = false;			
			if($status == "complete"){
				echo "You have completed your sign-up for an advising appointment.";
			}
			elseif($status == "none"){
				echo "You did not sign up for an advising appointment.";
			}
			if($status == "cancel"){
				echo "You have cancelled your advising appointment.";
			}
			if($status == "resch"){
				echo "You have changed your advising appointment.";
			}
			if($status == "keep"){
				echo "No changes have been made to your advising appointment.";
			}
		?>
        </div>
		<form action="02StudHome.php" method="post" name="complete">
	    <div class="returnButton">
			<input type="submit" name="return" class="button large go" value="Return to Home">
	    </div>
		</div>
		</form>
  <footer>
	<?php include("footer.html"); ?>
  </footer>
  </body>
</html>
