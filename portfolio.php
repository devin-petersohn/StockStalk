<?php
    session_start();

    include "navbar.php";
    $servername = "dbhost-mysql.cs.missouri.edu";
        $uname = "mmhkwc";
        $pword = "RgS8HC6L";

// Create connection
$dbconn = new mysqli($servername, $uname, $pword);

  
    $uname = $_SESSION['username'];
    $mes2 = "SELECT * FROM mmhkwc.portfolio WHERE username='".$uname."'";
    $result = $dbconn->query($mes2);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "username: " . $row["username"]. " - ticker: " . $row["ticker"]. "<br>";
    }
} else {
    echo "0 results";
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

    <title>Portfolio</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/one-page-wonder.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    
    <script>
        $(function () {
        var seriesOptions = [],
            seriesCounter = 0,
            names = ['MSFT', 'AAPL', 'GOOG'];

        /**
         * Create the chart when all data is loaded
         * @returns {undefined}
         */
        function createChart() {

//            $('#container').highcharts('StockChart', {
            var chart = new Highcharts.StockChart({
                chart:{
                    renderTo: 'container'
                },
//                
                rangeSelector: {
                    selected: 4
                },

                yAxis: {
                    labels: {
                        formatter: function () {
                            return (this.value > 0 ? ' + ' : '') + this.value + '%';
                        }
                    },
                    plotLines: [{
                        value: 0,
                        width: 2,
                        color: 'silver'
                    }]
                },

                plotOptions: {
                    series: {
                        compare: 'percent'
                    }
                },

                tooltip: {
                    pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',
                    valueDecimals: 2
                },

                series: seriesOptions
            });
        }

        $.each(names, function (i, name) {

            $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=' + name.toLowerCase() + '-c.json&callback=?',    function (data) {

                seriesOptions[i] = {
                    name: name,
                    data: data
                };

                // As we're loading the data asynchronously, we don't know what order it will arrive. So
                // we keep a counter and create the chart when all the data is loaded.
                seriesCounter += 1;

                if (seriesCounter === names.length) {
                    createChart();
                }
            });
        });
    });
        
        
        
        //Adding the moving function for stocks//
        
                   var array = [];
            var i;
            function addToMyStocks(name){
//                console.log(name);
                var same = 0;
                console.log(name.innerHTML);
                var tickername = name.innerHTML;
                for(i = 0; i < array.length; i ++){            
                    if(tickername == array[i]){
                        same = 1
                    }
                }
                if(same == 0){
                    $("#addTableRowMS").append("<tr><td><input type='checkbox' class='chartstock' name='chartStock' value='"+tickername+"'> "+ tickername +"</input></td></tr>");
                    array.push(tickername);
                }
//                var appendString = "<tr><td><input type='checkbox' name='chartStock' value='"+tickername+"'> "+ tickername +"</input></td></tr>";
//                console.log(appendString);
                
            }
        
        //End moving function//
        
        
        
        
        
        
        
        
        
        
        
    </script>

</head>
    


<body>

    
    
    
        <!---Navbar call----->
    
    
    
    

    <!-- Page Content -->
    <div class="container">

        <!-- Heading Row -->
        <div class="row">
           
            <!-- /.col-md-8 -->
            <div class="col-md-12">
                <div class="well charts">
                    


                    <div id="container" style="height: 400px; min-width: 310px"></div>
                </div>
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Well -->
        <div class="row">
            <div class="col-lg-12">
                 <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-sm-4">
                            <h4>My Stocks</h4>
                        </div>
                        <div class="align">
                            <button type="button" class="btn btn-success btn-circle"><i class="fa fa-link">Add Stock +</i>
                            </button>
                            <button type="button" class="btn btn-danger btn-circle"><i class="fa fa-heart">Delete Stock -</i>
                            </button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Tracker</th>
                                        <th>Name</th>
                                        <th>Score</th>
                                        <th>Add to Queue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td>1</td>
                                        <td id="name1">BMW</td>
                                        <td>BYERISCHE MOTOREN WERKE AG</td>
                                        <td>.9</td>
                                        <td><button onclick="addToMyStocks(name1)" class="btn">add to queue</button></td>
                                    </tr>
                                    <tr class="even gradeC">
                                        <td>2</td>
                                        <td id="name2">BMW.BE</td>
                                        <td>BMW</td>
                                        <td>.6</td>
                                        <td><button onclick="addToMyStocks(name2)" class="btn">add to queue</button></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>3</td>
                                        <td id="name3">FB</td>
                                        <td>Facebook, Inc</td>
                                        <td>.4</td>
                                        <td><button onclick="addToMyStocks(name3)" class="btn">add to queue</button></td>
                                    </tr>
                                    <tr class="even gradeC">
                                        <td>2</td>
                                        <td id="name4">GOOG</td>
                                        <td>Alphabet Inc</td>
                                        <td>.3</td>
                                        <td><button onclick="addToMyStocks(name4)" class="btn">add to queue</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<!--<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>

</html>
