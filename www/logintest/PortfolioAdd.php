
<html>
<?php 
session_start();
if ($_SESSION['loggedin']==false)
	header('location: home.php')
	
?>
<title>Home page test</title>
<head>
</head>
<body>
<p>Welcome!</p>
<p>Add stock to portfolio</p>
<form method='POST' action='home.php'>
	<label for="stockticker">Stock Ticker:</label>
		  <input type="text" name="stockticker" id="stockticker">
		  <input type="submit" name="submit" value="submit">
</form>

<?php

if($_SERVER['HTTPS'])
{

	if(isset($_POST['submit']))
	{
		//connects user to database.
		$dbconn = new mysqli('localhost', 'root', '');
		$name = $_SESSION['user'];
		$ticker = $_POST['stockticker'];
		if($ticker == NULL || $name == NULL)
			die('All fields required');
		addToPortfolio($ticker,$name, $dbconn);	
	}
}

function addToPortfolio ($ticker, $user, $dbconn){
	//insert into stocks table
		$query = "INSERT INTO capstone.portfolio (username, ticker) VALUES (?, ?)";
		$stmt=$dbconn->prepare($query) or die("Prepared statement error");
		$stmt->bind_param("ss",$user,$ticker);
		$stmt->execute() or die("Something went wrong on our end. Sorry");
		echo "<p>Stock has been added to portfolio</p>";	
}

function errorMessage(){
	echo "<p> Sorry. Something went wrong on our end. </p>";
}
?>
</body>
</html>