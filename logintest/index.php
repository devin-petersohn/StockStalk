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
			//retrieve user input
			$name=$_POST['username'] or die('Input is invalid');
			$password=$_POST['password'] or die('Input is invalid');
			/*$query='SELECT * FROM lab8.authentication WHERE username=$1';
			//Prepared statement
			$result=pg_prepare($dbconn,'login',$query) or die("Query failed: " . pg_last_error());
			$result=pg_execute($dbconn,'login',array($name)) or die("Query failed: " . pg_last_error());
			$line = pg_fetch_array($result, null, PGSQL_ASSOC); 
			$salt=trim($line['salt']);
			$hashpw=sha1($salt.$password);
			
			//check password
			if($hashpw==$line['password_hash'])
			{
				$_SESSION['user']=$name;
				$_SESSION['loggedin']=true;
				
				//insert info into log table
				$result=pg_prepare($dbconn, 'credentials', 'INSERT INTO lab8.log (username,ip_address, log_date, action) VALUES ($1, $2, $3, $4)') 
				or die("Query failed: " . pg_last_error());
				$result=pg_execute($dbconn, 'credentials', array($name, $_SERVER['REMOTE_ADDR'], date(DATE_RSS), 'login'))
				or die("Query failed: " . pg_last_error());
				//redirect to homepage
				header('location: home.php');
			}
			else die('Incorrect username or password. Please try again.');
			if($_SESSION['loggedin'] == true)
				header('location: home.php');*/
			if ($name=="username" && $password=="password")
			{
				$_SESSION['user']=$name;
				$_SESSION['loggedin']=true;
			}
			else die('Incorrect username or password. Please try again.');
			if($_SESSION['loggedin'] == true)
				header('location: home.php');
		}
		
	}
	?>
</body>
</html>