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
    
    <script>
        
        
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
    <?php include "navbar.php"; ?>
    
    
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
       
        <!--
        <script>
            var array = [];
            var i;
            function addToQueue(name){
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
                    $("#addTableRow").append("<tr><td><input type='checkbox' class='chartstock' name='chartStock' value='"+tickername+"'> "+ tickername +"</input></td></tr>");
                    array.push(tickername);
                }
//                var appendString = "<tr><td><input type='checkbox' name='chartStock' value='"+tickername+"'> "+ tickername +"</input></td></tr>";
//                console.log(appendString);
                
            }
        </script>
        -->
        
        
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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                                    <tr class="odd gradeX">
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
                                    </tr>
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

