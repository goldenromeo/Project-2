<?php

//

//puts all data into session data array
//then sends student to 02StudHome


 //


session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);

$firstN = strtoupper($_POST["firstN"]);
$lastN = strtoupper($_POST["lastN"]);
$_SESSION["studID"] = strtoupper($_POST["studID"]);
$studid = $_SESSION["studID"];
$email= $_POST["email"];
$major = $_POST["major"];
$sql2 = "select * from Proj2Students where `id` = 'studid'";
$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
$row2 = mysql_fetch_row($rs2);
if(empty($row2)){
	$sql = "insert into Proj2Students (`FirstName`,`LastName`,`StudentID`,`Email`,`Major`,`Status`) values ('$firstN','$lastN','$studid','$email','$major','N')";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
}
header('Location: 02StudHome.php');
?>
