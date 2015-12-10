<?php
session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);

if($_POST["finish"] == 'Cancel'){
	$_SESSION["status"] = "none";
}
else{
	$studid = $_SESSION["studID"];
	$sql2 = "select * from Proj2Students where `id` = 'studid'";
	$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
	$row2 = mysql_fetch_row($rs2);
	$firstn = $row2[1];
	$lastn = $row2[2];
	$major = $row2[4];
	$email = $row2[5];
	$advisor = $_SESSION["advisor"];

	// if debug mode is on. fixed this
	if(debug==1) { echo("Advisor -> $advisor<br>\n"); }



	$apptime = $_SESSION["appTime"];
	if(empty($row2)){
		$sql = "insert into Proj2Students (`FirstName`,`LastName`,`StudentID`,`Email`,`Major`) values ('$firstn','$lastn','$studid','$email','$major')";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}


	// ************************ Lupoli 9-1-2015
	// we have to check to make sure someone did not steal that spot just before them!! (deadlock)
	// if the spot was taken, need to stop and reset
	if( isStillAvailable($apptime, $advisor) ) // then good, take that spot
	{ } 
	else // spot was taken, tell them to pick another
	{
		if($debug == false) 
		{
			header('Location: 13StudDenied.php');
			return;
		}
	}

	
	//regular new schedule
	if($_POST["finish"] == 'Submit'){
		if($_SESSION["advisor"] == 'Group')  // student scheduled for a group session
		{
			$sql = "select * from Proj2Appointments where `Time` = '$apptime' and `AdvisorID` = 0";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			$groupids = $row[4];
			$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$groupids $studid' where `Time` = '$apptime' and `AdvisorID` = 0";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		else // student scheduled for an individual session
		{	;
			$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$studid' where `AdvisorID` = '$advisor' and `Time` = '$apptime'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		
	
		$_SESSION["status"] = "complete";
	}
	elseif($_POST["finish"] == 'Reschedule'){
		//remove stud from EnrolledID
		$sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$row = mysql_fetch_row($rs);
		$oldAdvisorID = $row[2];
		$oldAppTime = $row[1];
		$newIDs = str_replace($studid, "", $row[4]);
		
		$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum-1, `EnrolledID` = '$newIDs' where `AdvisorID` = '$oldAdvisorID' and `Time` = '$oldAppTime'";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		
		//schedule new app
		if($_SESSION["advisor"] == 'Group'){
			$sql = "select * from Proj2Appointments where `Time` = '$apptime' and `AdvisorID` = 0";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			$row = mysql_fetch_row($rs);
			$groupids = $row[4];
			$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$groupids $studid' where `Time` = '$apptime' and `AdvisorID` = 0";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}
		else{
			$sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum+1, `EnrolledID` = '$studid' where `Time` = '$apptime' and `AdvisorID` = '$advisor'";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		}

		$_SESSION["status"] = "resch";
	}

	//update stud status to ''
	$sql = "update `Proj2Students` set `Status` = '' where `StudentID` = '$studid'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

}
if($debug == false) { header('Location: 12StudExit.php'); }



function isStillAvailable($apptime, $advisor)
{
	// advisor could be "Group"
	global $debug; global $COMMON;
	$sql = "";
		

//to group or not to group?

//to group:
	if($advisor == "Group")
	{ $sql = "select `EnrolledNum`, `Max` from `Proj2Appointments` where `Time` = '$apptime' and `AdvisorID` = 0";  }
//not to group:
	else // then specific
	{ $sql = "select `EnrolledNum`, `Max` from `Proj2Appointments` where `Time` = '$apptime' and `AdvisorID` = '$advisor'";  }



	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_row($rs);

	// if max [1] =< EnrolledNum[0], then the spot was indeed taken
	if($row[1] > $row[0]) // then all good
	{ 
		if($debug) { echo("spot available\n<br>"); }
		return true; 
	}
	else // spot was taken
	{
		if($debug) { echo("spot NOT available\n<br>"); }	
		return false; 
	}

}

?>


