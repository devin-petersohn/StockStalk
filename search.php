<html>
<head>
<title>Chart Your Stocks</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<link rel="stylesheet" type="text/css" href="css/one-page-wonder.css">
<link rel="stylesheet" type="text/css" href="css/charts.css">
</head>
<body>

    <!---Navbar call----->
    <?php include "navbar.html"; ?>
    
    
	<h1>Search Your Stocks</h1>
	<ul id="imageGallery">
		<li><a href="stock.jpg"><img src="stock.jpg" width="100" alt="Stocks"></a></li>
	</ul>

	<script src="js/app.js" type="text/javascript" charset="utf-8"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<!--<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->
    <!-- jquery for datepicker -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    
    <script>
        function showDiv1() {
            document.getElementById('oneToAll').style.display = "block";
            document.getElementById('allToAll').style.display = "none";
        }
        function showDiv2() {
            document.getElementById('allToAll').style.display = "block";
            document.getElementById('oneToAll').style.display = "none";
        }
        
        $(function() {
            $( "#from1" ).datepicker({
                defaultDate: "-1w",
                changeMonth: true,
                dateFormat: "yy-mm-dd",
                numberOfMonths: 3,
                maxDate: "-2d",
                minDate: "-5y",
                showOptions: { direction: "down" },
                onClose: function( selectedDate ) {
                $( "#to1" ).datepicker( "option", "minDate", selectedDate );
            }
        });
            $( "#to1" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                dateFormat: "yy-mm-dd",
                numberOfMonths: 3,
                maxDate: -1,
                showOptions: { direction: "down" },
                onClose: function( selectedDate ) {
                $( "#from1" ).datepicker( "option", "maxDate", selectedDate );
                }
            });
            $( "#from2" ).datepicker({
                defaultDate: "-1w",
                changeMonth: true,
                dateFormat: "yy-mm-dd",
                numberOfMonths: 3,
                maxDate: "-2d",
                minDate: "-5y",
                showOptions: { direction: "down" },
                onClose: function( selectedDate ) {
                $( "#to2" ).datepicker( "option", "minDate", selectedDate );
            }
        });
            $( "#to2" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                dateFormat: "yy-mm-dd",
                numberOfMonths: 3,
                maxDate: -1,
                showOptions: { direction: "down" },
                onClose: function( selectedDate ) {
                $( "#from2" ).datepicker( "option", "maxDate", selectedDate );
                }
            });
      });
      </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <br><br>
    <div class="container">
        <div class="row" >
            <div class="col-md-12" style="text-align:center"> 
                <h3>Find similar stock</h3>
                <button class="btn btn-primary" onclick="showDiv1()">Compare all stocks</button>
                
                <button class="btn btn-primary" onclick="showDiv2()">Compare one stock with all others</button>
            </div>
        </div>
        <br><br>
        
        <!-- one to all section -->
        <div class="row" id="oneToAll"  style="display:none;">
            
            <!-- Search box -->
            <div id="custom-search-input">
                <form action="load.php" method="POST" id="search">
                    <div class="input-group col-sm-6 col-sm-offset-3">
                        <input type="text" class="search-query form-control" name="searchbox" placeholder="Search"></input>
                        <span class="input-group-btn">
                            <button style="height:34px;" class="btn btn-primary" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            
            <br>
            <!-- select sector-->
            <div class="input-group col-sm-6 col-sm-offset-3">
                <h4>Market Sector</h4>
                <select style="width:100%;height:25px; text-align: left;"  form="search" name="sector" class="btn btn-default" type="button">
                    <option value="All">All</option>
                    <option value="Technology">Technology</option>
                    <option value="Finance">Finance</option>
                    <option value="Consumer">Consumer Goods</option>
                    <option value="Automotive">Automotive</option>
                    <option value="Conglomerates">Conglomerates</option>
                    <option value="Energy">Energy</option>
                    <option value="Utilities">Utilities</option>
                </select>
            </div>
            <br>
            <br>
            <!-- choose time period-->
            <div style="height:200px;" class="input-group col-sm-6 col-sm-offset-3">
                <h4>Choose a time period</h4>
                
                <label for="from">From</label>
                <input style="margin-left: 5px;" type="text" id="from1" name="from" form="search">
                <label style="margin-left: 10px;" for="to">to</label>
                <input style="margin-left: 5px;" type="text" id="to1" name="to" form="search">
            </div>
                
        </div>
    </div>
    
    
    <div class="row" id="allToAll"  style="display:none;">
            
            
            <!-- select sector-->
            <div class="input-group col-sm-6 col-sm-offset-3">
                <h4>Market Sector</h4>
                <select style="width:100%;height:25px; text-align: left;"  form="search" name="sector" class="btn btn-default" type="button">
                    <option value="All">All</option>
                    <option value="Technology">Technology</option>
                    <option value="Finance">Finance</option>
                    <option value="Consumer">Consumer Goods</option>
                    <option value="Automotive">Automotive</option>
                    <option value="Conglomerates">Conglomerates</option>
                    <option value="Energy">Energy</option>
                    <option value="Utilities">Utilities</option>
                </select>
            </div>
            <br>
            <br>
            <!-- choose time period-->
            <div style="height:200px;" class="input-group col-sm-6 col-sm-offset-3">
                <h4>Choose a time period</h4>
                
                <label for="from">From</label>
                <input style="margin-left: 5px;" type="text" id="from2" name="from" form="search">
                <label style="margin-left: 10px;" for="to">to</label>
                <input style="margin-left: 5px;" type="text" id="to2" name="to" form="search">
                <button class="btn btn-primary" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
                
            </div>
                
        </div>
    </div>
    
   
</body>
</html>

