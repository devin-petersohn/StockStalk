<html>
<head>
<title>Chart Your Stocks</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<link rel="stylesheet" type="text/css" href="css/one-page-wonder.css">
<link rel="stylesheet" type="text/css" href="js/colorbox/example1/colorbox.css" />
<link rel="stylesheet" type="text/css" href="css/charts.css">
</head>
<body>

    <!---Navbar call-->
    <?php include "navbar.html"; ?>
    
    
	
 <a href="#" id="test-link">Click Me</a>

<div style="display: none;">
 <div id="test-content">
 	<div style="float:left; width:50%; padding: 10px;">
 		<img src="img/stock.png" style="width:100%;">
 	</div>
 	<div style="float:left; width:50%; padding: 10px;">
    	<h1 style="color:black;">Stock Name: </h1>
    	<h1 style="color:black;">Stock Description: </h1>
    	<h1 style="color:black;">Misc Info: </h1>
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="js/colorbox/jquery.colorbox-min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $("#test-link").colorbox({width:"60%", height:"400px", inline:true, href:"#test-content"});
</script>




</body>
</html>
