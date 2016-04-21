<?php
    session_start();


if (isset( $_POST['Submit'])){
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$username = htmlspecialchars($_POST['email']);
		//check if the name exists
		if(checkUsername($username)==0)
		{
			addUser($username,$password,$email);               //adds user into database
			$_SESSION['username'] = $username;
			header("Location: home.php");
		}
		else
			echo "Username is already taken taken";
	}
	
	function checkUsername($username){
        
        include "connect.php";
      
      // Create connection
      $dbconn = new mysqli($servername, $connectUname, $connectPass);

      // Check connection
      if ($dbconn->connect_error) {
        die("Connection failed: " . $dbconn->connect_error);
      }
      
      $query="SELECT * FROM mmhkwc.loginInfo WHERE username LIKE ?";
//Prepared statement
			$stmt=$dbconn->prepare($query) or die("Query failed");
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
	
        
        
        /*
		$username = pg_escape_string(htmlspecialchars($username));
		$query = "SELECT * FROM spices.Users where username LIKE $1";
		pg_prepare($dbconn, "check_u_name",$query);
		$result = pg_execute($dbconn,"check_u_name",array($username));
		if(pg_num_rows($result)==0)
			return 0;
		else
			return 1;
            
            */
	}
	function addUser($username,$password, $email){
		
        
        /*
		$username = pg_escape_string(htmlspecialchars($username));
		$password = pg_escape_string(htmlspecialchars(sha1($password)));
		$email = pg_escape_string(htmlspecialchars($email));
		$query = "INSERT INTO spices.Users (username, password_hash, email) VALUES ($1,$2,$3)";
		pg_prepare($dbconn, "add_user_auth",$query);
	
		pg_execute($dbconn,"add_user_auth",array($username,$password, $email));
        
        */
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
    <!---Navbar call----->
    <?php include "navbar.php"; ?>

    <!-- Full Width Image Header -->
    <header class="header-image">
            <div class="container">
                
                <h1>Register An Account</h1>
                                

 <form data-toggle="validator" role="form">
     
    <div class="form-group has-feedback">
    <label for="inputEmail" class="control-label">Email:</label>
    <input type="email" class="form-control" id="inputEmail" placeholder="Email" data-error="That email address is invalid." required>
    <div class="help-block with-errors"></div>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>

  </div>
     
  <div class="form-group">
    <label for="inputName" class="control-label">First Name:</label>
    <input type="text" class="form-control" id="inputName" placeholder="Jane" required>
  </div>
   
     
  <div class="form-group has-feedback">
    <label for="inputPassword" class="control-label">Password:</label>
    <div class="form-group has-feedback">
      <input type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
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
    <button class="btn btn-lg btn-primary btn-block" type="Submit" name='Submit' value='Submit'>Sign in</button> 
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
