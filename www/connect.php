<?php
$servername = "dbhost-mysql.cs.missouri.edu";
$connectUname = "mmhkwc";
$connectPass = "RgS8HC6L";

// Create connection
$conn = new mysqli($servername, $connectUname, $connectPass);

// Check connection
if ($dbconn->connect_error) {
    die("Connection failed: " . $dbconn->connect_error);
}





/*
      $servername = "localhost";
        $uname = "root";
        $pword = "";


// Create connection
$dbconn = new mysqli($servername, $uname, $pword);


*/





?>





