<?php  //Start the Session
session_start();
 require('connect.php');
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['username']) and isset($_POST['password'])){
//3.1.1 Assigning posted values to variables.
$username = $_POST['username'];
$password = $_POST['password'];
    echo $username;
    echo $password;
//3.1.2 Checking the values are existing in the database or not
$query="SELECT hashpass, salt FROM stockstalk.loginInfo WHERE username=?";
//Prepared statement
			$stmt=$conn->prepare($query) or die("Query failed");
			$stmt->bind_param("s",$username);
			$stmt->execute() or die ("Query failed");
			$stmt->bind_result($hashpass, $salt);
			$stmt->fetch();
			$hashpw=sha1($salt.$password);
			//check password
    echo "\n".$hashpw."\n"; 
    echo "\n".$hashpass."\n";
			if($hashpw==$hashpass)
			{
				$_SESSION['user']=$username;
				$_SESSION['loggedin']=true;
				echo "LOGGED IN CORRECTLY";
			}
    else{
        echo "U SUCKK";
    }
}
?>