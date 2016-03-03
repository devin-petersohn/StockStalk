<html>
<title>Home page test</title>
<head>
</head>
<body>
<?php
if($_SESSION['loggedin'] == true) //If user is logged in
	echo "You have logged in!";
	}
	else header("location: index.php"); 
?>
</body>
</html>