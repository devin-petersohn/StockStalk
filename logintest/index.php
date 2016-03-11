<!DOCTYPE html>
<html>
<head>
<title>Login Test</title>
</head>
<body>
<h1>Please log in</h1>
<form action='index.php' method='POST'>
	<p>
	<label for='username'>Username:</label>
	<input type='text' name='username'/>
	<label for='password'>Password:</label>
	<input type='password' name='password'/>
	<input type='submit' value='Submit' name='submit'>
	<?php
	SESSION_START();
	if(isset($_SERVER['HTTPS']))
	{
		if (isset($_POST['submit']))
		{
			//connects user to database.
			$dbconn = mysqli_connect("local", "mysql", "password","capstone")
			or die("Could not connect: " . mysqli_connect_error());
			//retrieve user input
			$name=$_POST['username'] or die('Input is invalid');
			$password=$_POST['password'] or die('Input is invalid');
			$query='SELECT * FROM loginInfo WHERE username=?';
			//Prepared statement
			$stmt=$dbconn->prepare($query) or die("Query failed");
			$stmt->bind_param("s",$name);
			$stmt->execute() or die ("Query failed");
			$line = $stmt->fetch_array(MYSQLI_ASSOC); 
			$salt=trim($line['salt']);
			$hashpw=sha1($salt.$password);
			
			//check password
			if($hashpw==$line['hashpass'])
			{
				$_SESSION['user']=$name;
				$_SESSION['loggedin']=true;

				header('location: home.php');
			}
			else die('Incorrect username or password. Please try again.');
			if($_SESSION['loggedin'] == true)
				header('location: home.php');
			mysqli_close($dbconn);
		}
	}
	else header('location: index.php');
	
	?>
</body>
</html>