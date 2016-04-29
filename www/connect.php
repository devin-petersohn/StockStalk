<?php
/*$servername = "dbhost-mysql.cs.missouri.edu";
$connectUname = "mmhkwc";
$connectPass = "RgS8HC6L";

// Create connection
$conn = new mysqli($servername, $connectUname, $connectPass);

// Check connection
if ($dbconn->connect_error) {
    die("Connection failed: " . $dbconn->connect_error);
}
*/

$servername = "127.0.0.1";
$connectUname = "root";
$connectPass = "";
$db = "stockstalk";

// Create connection
$dbconn = new mysqli($servername, $connectUname, $connectPass, $db);

// Check connection
if ($dbconn->connect_error) {
    die("Connection failed: " . $dbconn->connect_error);
}











?>





