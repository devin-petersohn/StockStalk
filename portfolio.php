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
    <link rel="stylesheet" type="text/css" href="js/colorbox/example1/colorbox.css" />
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
    
    <style type="text/css">
        a:hover {
        cursor:pointer;
        }

        a:active {
            color: gray;
        }
        a:visited {
            color: black;
        }
    </style>
    

<script>
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
    


<body onload="GetCellValues()">    
        <!---Navbar call----->


    <!-- Page Content -->
    <div class="container">

        <!-- Heading Row -->
        <div class="row">
           
            <!-- /.col-md-8 -->
            <div class="col-md-12">
                <div class="well charts">
                    <h4 style="text-align:center;">My Portfolio</h4>
                    


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
                        <h4>My Stocks</h4>
                        <div class="col-sm-4">
                            
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
                                <tbody class="tableBody">
                                    <tr class="odd gradeX">

                                        <td><a class="tick">BMW</a></td>
                                        <td class="test-link">BYERISCHE MOTOREN WERKE AG</td>
                                        <td>1 Jan</td>
                                        <td>N/A</td>
                                        <td class="center">0.00$</td>
                                        <td class="center">0.00%</td>
                                        <td class="center">0</td>
                                        <td class="center">X</td>
                                    </tr>
                                    <tr class="even gradeC">
                                        <td><a class="tick">AAPL</a></td>
                                        <td class="test-link">Apple</td>
                                        <td>11 Sep</td>
                                        <td class="center">34.01</td>
                                        <td class="center">0.53</td>
                                        <td class="center">1.53%</td>
                                        <td class="center">8924</td>
                                        <td class="center">X</td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td><a class="tick">GOOG</a></td>
                                        <td class="test-link">Google</td>
                                        <td>1 Jan</td>
                                        <td>N/A</td>
                                        <td class="center">0.00$</td>
                                        <td class="center">0.00%</td>
                                        <td class="center">0</td>
                                        <td class="center">X</td>
                                    </tr>
                                    <tr class="even gradeC">
                                        <td><a class="tick">Z</a></td>
                                        <td class="test-link">Zillow</td>
                                        <td>11 Sep</td>
                                        <td class="center">34.01</td>
                                        <td class="center">0.53</td>
                                        <td class="center">1.53%</td>
                                        <td class="center">8924</td>
                                        <td class="center">X</td>
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
        
    <?php include "footer.html"; ?>   

    </div>
    <!-- /.container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/colorbox/jquery.colorbox-min.js" type="text/javascript" charset="utf-8"></script>

    <script>
        $(".test-link").colorbox({width:"60%", height:"400px", inline:true, href:"#test-content"});
    </script>

<script>
function GetCellValues() {
    $(function () {
        var tickername = [];
        $('.tableBody tr').each(function (i) {
            var customerId = $(this).find(".tick").html();
            tickername.push(customerId);
        });
        //console.log(tickername);
            
    var seriesOptions = [],
    seriesCounter = 0,
    names = tickername;
            
    var url = 'http://query.yahooapis.com/v1/public/yql';
    var startDate = '2015-10-01';
    var endDate = '2016-03-01';
    /**
    * Create the chart when all data is loaded
    * @returns {undefined}
    */
    function createChart() {
    //$('#container').highcharts('StockChart', {
        var chart = new Highcharts.StockChart({
        chart:{
            renderTo: 'container'
        },                
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
        var reformattedArray;
        var array = [];
        var data1 = encodeURIComponent('select * from yahoo.finance.historicaldata where symbol in ("' + name + '") and startDate = "' + startDate + '" and endDate = "' + endDate + '"');
        $.getJSON(url, 'q=' + data1 + "&env=http%3A%2F%2Fdatatables.org%2Falltables.env&format=json", function (data) {
            console.dir(data);
            var stockData = data.query.results.quote;
            //console.log(stockData);
            $.each(stockData, function( key, value ) {
                reformattedArray = $.map(value, function(ky, val) { return ky });
                //console.log(reformattedArray);
                //array = reformattedArray[1];
                var someDate = reformattedArray[1];
                var date = Date.parse(someDate);
                //console.log(date);
                reformattedArray[1] = date;
                reformattedArray[2] = parseFloat(reformattedArray[2]);
                reformattedArray.shift();
                reformattedArray.splice(reformattedArray.length - 5);
                //console.log(reformattedArray);
                array.unshift(reformattedArray);   
            });
            //console.log(array);
            seriesOptions[i] = {
                name: name,
                data: array
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
        
    }

    
    $(".tick").click(function(event) {
        var text = $(event.target).text();
        console.log(text);
        var url = "http://finance.yahoo.com/q?uhb=uh3_finance_vert&fr=&type=2button&s=" + text
        window.open(url,'_blank');
    });
        
    
    </script>



</body>

</html>
