<?php
    ini_set('display_errors', '1');
    ini_set('error_reporting', E_ALL);

    include "connect.php";
    
    if($dbconn){
        if(isset($_POST['ticker'])){
            $ticker = $_POST['ticker'];
            $sql = "SELECT name from xltz6.stocks where ticker ='".$ticker."'";
            
            if($res = $dbconn->query($sql)){
                while ($row = $res->fetch_assoc()) {
                    echo $row["name"];
                }
            }
        }
        
    }

    else{
        echo "variable not passed";
    }
?>