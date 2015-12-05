<?php
session_start();
$debug = false;

if(isset($_POST["advisor"])){
	$_SESSION["advisor"] = $_POST["advisor"];
}

$localAdvisor = $_SESSION["advisor"];
$localMaj = $_SESSION["major"];

include('../CommonMethods.php');
$COMMON = new Common($debug);


//gets advisor name 
$sql = "select * from Proj2Advisors where `id` = '$localAdvisor'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$advisorName = $row[1]." ".$row[2];

//

?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Appointment</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>

  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Select Appointment Time</h1>
	    <div class="field">
		<form action = "10StudConfirmSch.php" method = "post" name = "SelectTime">
	    <?php

// http://php.net/manual/en/function.time.php fpr SQL statements below
// Comparing timestamps, could not remember. 

			$curtime = time();   //gets the current time
							
			if ($_SESSION["advisor"] != "Group")  // for individual conferences only
			{ 
				$sql = "select * from Proj2Appointments where `EnrolledNum` = 0 
					and (`Major` like '%$localMaj%' or `Major` = '') and `Time` > '".date('Y-m-d H:i:s')."' and `AdvisorID` = ".$_POST['advisor']." 
					order by `Time` ASC limit 30";

					//gets all th apointment times after current time for the selected advisor $_POST['advisor']. max 30 items
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
				echo "<h2>Individual Advising</h2><br>";
				echo "<label for='prompt'>Select appointment with ",$advisorName,":</label><br>";
			}
			else // for group conferences
			{
				$temp = "";
				if($localAdvisor != "Group") { $temp = "`AdvisorID` = '$localAdvisor' and "; }


					//gets all the appointments where max # of students >1 but less than 10 that accept the students major
					// since the advisor id for group appointments is zero that could've been used too
			$sql = "select * from Proj2Appointments where $temp `EnrolledNum` < `Max` and (`Max` > 1) and (`Major` like '%$localMaj%' or `Major` = '')  and `Time` > '".date('Y-m-d H:i:s')."' order by `Time` ASC limit 30";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);//execute querry
				echo "<h2>Group Advising</h2><br>";
				echo "<label for='prompt'>Select appointment:</label><br>";
		} 			
			//this displays and lets the user select a time
			while($row = mysql_fetch_row($rs)){
				$datephp = strtotime($row[1]);
				echo "<label for='",$row[0],"'>";
				echo "<input id='",$row[0],"' type='radio' name='appTime' required value='", $row[1], "'>", date('l, F d, Y g:i A', $datephp) ,"</label><br>\n";
			}
		?>
        </div>
	    <div class="nextButton">
			<input type="submit" name="next" class="button large go" value="Next">
	    </div>
		</form>
		<div>
		<form method="link" action="02StudHome.php">
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
		</div>
		<div class="bottom">
		<p>Note: Appointments are maximum 30 minutes long.</p>
		<p style="color:red">If there are no more open appointments, contact your advisor or click <a href='02StudHome.php'>here</a> to start over.</p>
		</div>
  <footer>
	<?php include("footer.html"); ?>
  </footer>
  </body>
</html>
