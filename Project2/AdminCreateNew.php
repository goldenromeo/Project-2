<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Create New Admin</title>
    <script type="text/javascript">
    function saveValue(target){
	var stepVal = document.getElementById(target).value;
	alert("Value: " + stepVal);
    }
    </script>
    <link rel='stylesheet' type='text/css' href='../css/standard.css'/> 
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h2>New Advisor has been created:</h2>

		<?php

			//local variables with new user data are created here
			$first = $_SESSION["AdvF"];
			$last = $_SESSION["AdvL"];
			$user = $_SESSION["AdvUN"];
			$pass = $_SESSION["AdvPW"];
			$Location = $_SESSION["Location"];
			$office = $_SESSION["office"];


			include('../CommonMethods.php');
			$debug = false;
			$Common = new Common($debug);

//look for admin in tables by username , name and last name

      $sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '$user' AND `FirstName` = '$first' AND  `LastName` = '$last'";
      $rs = $Common->executeQuery($sql, "Advising Appointments");
      $row = mysql_fetch_row($rs);
      if($row){

//if user already exists then do nothing
        echo("<h3>Advisor $first $last already exists</h3>");
      }
      else{

//otherwise add new Admin with user entered data 

  			$sql = "INSERT INTO `Proj2Advisors`(`FirstName`, `LastName`, `Username`, `Password`,`location`,`office`) 
  			VALUES ('$first', '$last', '$user', '$pass', '$Location','$office')";
        echo ("<h3>$first $last<h3>");
        $rs = $Common->executeQuery($sql, "Advising Appointments");
      }
		?>
		<form method="link" action="AdminUI.php">
			<input type="submit" name="next" class="button large go" value="Return to Home">
		</form>

	</form>
  <footer>
	<?php include("footer.html"); ?>
  </footer>
  </body>

	</div>
	</div>
  
</html>
