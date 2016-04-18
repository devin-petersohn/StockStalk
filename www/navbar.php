<?php
	session_start();
	$log_display = $_SESSION['username'] ? "Logout" : " ";
	$href_page = $_SESSION['username'] ? "logout.php" : " ";
	
	if (isset( $_POST['Submit'])){
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		
		//sees if username and password are correct
	  if(checkUserPass($username,$password)==1){
	  	$_SESSION['username'] = $username;
	  }else 
	   		echo "<br><div align=center><h4>Invalid username or password,  please try again</h4></div>"; 	
		
  }
  
  function checkUserPass($username,$password) {
		
			//$dbconn =pg_connect("servername=dbhost-mysql.cs.missouri.edu username=mmhkwc password=RgS8HC6L") or die("Could not connect: " . pg_last_error());
      $servername = "dbhost-mysql.cs.missouri.edu";
        $uname = "mmhkwc";
        $pword = "RgS8HC6L";

// Create connection
$dbconn = new mysqli($servername, $uname, $pword);
			
      
      $query="SELECT hashpass, salt FROM mmhkwc.loginInfo WHERE username=?";
//Prepared statement
			$stmt=$dbconn->prepare($query) or die("Query failed");
			$stmt->bind_param("s",$username);
			$stmt->execute() or die ("Query failed");
			$stmt->bind_result($hashpass, $salt);
			$stmt->fetch();
			$hashpw=sha1($salt.$password);
			if($hashpw==$hashpass)
			{
				return 1;
			}
    else{
                return 0;
    }
      
      /*
      
			$query = "SELECT password_hash FROM spices.Users WHERE username LIKE $1";
			pg_prepare($dbconn,"login",$query);
			
			$username = pg_escape_string(htmlspecialchars($username));
			$password = pg_escape_string(htmlspecialchars(sha1($password)));
			$result = pg_execute($dbconn, "login", array($username));
			$line = pg_fetch_array($result, null, PGSQL_ASSOC);
			$pass = $line['password_hash'];
			
	if($pass === $password){   
		return 1;
	}else{
		return 0;
	}
	*/ 
      
	}
	
  
?>	

<html>
<head>

<script src="js/queues.js"></script>    
    </head>
    
    <body>

<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Stock Stalk</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="search.php">Search</a>
                    </li>
                    <li>
                        <a href="chart.php">Chart</a>
                    </li>
                    <li>
                        <a href="portfolio.php">Portfolio</a>
                    </li>
                    
                     </ul>
                    
                    
                    
                    
                      <ul class="nav navbar-nav navbar-right">
        
                    
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>My Stocks</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu pull-right">
                            <li>
                               <div class="row">
                                  <div class="col-md-12">
                                      <p><h4>Stocks in my Portfolio:</h4></p>
                                      
                                    
                                                    
                                     <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                        <div class="checkbox-mystocks">
                                            
                                            <tbody id="addTableRowMS" class="checkbox-queuestocks">

                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                            </tbody>
                                            
                                             
                                        </div>
                                    </form>
                                </div>
                            <div class="bottom text-center">
                            
                                
                                 <div class="form-group">
                                           <button type="submit" class="btn btn-primary btn-block">Chart</button>
                                        </div>
                                
                                
                        </div>
                    </div>
                </li>
                </ul>
                        </li>
                        
                        
                        
                        
                        
                        
        <!-- THE LOGIN BUTTON -->
                        <li class="dropdown navbar-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu pull-right">
                            <li>
                               <div class="row">
                                  <div class="col-md-12">
                                    <div <?php if ($_SESSION['username']){ echo 'style="display:none;"'; } ?>>
                                    Login via
                                    <div class="social-buttons">
                                      <a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
                                      <a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
                                        
                                    </div>
                                                    or
                                    </div>
                                      
                                      
                                      
                                <form class="form-signin" id='login' action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>
                                    <?php  
                                      if($_SESSION['username']){
                                    ?>
			                             <li>
                                      Welcome, <?php echo ucfirst($_SESSION['username']); ?>!
                                   </li>
			                             <?php 

                                      }

                                    ?>
                                    
                                    <li><a href= <?=$href_page?> ><?=$log_display ?></a></li>
                                    <div <?php if ($_SESSION['username']){ echo 'style="display:none;"'; } ?>>
                                         <input type="text" name="username" class="form-control" id="username" placeholder="Username" required autofocus>
                                        </br>
                                        <input type="password" name="password" class="form-control" id="password"placeholder="Password" required>
                                        </br>
                                        <button class="btn btn-lg btn-primary btn-block" type="Submit" name='Submit' value='Submit'>Sign in</button> 
                                       <span class="clearfix"></span>
                                    </div>  
                                      
                                </form>    
                                      
                                      



                                </div>
                                <div <?php if ($_SESSION['username']){ echo 'style="display:none;"'; } ?>>
                                    <div class="bottom text-center">
                              
                                    New here ? <a href="#"><b>Join Us</b></a>
                              
                                    </div>
                                </div>

                    </div>
                </li>
                </ul>
                        </li>
                          
            
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</body>               
                    
  