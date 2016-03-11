<html>
<head>
<title>Registration Page</title>
</head>
<form method='POST' action='registration.php'>
	<label for="username">username:</label>
		  <input type="text" name="username" id="username">
		  <label for="password">password:</label>
		  <input type="password" name="password" id="password">
		  <br>
		  <input type="submit" name="submit" value="submit">
</form>
Return to <a href='index.php'>login</a> page.<br />

<?php
session_start();
if($_SERVER['HTTPS'])
{
	if(isset($_POST['submit']))
	{
		//connects user to database.
		$dbconn = mysqli_connect("local", "mysql", "password","capstone",'3306','/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock');
		$name = $_POST['username'];
		$password = $_POST['password'];
		if($name == NULL || $password == NULL)
			die('All fields required');
	
		//hash and salt password
		mt_srand();
		$salt = mt_rand();
		$pwhash = sha1($salt.$password);
		
		//insert into loginInfo table
		$query = 'INSERT INTO loginInfo (username, hashpass, salt) VALUES (?, ?, ?)';
		$stmt=$mysqli->prepare($query) or die("Query failed");
		$stmt->bind_param("sss",$name,$pwhash,$salt);
		$stmt->execute() or die ("Query failed");
		//set session keys
		$_SESSION['user'] = $name;
		$_SESSION['loggedin'] = true;
		//redirect user to home page
		header('location: home.php');
	}
	if($_SESSION['loggedin'])
		header('location: home.php');
}
else
	header('location: registration.php');
?>