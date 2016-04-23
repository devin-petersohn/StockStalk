<?php 
    include "connect.php";

    if($dbconn){
        if($_POST['action'] == 'add') {
            $name = $_POST['username'];
            $ticker = $_POST['tickername'];
            $sql = "INSERT INTO portfolio (username, ticker) VALUES ('".$name."', '".$ticker."')";
            if ($dbconn->query($sql) === TRUE) {
                echo "Added ".$ticker." to portfolio successfully";
            } 
            else {
                 if($name == NULL){
                    echo "you need to log in first!";
                }
                else if ($dbconn->error == "Duplicate entry '".$name."-".$ticker."' for key 'PRIMARY'"){
                    echo $ticker." is already in your portfolio!";
                }
                else{
                    echo "Error adding ".$ticker." to portfolio.";
                }
            }
        }
    }
?>