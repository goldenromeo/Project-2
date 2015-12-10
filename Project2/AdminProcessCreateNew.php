<?php
session_start();

$_SESSION["AdvF"] = $_POST["firstN"];
$_SESSION["AdvL"] = $_POST["lastN"];
$_SESSION["Location"] = $_POST["Location"];
$_SESSION["office"] = $_POST["office"];
$_SESSION["AdvUN"] = $_POST["UserN"];
$_SESSION["AdvPW"] = $_POST["PassW"];
$_SESSION["PassCon"] = false;




//check if the passwords are the same 

//if they are go to AdminCreateNew
if($_POST["PassW"] == $_POST["ConfP"]){
	header('Location: AdminCreateNew.php');
}

//else send them back 

elseif($_POST["PassW"] != $_POST["ConfP"]){
	$_SESSION["PassCon"] = true;
	header('Location: AdminCreateNewAdv.php');
}

?>
