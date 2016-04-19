<?php
    session_start();






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
    
    
    
    
    <script>
$(document).ready(function() {
    $('#loginForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                }
            }
        }
    });
});
</script>

</head>   
<body> 
    <!---Navbar call----->
    <?php include "navbar.php"; ?>

    <!-- Full Width Image Header -->
    <header class="header-image">
            <div class="container">
                
                <h1>Register An Account</h1>
                                
                    <label>Username:</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required autofocus>
                    </br>
                    <label>Password:</label>
                    <input type="password" name="password" class="form-control" id="password"placeholder="Password" required>
                    </br>
                    <label>Verify Password:</label>
                    <input type="password" name="password" class="form-control" id="password"placeholder="Verify Password" required>
                    </br>
                    <label>First Name:</label>
                    <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" required autofocus>
                    </br>
                    <label>Email Address:</label>
					<input type="email" name="email" class="form-control" id="email" placeholder="example@mail.example.edu" value="" required>
                    </br>
                    <label><input type="checkbox" value="">  I agree to the <a href="#">Terms and Conditions</a></label>
                    </br>
                    <button class="btn btn-lg btn-primary btn-block" type="Submit" name='Submit' value='Submit'>Sign in</button> 
                    </br>
                    </br>
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

</body>

</html>
