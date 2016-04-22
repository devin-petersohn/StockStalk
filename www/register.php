<?php
    session_start();


if (isset( $_POST['Submit'])){
		include "connect.php";
      
      // Create connection
      $dbconn = new mysqli($servername, $connectUname, $connectPass, $db);

      // Check connection
      if ($dbconn->connect_error) {
        die("Connection failed: " . $dbconn->connect_error);
         }
        $name = $dbconn->real_escape_string(htmlspecialchars($_POST['name']));
        $username = $dbconn->real_escape_string(htmlspecialchars($_POST['email']));
        $password = $dbconn->real_escape_string(htmlspecialchars($_POST['password']));
        
        $email = $dbconn->real_escape_string(htmlspecialchars($_POST['email']));
        //check if the name exists
        if(checkUsername($username)==0)
        {
            addUser($username,$password,$email,$name);               //adds user into database
            $_SESSION['username'] = $username;
            header("Location: index.php");
        }
        else
            echo "Username is already taken";
    }
	
	function checkUsername($username){
        
        include "connect.php";
      
      // Create connection
      $dbconn = new mysqli($servername, $connectUname, $connectPass, $db);

      // Check connection
      if ($dbconn->connect_error) {
        die("Connection failed: " . $dbconn->connect_error);
      }
      
      $query="SELECT * FROM loginInfo WHERE username=?";
//Prepared statement
			$stmt=$dbconn->prepare($query) or die("PreQuery failed");
            $stmt->bind_param("s",$username);
            $stmt->execute() or die ("Query failed");
            $stmt->store_result();
            if($stmt->num_rows==0)
            {
                return 0;
            }
             else{
                return 1;
            }
      
      
    }
	

	function addUser($username,$password, $email, $name){
        
        include "connect.php";
      
      // Create connection
      $dbconn = new mysqli($servername, $connectUname, $connectPass, $db);

      // Check connection
      if ($dbconn->connect_error) {
        die("Connection failed: " . $dbconn->connect_error);
      }
        //hash and salt password
        mt_srand();
        $salt = mt_rand();
        echo "<p> salt is $salt </p>";
        echo "<p> password is $password </p>";
        $pwhash = sha1($salt.$password);
        //insert into loginInfo table
        $query = "INSERT INTO loginInfo (username,name, hashpass, salt) VALUES (?,?,?, ?)";
        $stmt=$dbconn->prepare($query) or die("Prepared statement error");
        $stmt->bind_param("ssss",$username,$name,$pwhash,$salt);
        $stmt->execute() or die ("Execute Query failed");
        //set session keys
        $_SESSION['user'] = $name;

    }





?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register An Account</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/one-page-wonder.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->  
    
    <!--
    <style type="text/css">
#loginForm .has-error .control-label,
#loginForm .has-error .help-block,
#loginForm .has-error .form-control-feedback {
    color: #f39c12;
}

#loginForm .has-success .control-label,
#loginForm .has-success .help-block,
#loginForm .has-success .form-control-feedback {
    color: #18bc9c;
}
</style>
    -->
    
    
    
    <script>
        $(document).ready(function() {
     
            $('#myForm').validator('validate');
        };
    </script>

</head>   
<body> 
    <!--Navbar call-->
    <?php include "navbar.php"; ?>

    <!-- Full Width Image Header -->
    <header class="header-image">
            <div class="container">
                
                <h1>Register An Account</h1>
                                

 <form data-toggle="validator" role="form" method='POST' action='register.php'>
     
    <div class="form-group has-feedback">
    <label for="inputEmail" class="control-label">Email:</label>
    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" data-error="That email address is invalid." required>
    <div class="help-block with-errors"></div>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>

  </div>
     
  <div class="form-group">
    <label for="inputName" class="control-label">First Name:</label>
    <input type="text" name="name" class="form-control" id="inputName" placeholder="Jane" required>
  </div>
   
     
  <div class="form-group has-feedback">
    <label for="inputPassword" class="control-label">Password:</label>
    <div class="form-group has-feedback">
      <input type="password" name="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
      <div class="help-block">Minimum of 6 characters</div>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    <div class="form-group has-feedback">
    <label for="inputPassword" class="control-label">Verify Password:</label>
      <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
      <div class="help-block with-errors"></div>
        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>
    </div>
     
  </div>
  <div class="form-group p-all">
    <button class="btn btn-lg btn-primary btn-block" type="Submit" name='Submit' value='Submit'>Register</button> 
  </div>
</form>

        </div>
        </header>

   <!-- Page Content -->
    <div class="container">

        

        <div class="row">
            <div class="col-sm-14">
                
                <div class="headline">
                    <hr>
                    <h3>What can you do when you register an account?</h3>
                    <hr>
                </div>
            </div>
        </div>
        <!-- /.row -->

    

        <div class="row">
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="img/search.jpg" style="width:300px; height:300px" alt="">
                <h2>Search</h2>
                <p>Here you can search our database of over 500 stocks. Choose from a specific date range, a particular market sector, or select stocks from your personal portfolio and compare their price change movement.</p>
            </div>
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="img/portfolio.jpg" style="width:300px; height:300px"alt="">
                <h2>Your Portfolio</h2>
                <p>Want to see how your portfolio stacks up? Add your stocks to your personal portfolio to see how diversified you are. Chose stocks from your portfolio to compare and analyze.</p>
            </div>
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="img/chart.jpg" style="width:300px; height:300px" alt="">
                <h2>Chart</h2>
                <p>Compare hundreds of stocks and view in-depth details. View movement graphs and more!</p>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Stock Stalk 2016</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<!--<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
<script src="js/validator.js"></script>


</body>

</html>
