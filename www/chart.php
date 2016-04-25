<?php
    session_start();
?>

<html>
<head>
<title>Chart Your Stocks</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<link rel="stylesheet" type="text/css" href="css/one-page-wonder.css">
<link rel="stylesheet" type="text/css" href="css/charts.css">
    
    
    
    
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
    <script src="js/queues.js"></script>
    <?php
        $searchtype = $_GET['searchtype'];
        if(strcmp($searchtype,"onetoall")==0){
            $ticker1 = $_GET['tickers'];
            $sector1 = $_GET['sector'];
            $fromDate1 = $_GET['from'];
            $toDate1 = $_GET['to'];
            $fromDates = explode("-", $fromDate1);
            $toDates = explode("-", $toDate1);

            $homeDir = "/home/".get_current_user()."/StockStalk";
            // shell_exec("spark-submit --class Search /home/`whoami`/StockStalk/One_Against_All/target/stockstalk-1.0-SNAPSHOT.jar ".$fromDates[0]." ".$fromDates[1]." ".$fromDates[2]." ".$toDates[0]." ".$toDates[1]." ".$toDates[2]." ".$ticker1);
            chdir($homeDir);
            shell_exec("spark-submit --master local[4] --class Search One_Against_All/target/stockstalk-1.0-SNAPSHOT.jar ".$fromDates[0]." ".$fromDates[1]." ".$fromDates[2]." ".$toDates[0]." ".$toDates[1]." ".$toDates[2]." ".$ticker1);

        }
        if(strcmp($searchtype,"alltoall")==0){
            $ticker1 = $_GET['tickers'];
            $ticker1 = str_replace(","," ",$ticker1);
            $sector1 = $_GET['sector'];
            $fromDate1 = $_GET['from'];
            $toDate1 = $_GET['to'];
            $fromDates = explode("-", $fromDate1);
            $toDates = explode("-", $toDate1);

            $homeDir = "/home/".get_current_user()."/StockStalk";
            // shell_exec("spark-submit --class Search /home/`whoami`/StockStalk/One_Against_All/target/stockstalk-1.0-SNAPSHOT.jar ".$fromDates[0]." ".$fromDates[1]." ".$fromDates[2]." ".$toDates[0]." ".$toDates[1]." ".$toDates[2]." ".$ticker1);
            chdir($homeDir);
            shell_exec("spark-submit --class ScalaTest All_Against_All/target/stockStalk-1.0-SNAPSHOT.jar ".$fromDates[0]." ".$fromDates[1]." ".$fromDates[2]." ".$toDates[0]." ".$toDates[1]." ".$toDates[2]." "."1.0 "."Daily ".$ticker1);

        }
    ?>
    
    <script>
        $( document ).ready(function() {
            
            var homeDir = "/";
            var data = <?php
            $searchtype = $_GET['searchtype'];
            // echo $searchtype;
            if(strcmp($searchtype,"onetoall")==0){
                $ticker1 = $_GET['tickers'];
                $sector1 = $_GET['sector'];
                $fromDate1 = $_GET['from'];
                $toDate1 = $_GET['to'];
                echo '['.'"'.$ticker1.'",'.'"'.$sector1.'",'.'"'.$fromDate1.'",'.'"'.$toDate1.'",'.'"'.$searchtype.'"'.']';
                // header('chart.php?ticker='.$ticker1."&sector=".$sector1."&from=".$fromDate1."&to=".$toDate1);

        }
        if(strcmp($searchtype,"alltoall")==0){
            // if (isset($_GET["tickers"]) && isset($_GET["from"]) && isset($_GET["to"]) && isset($_GET["sector"]))
            // {
                $tickers = $_GET['tickers'];
                $from = $_GET['from'];
                $to = $_GET['to'];
                $sector = $_GET['sector'];
                echo '['.'"'.$tickers.'",'.'"'.$sector.'",'.'"'.$from.'",'.'"'.$to.'",'.'"'.$searchtype.'"'.']';
            // }
        }
        if(strcmp($searchtype,"specific")==0){
            $ticker2 = $_GET['tickers'];
            $fromDate3 = $_GET['from'];
            $toDate3 = $_GET['to'];
            echo $_GET['ticker'];
            echo '['.'"'.$ticker2.'",'.'"'.$fromDate3.'",'.'"'.$toDate3.'",'.'"'.$searchtype.'"'.']';
          
        }
        if(strcmp($searchtype,"")==0){
            echo "[]";
        }
         ?>;
         console.log(data);
         var jsonPath = "";
         function replaceAll(str, find, replace) {
          return str.replace(new RegExp(find, 'g'), replace);
        }

            if(data[3]=="specific")
            {
                var tickername = data[0];
                var tickerList = [];
                tickerList.push(tickername);
                console.log(tickerList);
                var seriesOptions = [];
                seriesCounter = 0;
                names = tickerList;
                var url = 'http://query.yahooapis.com/v1/public/yql';
                var startDate = data[1];
                var endDate = data[2];
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
    //                    array = reformattedArray[1];
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
            }
            else{
                fromDates = data[2].split("-");
                toDates = data[3].split("-");
                var typeOfSearch="AllvsAll";
                if(data[4]=="onetoall")
                {
                    typeOfSearch = "OnevsAll";
                    jsonPath = homeDir + "temp_data/" + typeOfSearch + "_" + fromDates[0] + "_" + fromDates[1] + "_"+ fromDates[2] + "_"+ toDates[0] + "_"+ toDates[1] + "_"+ toDates[2] + "_" + data[0] + ".json";
                }
                else {
                    tickers = replaceAll(data[0],", ","_");
                    console.log(tickers);
                    jsonPath = homeDir + "temp_data/" + typeOfSearch + "__" + fromDates[0] + "_" + fromDates[1] + "_"+ fromDates[2] + "_"+ toDates[0] + "_"+ toDates[1] + "_"+ toDates[2] + "_1.0_Daily_" + tickers + ".json";
            
                }

                console.log(jsonPath);
                $.getJSON( jsonPath, function( data ) {
                var items = [];
                var i= 1;
                $.each( data, function( key, val ) {
                    var temp = "<tr class='odd 'gradeX><td>"+i+"</td><td id='name"+i+"'>"+key+"</td><td>Unknown</td><td>"+val+"</td><td><button onclick='addToQueue(name"+i+")' class='btn'>add to queue</button></td><td><button onclick='addToQueueMS(name"+i+")'' class='btn'>＋</button></td></tr>";
                    items.push( temp);
                    i++;
                    
                });
                $("#ranking").append(items);

                console.log(items);
                });
             
            
        }
        });


        $(function () {
        $('#chartform').submit(function (event) {
            event.preventDefault();
            var tickername = [];
            $('.chartstock').each(function (i) {
                    if(this.checked){
                        var name = $(this).val();
                        tickername.push(name);
                }
            });
            console.log(tickername);
            
        
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
    //                    array = reformattedArray[1];
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
    });
    </script>
    
    
    
    
    
    
</head>
<body>

    <!---Navbar call -->
    <?php 
        include "navbar.php";
        $user = $_SESSION['username'];
    ?>
    
    
	<h1>Chart Your Stocks</h1>

    
    
    <!-- Page Content -->
    <div class="container">

        <!-- Heading Row -->
        <div class="row">
           
            <!-- /.col-md-9 -->
            <div class="col-md-9">
                <div class="well charts">
                    <div id="container" style="height: 400px; min-width: 310px"></div>
                </div>
            </div>
            
            
            <!-- /.col-md-3 -->
            <div class="col-md-3">
                <div class="panel panel-default" style="height: 440px">
                    <div class="panel-heading">
                        <h4>Queued Stocks</h4>
                    </div>
                    <div class="panel-body moveup">
                        <div class="dataTable_wrapper">
                            <form action="" method="POST" id="chartform">
                                <div class="checkbox-chart">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <div class="delete-btn" onclick="toggle_visibility('hideMe')"><button>Delete</button></div>
                                    
                                    <tbody id="addTableRow" class="checkbox-queuestocks">

                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </tbody>
                                    
                                </table>
                                </div>

                                <div class="bottom text-center">
                                    <div class="form-group">
                                      <input name="submit" class="btn btn-primary btn-block" type="submit" value="Chart" />
                                    
                                     </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->   
       

        <hr>
       

        <script>
        var arrayMS = [];
        var m;
        var user = "<?php echo $user; ?>"
        function addToQueueMS(name){
            var same = 0;
            var tickername = name.innerHTML;
            for(m = 0; m < arrayMS.length; m ++){            
                if(tickername == arrayMS[m]){
                    same = 1
                }
            }
            if(same == 0){
                $("#addTableRowMS").append("<tr><td><input type='checkbox' class='chartstock' name='chartStock' value='"+tickername+"'> "+ tickername +"</input></td></tr>");
                arrayMS.push(tickername);
                console.log(name.innerHTML);
            }
            $.ajax({
                type: "POST",
                url: "PortfolioAdd.php",
                data: {action:"add", tickername: tickername, username: user}, 
                success: function(response){
                    alert(response);
                },
                error: function(){
                    alert("Unexpected error. Try again");
                }
                });
        }

        </script>
        
        <!-- Call to Action Well -->
        <div class="row">
            <div class="col-lg-12">
                
                <!--Results for ONE TO ALL-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-sm-4">
                            <h4>My Stocks</h4>
                        </div>
                        <div class="align">

                           <button type="button" class="btn btn-danger btn-circle"><i class="fa fa-heart">Delete Stock -</i>

                            </button>
                            
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="ranking">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Tracker</th>
                                        <th>Name</th>
                                        <th>Score</th>
                                        <th>Add to Queue</th>
                                        <th>Add to Portfolio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--<tr class="odd gradeX">
                                        <td>1</td>
                                        <td id="name1">BMW</td>
                                        <td>BYERISCHE MOTOREN WERKE AG</td>
                                        <td>.9</td>
                                        <td><button onclick="addToQueue(name1)" class="btn">add to queue</button></td>
                                        <td><button onclick="addToQueueMS(name1)" class="btn">X</button></td>
                                    </tr>
                                    <tr class="even gradeC">
                                        <td>2</td>
                                        <td id="name2">BMW.BE</td>
                                        <td>BMW</td>
                                        <td>.6</td>
                                        <td><button onclick="addToQueue(name2)" class="btn">add to queue</button></td>
                                        <td><button onclick="addToQueueMS(name2)" class="btn">X</button></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>3</td>
                                        <td id="name3">FB</td>
                                        <td>Facebook, Inc</td>
                                        <td>.4</td>
                                        <td><button onclick="addToQueue(name3)" class="btn">add to queue</button></td>
                                        <td><button onclick="addToQueueMS(name3)" class="btn">X</button></td>
                                    </tr>
                                    <tr class="even gradeC">
                                        <td>2</td>
                                        <td id="name4">GOOG</td>
                                        <td>Alphabet Inc</td>
                                        <td>.3</td>
                                        <td><button onclick="addToQueue(name4)" class="btn">add to queue</button></td>
                                        <td><button onclick="addToQueueMS(name4)" class="btn">X</button></td>
                                    </tr>
                                                                        <tr class="odd gradeX">
                                        <td>1</td>
                                        <td id="name5">test1</td>
                                        <td>BYERISCHE MOTOREN WERKE AG</td>
                                        <td>.9</td>
                                        <td><button onclick="addToQueue(name5)" class="btn">add to queue</button></td>
                                        <td><button onclick="addToQueueMS(name5)" class="btn">X</button></td>
                                    </tr>
                                    <tr class="even gradeC">
                                        <td>2</td>
                                        <td id="name6">test2</td>
                                        <td>BMW</td>
                                        <td>.6</td>
                                        <td><button onclick="addToQueue(name6)" class="btn">add to queue</button></td>
                                        <td><button onclick="addToQueueMS(name6)" class="btn">X</button></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>3</td>
                                        <td id="name7">test3</td>
                                        <td>Facebook, Inc</td>
                                        <td>.4</td>
                                        <td><button onclick="addToQueue(name7)" class="btn">add to queue</button></td>
                                        <td><button onclick="addToQueueMS(name7)" class="btn">X</button></td>
                                    </tr>
                                    <tr class="even gradeC">
                                        <td>2</td>
                                        <td id="name8">test4</td>
                                        <td>Alphabet Inc</td>
                                        <td>.3</td>
                                        <td><button onclick="addToQueue(name8)" class="btn">add to queue</button></td>
                                        <td><button onclick="addToQueueMS(name8)" class="btn">X</button></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>3</td>
                                        <td id="name9">test5</td>
                                        <td>Facebook, Inc</td>
                                        <td>.4</td>
                                        <td><button onclick="addToQueue(name9)" class="btn">add to queue</button></td>
                                        <td><button onclick="addToQueueMS(name9)" class="btn">X</button></td>
                                    </tr>
                                    <tr class="even gradeC">
                                        <td>2</td>
                                        <td id="name10">test6</td>
                                        <td>Alphabet Inc</td>
                                        <td>.3</td>
                                        <td><button onclick="addToQueue(name10)" class="btn">add to queue</button></td>
                                        <td><button onclick="addToQueueMS(name10)" class="btn">X</button></td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!--Results for ALL TO ALL-->
                
                
                <!--Results for ONE SPECIFIC STOCK-->
                
                
                
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>

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

