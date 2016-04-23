<?php
    include "navbar.php";
    include "connect.php";
?>

<!DOCTYPE html>
<head>
    <title>Portfolio</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="js/colorbox/example1/colorbox.css" />
    <link rel="stylesheet" type="text/css" href="css/one-page-wonder.css">

    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


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
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background:#333; color:white;">
                        <h3>Add Stocks to Your Portfolio</h3>
                    </div>
                    <div class="panel-body">
                        <div class="container">
                            <form role="form" action="#" method="POST">
                            <div class="form-group">
                                <?php
                                $getStocks = "SELECT ticker, name FROM stocks ORDER BY ticker ASC ";
                                $result = $dbconn->query($getStocks);
                                 echo "<select class='form-control' name='myTick'>";
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value='".$row['ticker']."'>".$row['ticker']." - ".$row['name']."</option>";
                                     }
                                     echo "</select>";
                                ?>
                                <input name="amount" type="text" class="form-control" placeholder="Amount" aria-describedby="basic-addon1">
                                <input type="submit" name="submit" value="Submit" />
                            </div>
                            </form>
                            <?php
                                if(isset($_POST['submit'])){
                                    $selected_val = $_POST['myTick'];  // Storing Selected Value In Variable
                                    $amount = $_POST['amount'];

                                    $dbconn = new mysqli($servername, $connectUname, $connectPass, $db);
                                    $uname = $_SESSION['username'];
                                    $mes2 = "INSERT INTO portfolio (username, ticker, amount) VALUES('".$uname."', '".$selected_val."', '".$amount."');";
                                    $result = $dbconn->query($mes2);
                                    if($result){
                                        echo $amount ." shares of " .$selected_val." have been added to your portfolio";
                                    }
                                }
                            ?>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background:#333; color:white;">
                        <h3>Delete Stocks from Portfolio</h3>
                    </div>
                    <div class="panel-body">
                        <div class="container">
                            <form role="form" action="#" method="POST">
                            <div class="form-group">
                                <?php
                                $getStocks = "SELECT ticker FROM portfolio WHERE username='".$_SESSION['username']."' ORDER BY ticker ASC ";
                                $result = $dbconn->query($getStocks);
                                 echo "<select class='form-control' name='myTick'>";
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value='".$row['ticker']."'>".$row['ticker']."</option>";
                                     }
                                     echo "</select>";
                                ?>
                                <input type="submit" name="delete" value="Delete" />
                            </div>
                            </form>
                            <?php
                                if(isset($_POST['delete'])){
                                    $delete_val = $_POST['myTick'];  // Storing Selected Value In Variable

                                    $dbconn = new mysqli($servername, $connectUname, $connectPass, $db);
                                    $uname = $_SESSION['username'];
                                    $delStock = "DELETE FROM portfolio WHERE ticker='".$delete_val."';";
                                    $result = $dbconn->query($delStock);
                    
                                }
                            ?>
                        </div>    
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Call to Action Well -->
        <div class="row">
            <div class="col-lg-12">
                 <div class="panel panel-default">
                    <div class="panel-heading" style="background:#333; color:white">
                        <h4>My Stocks</h4>
                        <div class="col-sm-4">
                            
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Ticker</th>
                                        <th>Username</th>
                                        <th>Amount</th>
                                        <th>Name</th>
                                        <th>Sector</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                               <tbody class="tableBody">
                    
                    <?php
                    //Create connection
                    $dbconn = new mysqli($servername, $connectUname, $connectPass, $db);
                    $uname = $_SESSION['username'];
                    $mes2 = "SELECT portfolio.username, portfolio.ticker, portfolio.amount, stocks.name, stocks.sector FROM portfolio INNER JOIN stocks ON portfolio.ticker=stocks.ticker WHERE username='".$uname."';";
                    $result = $dbconn->query($mes2);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr class='odd gradeX'>";
                            echo "<td><a class='tick' name='ticky'>" . $row["ticker"] . "</a></td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["amount"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["sector"] . "</td>";
                            echo "<td><input type='submit' name='delete' value='Delete' onclick='delFromPort()'/></td>";
                        }
                    } else {
                        echo "<tr class='odd gradeX'>";
                        echo "<td><a class='tick'>0 Results Found</a></td>";
                        echo "</tr>";
                    }

                    ?>          

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
    <?php include "footer.html"; ?>   

    </div>

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