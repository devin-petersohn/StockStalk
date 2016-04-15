

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
        <!-- THE MY STOCKS BUTTON ----------------------->
                    <!--Bare Bones
                    <li class="dropdown right-login">
                        
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>My Stocks</b> <span class="caret"></span></a> 
                        
                    </li>   ---------->
                    
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
                        
                        
                        
                        
                        
                        
        <!-- THE LOGIN BUTTON ----------------------->
                        <li class="dropdown navbar-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu pull-right">
                            <li>
                               <div class="row">
                                  <div class="col-md-12">
                                    Login via
                                    <div class="social-buttons">
                                      <a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
                                      <a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
                                        
                                    </div>
                                                    or
                                     <form class="form" role="form" method="post" action="fun.php" accept-charset="UTF-8" id="login-nav">
                                        <div class="form-group">
                                           <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                           <input name="username" class="form-control" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                           <label class="sr-only" for="exampleInputPassword2">Password</label>
                                           <input name="password" type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                                                 <div class="help-block text-right"><a href="">Forget the password ?</a></div>
                                        </div>
                                        <div class="form-group">
                                           <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                        </div>
                                        <div class="checkbox">
                                           <label>
                                           <input type="checkbox"> keep me logged-in
                                           </label>
                                        </div>
                                    </form>
                                </div>
                            <div class="bottom text-center">
                            New here ? <a href="#"><b>Join Us</b></a>
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