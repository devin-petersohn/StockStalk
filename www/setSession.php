<?php
session_start();
include "connect.php";

if(empty($_POST["googleInfo"]))
{
	$_SESSION['username']=null;
}
else
{
	$_SESSION['username']=$_POST["googleInfo"][1];
	$_SESSION['user']=$_POST["googleInfo"][0];
	 $query = "INSERT INTO loginInfo (username,name) VALUES (?,?)";
        $stmt=$dbconn->prepare($query) or die("Prepared statement error");
        $stmt->bind_param("ss",$_POST["googleInfo"][1],$_POST["googleInfo"][0]);
        $stmt->execute() or die ("Execute Query failed");
}


?>