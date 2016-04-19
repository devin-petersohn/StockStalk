<?php 
    include "connect.php";
    
//if($_SERVER['HTTPS'])
//{
//
//	if(isset($_POST['submit']))
//	{
//		//connects user to database.
//		$dbconn = new mysqli('localhost', 'root', '');
//		$name = $_POST['username'];
//        
//		$ticker = $_POST['tickername'];
//		if($ticker == NULL || $name == NULL)
//			die('All fields required');
//		addToPortfolio($ticker,$name, $dbconn);	
//	}
//}
    if($conn){
        if($_POST['action'] == 'add')
        {
            $name = $_POST['username'];
            $ticker = $_POST['tickername'];
            
            
            $sql = "INSERT INTO mmhkwc.portfolio (username, ticker) VALUES ('".$name."', '".$ticker."')";
            if ($conn->query($sql) === TRUE) {
                $arr = array(
                    "msg" => htmlentities("Add ".$ticker." to portfolio successfully"),
                );
                echo json_encode($arr);
            } else {
                if($name == NULL){
                    $arr = array(
                        "msg" => htmlentities("You need to log in First!"),
                    );
                    echo json_encode($arr);
                }else if ($conn->error == "Duplicate entry '".$name."-".$ticker."' for key 'PRIMARY'"){
                    $arr = array(
                        "msg" => htmlentities($ticker." has already in your portfolio!"),
                    );
                    echo json_encode($arr);
                }
            }

        }
    }


//function errorMessage(){
//	echo "<p> Sorry. Something went wrong on our end. </p>";
//}
?>