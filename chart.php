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
    </script>
    
    
    
    
    
    
</head>
<body>

    <!---Navbar call -->
    <?php include "navbar.html"; ?>
    
    
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
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            
                            <div class="checkbox-chart">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <tbody id="addTableRow">
                                   
                                </tbody>
                            </table>
                            </div>

                            <div class="bottom text-center">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Chart</button>
                                 </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->   
       

        <hr>
       
        <script>
            function addToQueue(name){
//                console.log(name);
//                console.log(name.innerHTML);
                var tickername = name.innerHTML;
                var appendString = "<tr><td><input type='checkbox' name='chartStock' value='"+tickername+"'> "+ tickername +"</input></td></tr>";
                console.log(appendString);
                $("#addTableRow").append(appendString);
            }
        </script>
        
        
        
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
                                        <td><button onclick="addToQueue(name1)" class="btn">add to queue</button></td>

                                    </tr>
                                    <tr class="even gradeC">
                                        <td>2</td>
                                        <td id="name2">BMW.BE</td>
                                        <td>BMW</td>
                                        <td>.6</td>
                                        <td><button onclick="addToQueue(name2)" class="btn">add to queue</button></td>

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

