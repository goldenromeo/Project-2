<?php
session_start();

$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);
	$studID = $_SESSION["studID"];
	$sql2 = "select * from Proj2Students where `StudentID` = '$studID'";
	$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
	$row2 = mysql_fetch_row($rs2);
	$firstN = $row2[1];
	$lastN = $row2[2];
	$major = $row2[5];
	$email = $row2[4];
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Edit Student Information</title>
  <link rel='stylesheet' type='text/css' href='../css/standard.css'/> 
  </head>
  <body>
    <div id="login">
      <div id="form">    <!--form to change user data starts here-->
			<div class="top">
			<h2>Edit Student Information<span class="login-create"></span></h2>
			<form action="StudProcessEdit.php" method="post" name="Edit">
			<div class="field">
				<label for="firstN">First Name</label>   <!-- This box is prefilled with username -->
				<input id="firstN" size="30" maxlength="50" type="text" name="firstN" required value=<?php echo $firstN?>>
			</div>
			<div class="field">
			  <label for="lastN">Last Name</label>         <!-- This box is prefilled with the students last name-->
			  <input id="lastN" size="30" maxlength="50" type="text" name="lastN" required value=<?php echo $lastN?>>
			</div>
			<div class="field">
				<label for="studID">Student ID</label>    <!-- this box is prefilled with the students username-->
				<input id="studID" size="30" maxlength="7" type="text" pattern="[A-Za-z]{2}[0-9]{5}" title="AB12345" name="studID" disabled value=<?php echo $studID?>>
			</div>
			<div class="field">
				<label for="email">E-mail</label> <!--this box is prefilled with the students username-->
				<input id="email" size="30" maxlength="255" type="email" name="email" required value=<?php echo $email?>>
			</div>
			<div class="field">
				  <label for="major">Major</label>
				  <select id="major" name = "major">		<!-- This shows the different majors. Here Major names were changed-->
					<option <?php if($major == 'CMPE'){echo("selected");}?>>Computer Engineering</option>
					<option <?php if($major == 'CMSC'){echo("selected");}?>>Computer Science</option>
					<option <?php if($major == 'MENG'){echo("selected");}?>>Mechanical Engineering</option>
					<option <?php if($major == 'CENG'){echo("selected");}?>>Chemical Engineering</option>
<!-- someday
					<option <?php if($major == 'Africana Studies'){echo("selected");}?>>Africana Studies</option>
					<option <?php if($major == 'American Studies'){echo("selected");}?>>American Studies</option>
					<option <?php if($major == 'Ancient Studies'){echo("selected");}?>>Ancient Studies</option>
					<option <?php if($major == 'Anthropology'){echo("selected");}?>>Anthropology</option>
					<option <?php if($major == 'Asian Studies'){echo("selected");}?>>Asian Studies</option>
					<option <?php if($major == 'Biochemistry and Molecular Biology'){echo("selected");}?>>Biochemistry and Molecular Biology</option>
					<option <?php if($major == 'Bioinformatics and Computational Biology'){echo("selected");}?>>Bioinformatics and Computational Biology</option>
					<option <?php if($major == 'Biological Sciences'){echo("selected");}?>>Biological Sciences</option>
					<option <?php if($major == 'Business Technology Administration'){echo("selected");}?>>Business Technology Administration</option>
					<option <?php if($major == 'Chemistry'){echo("selected");}?>>Chemistry</option>
					<option <?php if($major == 'Dance'){echo("selected");}?>>Dance</option>
					<option <?php if($major == 'Economics'){echo("selected");}?>>Economics</option>
					<option <?php if($major == 'Financial Economics'){echo("selected");}?>>Financial Economics</option>
					<option <?php if($major == 'Emergency Health Services'){echo("selected");}?>>Emergency Health Services</option>
					<option <?php if($major == 'English'){echo("selected");}?>>English</option>
					<option <?php if($major == 'Environmental Science and Environmental Studies'){echo("selected");}?>>Environmental Science and Environmental Studies</option>
					<option <?php if($major == 'Gender and Womens Studies'){echo("selected");}?>>Gender and Womens Studies</option>
					<option <?php if($major == 'Geography'){echo("selected");}?>>Geography</option>
					<option <?php if($major == 'Global Studies'){echo("selected");}?>>Global Studies</option>
					<option <?php if($major == 'Health Administration and Policy'){echo("selected");}?>>Health Administration and Policy</option>
					<option <?php if($major == 'History'){echo("selected");}?>>History</option>
					<option <?php if($major == 'Information Systems'){echo("selected");}?>>Information Systems</option>
					<option <?php if($major == 'Interdisciplinary Studies'){echo("selected");}?>>Interdisciplinary Studies</option>
					<option <?php if($major == 'Management of Aging Services'){echo("selected");}?>>Management of Aging Services</option>
					<option <?php if($major == 'Mathematics'){echo("selected");}?>>Mathematics</option>
					<option <?php if($major == 'Statistics'){echo("selected");}?>>Statistics</option>
					<option <?php if($major == 'Media and Communication Studies'){echo("selected");}?>>Media and Communication Studies</option>
					<option <?php if($major == 'Modern Languages, Linguistics and Intercultural Communication'){echo("selected");}?>>Modern Languages, Linguistics and Intercultural Communication</option>
					<option <?php if($major == 'Music'){echo("selected");}?>>Music</option>
					<option <?php if($major == 'Philosophy'){echo("selected");}?>>Philosophy</option>
					<option <?php if($major == 'Physics'){echo("selected");}?>>Physics</option>
					<option <?php if($major == 'Political Sciences'){echo("selected");}?>>Political Science</option>
					<option <?php if($major == 'Psychology'){echo("selected");}?>>Psychology</option>
					<option <?php if($major == 'Social Work'){echo("selected");}?>>Social Work</option>
					<option <?php if($major == 'Sociology'){echo("selected");}?>>Sociology</option>
					<option <?php if($major == 'Theatre'){echo("selected");}?>>Theatre</option>
					<option <?php if($major == 'Visual Arts'){echo("selected");}?>>Visual Arts</option>
					<option <?php if($major == 'Undecided'){echo("selected");}?>>Undecided</option>
					<option <?php if($major == 'Other'){echo("selected");}?>>Other</option>
-->
					</select>
			</div>
			<div class="nextButton">
				<input type="submit" name="save" class="button large go" value="Save">
			</div>
			</div>
		</form>
  <footer>
	<?php include("footer.html"); ?>
  </footer>
  </body>
  
</html>
