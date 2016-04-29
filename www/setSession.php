<?php
session_start();
if(empty($_POST["googleInfo"]))
{
	$_SESSION['username']=null;
}
else
{
	$_SESSION['username']=$_POST["googleInfo"][1];
}


?>