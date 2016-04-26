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
    
    <!-- php for receiving the information from search page and for running java program-->
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
            $usr=$_SESSION['username'];
            if(!file_exists('user_data'))
            {
                mkdir('user_data');
            }
            if(!file_exists('user_data/'.$usr))
            {
                mkdir('user_data/'.$usr);
            }

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
            $usr=$_SESSION['username'];
            if(!file_exists('user_data'))
            {
                mkdir('user_data');
            }
            if(!file_exists('user_data/'.$usr))
            {
                mkdir('user_data/'.$usr);
            }
            copy("temp_data/AllvsAll_".$fromDates[0]."_".$fromDates[1]."_".$fromDates[2]."_".$toDates[0]."_".$toDates[1]."_".$toDates[2]."_1.0_Daily_".$ticker1.".json","user_data/".$usr."/AllvsAll_".$fromDates[0]."_".$fromDates[1]."_".$fromDates[2]."_".$toDates[0]."_".$toDates[1]."_".$toDates[2]."_1.0_Daily_".$ticker1.".json");

        }
    ?>
    
    
    
    <script>
        $( document ).ready(function() {
            
            var homeDir = "/~xltz6/capstone/";
            var data = <?php
            $searchtype = $_GET['searchtype'];
            
            //get all data for one to all
            if(strcmp($searchtype,"onetoall")==0){
                $ticker1 = $_GET['tickers'];
                $sector1 = $_GET['sector'];
                $fromDate1 = $_GET['from'];
                $toDate1 = $_GET['to'];
                echo '['.'"'.$ticker1.'",'.'"'.$sector1.'",'.'"'.$fromDate1.'",'.'"'.$toDate1.'",'.'"'.$searchtype.'"'.']';
                // header('chart.php?ticker='.$ticker1."&sector=".$sector1."&from=".$fromDate1."&to=".$toDate1);
            }
            
            //get all data for all to all
            if(strcmp($searchtype,"alltoall")==0){
                // if (isset($_GET["tickers"]) && isset($_GET["from"]) && isset($_GET["to"]) && isset($_GET["sector"]))
                $tickers = $_GET['tickers'];
                $from = $_GET['from'];
                $to = $_GET['to'];
                $sector = $_GET['sector'];
                echo '['.'"'.$tickers.'",'.'"'.$sector.'",'.'"'.$from.'",'.'"'.$to.'",'.'"'.$searchtype.'"'.']';
            }

            //get all data for specific stock
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
        
        //here for showing specific stock
        if(data[3]=="specific"){
            document.getElementById('onetoall').style.display = "none";
            document.getElementById('alltoall').style.display = "none";
            document.getElementById('specific').style.display = "block";
        }
        else{
            var fromDates = data[2].split("-");
            var toDates = data[3].split("-");
            var typeOfSearch="AllvsAll";
            
            //here for showing one to all results
            if(data[4]=="onetoall"){
                document.getElementById('onetoall').style.display = "block";
                document.getElementById('alltoall').style.display = "none";
                document.getElementById('specific').style.display = "none";
                typeOfSearch = "OnevsAll";
                jsonPath = homeDir + "temp_data/" + typeOfSearch + "_" + fromDates[0] + "_" + fromDates[1] + "_"+ fromDates[2] + "_"+ toDates[0] + "_"+ toDates[1] + "_"+ toDates[2] + "_" + data[0] + ".json";
                $.getJSON( jsonPath , function( data ) {
                    var items = [];
                    var num = Object.keys(data).length;
                    console.log(num);
                    var i = 1;
                    $.each( data, function( key, val ) {
                        var keyVal = key;
                        $.ajax({
                            type: 'POST',
                            url:'getName.php',
                            data: {ticker: keyVal},
                            success: function(response){
                                console.log(response);
                                i ++;
                                var temp = "<tr class='odd 'gradeX><td>"+(i-1)+"</td><td id='name"+i+"'>"+key+"</td><td>"+response+"</td><td>"+val+"</td><td><button onclick='addToQueue(name"+i+")' class='btn'>add to queue</button></td><td><button onclick='addToQueueMS(name"+i+")'' class='btn'>＋</button></td></tr>";
                                console.log(temp);

                                $("#ranking").append(temp);
                            },
                            error: function(){
                                alert("Unexpected error! Try again.");
                            }
                        });
    //                    var temp = "<tr class='odd 'gradeX><td>"+i+"</td><td id='name"+i+"'>"+key+"</td><td>"+companyName[i-1]+"</td><td>"+val+"</td><td><button onclick='addToQueue(name"+i+")' class='btn'>add to queue</button></td><td><button onclick='addToQueueMS(name"+i+")'' class='btn'>＋</button></td></tr>";
    //                    items.push( temp);
                    });
                    console.log(items);
                });
            }
            
            
            //here for showing all to all results
            else {
                document.getElementById('onetoall').style.display = "none";
                document.getElementById('alltoall').style.display = "block";
                document.getElementById('specific').style.display = "none";
                tickers = replaceAll(data[0],", ","_");
                console.log(tickers);
                jsonPath = homeDir + "temp_data/" + typeOfSearch + "__" + fromDates[0] + "_" + fromDates[1] + "_"+ fromDates[2] + "_"+ toDates[0] + "_"+ toDates[1] + "_"+ toDates[2] + "_1.0_Daily_" + tickers + ".json";
                console.log(jsonPath);
                $.getJSON( jsonPath , function( data ) {
                    var number_of_results = data.number_of_results;
                    console.log(data.results);
                    for(var i = 0; i < number_of_results; i ++){
                        //console.log(data.results[i]);
                        var items1 = "";
                        $.each( data.results[i], function( key, value ){
                            console.log(value.names);
                            console.log(value);
                            console.log((value.names).length);
                            var header = "<div style='border: 2px solid balck;'><span style='font-size:20px;'>Result "+i+"</span><button style='margin-left:20px;' class='btn btn-sm btn-primary' onclick='gotochart("+i+")'>chart</button></div></div>";
                            items1 = items1.concat(header);
                            var table = "<div style='margin-top:8px;'><table width='100%' class='table table-striped table-bordered table-hover' id='table"+i+"'>";
                            items1 = items1.concat(table);
                            var thead = "<thead><tr><th>Ticker</th><th>Company Name</th><th>Start Date</th><th>Days stays similar</th><th>Add to Queue</th><th>Add to Portfolio</th></tr></thead>"
                            items1 = items1.concat(thead);
                            var tickernames = value.names;
                            var ticker_number = (value.names).length;
                            var date_start = value["Date Start"];
                            date_start = date_start.split(",")[0];
                            date_start = date_start.substring(1);
                            var Number_of_Intervals = value["Number of Intervals"];
                            var tbody = "<tbody>";
                            items1 = items1.concat(tbody);
                            for(var j = 0; j < ticker_number; j ++){
                                var temp = "<tr><td id='name"+i+"_"+j+"'>"+value.names[j]+"</td><td>unknown</td><td>"+date_start+"</td><td>"+Number_of_Intervals+"</td><td><button onclick='addToQueue(name"+i+"_"+j+")' class='btn'>add to queue</button></td><td><button onclick='addToQueueMS(name"+i+"_"+j+")'' class='btn'>＋</button></td></tr>";
                                items1 = items1.concat(temp);
                            }  
                            var endtbody = "</tbody>";
                            items1 = items1.concat(endtbody);
                            var endtable = "</table></div>";
                            items1 = items1.concat(endtable);
                            var space = "<br>"
                            items1 = items1.concat(space);

                        });

                        //console.log(items1);
                        $(".alltoallresults").append(items1);

                     }
                });
            }


        }
    });
    </script>
    
    <script>
        //finish showing part start charting
        //all to all chart part
        function gotochart(number){
            $(function () {
                var startdate;
                var enddate;
                var tickernames=[];
                var Number_of_Intervals;
                 var homeDir = "/~xltz6/capstone/";
            var data = <?php
            $searchtype = $_GET['searchtype'];
            
            //get all data for one to all
            if(strcmp($searchtype,"onetoall")==0){
                $ticker1 = $_GET['tickers'];
                $sector1 = $_GET['sector'];
                $fromDate1 = $_GET['from'];
                $toDate1 = $_GET['to'];
                echo '['.'"'.$ticker1.'",'.'"'.$sector1.'",'.'"'.$fromDate1.'",'.'"'.$toDate1.'",'.'"'.$searchtype.'"'.']';
                // header('chart.php?ticker='.$ticker1."&sector=".$sector1."&from=".$fromDate1."&to=".$toDate1);
            }
            
            //get all data for all to all
            if(strcmp($searchtype,"alltoall")==0){
                // if (isset($_GET["tickers"]) && isset($_GET["from"]) && isset($_GET["to"]) && isset($_GET["sector"]))
                $tickers = $_GET['tickers'];
                $from = $_GET['from'];
                $to = $_GET['to'];
                $sector = $_GET['sector'];
                echo '['.'"'.$tickers.'",'.'"'.$sector.'",'.'"'.$from.'",'.'"'.$to.'",'.'"'.$searchtype.'"'.']';
            }

            //get all data for specific stock
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
                var fromDates = data[2].split("-");
                var toDates = data[3].split("-");
                data[0] = replaceAll(data[0],", ","_");
                jsonPath = homeDir + "temp_data/AllvsAll__" + fromDates[0] + "_" + fromDates[1] + "_"+ fromDates[2] + "_"+ toDates[0] + "_"+ toDates[1] + "_"+ toDates[2] + "_1.0_Daily_" + tickers + ".json";
                $.getJSON( jsonPath, function( data ) {
                    var number_of_results = data.number_of_results;
                    console.log(number_of_results);
                    $.each( data.results[number], function( key, value ){
                        var ticker_number = (value.names).length;
                        for(var j = 0; j< ticker_number; j ++){
                            tickernames.push(value.names[j]);
                        }
                        console.log(tickernames);
                        console.log(value["Date Start"]);
                        var date_start = value["Date Start"];
                        date_start = date_start.split(",")[0];
                        date_start = date_start.substring(1);
                        var datestart = new Date(date_start);
                        
                        
                        var month = datestart.getMonth() + 1;
                        month = (month < 10) ? "0"+month : month;
                        var year = datestart.getFullYear();
                        var date = datestart.getDate();
                        date = (date < 10) ? "0"+date : date;
                        startdate = year+"-"+month+"-"+date;
                        console.log(year+"-"+month+"-"+date);
                        
                        var Number_of_Intervals = value["Number of Intervals"];
                        
                        var dateend = datestart;
                        dateend.setDate(dateend.getDate() + Number(Number_of_Intervals));
                        
                        month = dateend.getMonth() + 1;
                        month = (month < 10) ? "0"+month : month;
                        year = dateend.getFullYear();
                        date = dateend.getDate();
                        date = (date < 10) ? "0"+date : date;
                        enddate = year+"-"+month+"-"+date;
                    });
                    console.log(startdate);
                    console.log(enddate);
                    var seriesOptions = [],
                    seriesCounter = 0,
                    names = tickernames;

                    var url = 'http://query.yahooapis.com/v1/public/yql';

                    var startDate = startdate;
                    var endDate = enddate;
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

//                                rangeSelector: {
//                                    selected: 0
//                                },

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
        }
        
        
        
        //chart for on specific stock
        function chartSpecificStock(){
            var specificTicker = [];
            specificTicker.push("<?php echo $ticker2; ?>");
            $(function () {
                var seriesOptions = [],
                seriesCounter = 0,
                names = specificTicker;

                var url = 'http://query.yahooapis.com/v1/public/yql';

                var startDate = "<?php echo $fromDate3; ?>";
                var endDate = "<?php echo $toDate3; ?>";
                function createChart() {

        //            $('#container').highcharts('StockChart', {
                    var chart = new Highcharts.StockChart({
                        chart:{
                            renderTo: 'container'
                        },

//                                rangeSelector: {
//                                    selected: 0
//                                },

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
        }
        
        
        
        //queued stock chart part
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
            
            var startDate = '2015-03-01';
            var endDate = '2016-04-01';
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
        
        
    //function to add to portfolio page  
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
            data: {action:'add', tickername: tickername, username: user}, 
            dataType: "json",
            success: function(response){
                alert(response.msg);
            },
            error: function(){
                alert("Unexpected error! Try again.");
            }
            });
    }
    
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
       

        
        
        <!-- Call to Action Well -->
        <div class="row">
            <div class="col-lg-12" id="onetoall" style="display:none;">
                
                <!--Results for ONE TO ALL-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Stocks that have similar movement as <?php echo $ticker1;?></h4>
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="ranking">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Ticker</th>
                                        <th>Name</th>
                                        <th>Score</th>
                                        <th>Add to Queue</th>
                                        <th>Add to Portfolio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
                                    
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
            
            
            <!--Results for ALL TO ALL-->
            <div class="col-lg-12" id="alltoall" style="display:none;">
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Stocks that have similar movement in specific time period</h4>
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper alltoallresults">
                            
                                
                            
                            
                            
                            
                            
                        </div>
                    </div>
                </div>
                
            </div>   
                
            <!--Results for ONE SPECIFIC STOCK-->
            <div class="col-lg-12" id="specific" style="display:none;">
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Stock Information</h4>
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="ranking">
                                <thead>
                                    <tr>
                                        <th>Ticker</th>
                                        <th>Company Name</th>
                                        <th>Chart</th>
                                        <th>Add to Queue</th>
                                        <th>Add to Portfolio</th>
                                    </tr>
                                    <tr>
                                        <td id="specific_<?php echo $ticker2; ?>"><?php echo $ticker2; ?></td>
                                        <td><?php 
                                        include "connect.php";
                                        
                                        if($dbconn){
                                            $sql = "SELECT name from xltz6.stocks where ticker ='".$ticker2."'";
            
                                            if($res = $dbconn->query($sql)){
                                                while ($row = $res->fetch_assoc()) {
                                                    echo $row["name"];
                                                }
                                            }
                                        } 
                                        ?></td>
                                        <td><button onclick="chartSpecificStock()" class="btn btn-success-outline">Chart</button></th>
                                        <td><button onclick="addToQueue(specific_<?php echo $ticker2; ?>)" class="btn btn-success-outline">add to queue</button></td>
                                        <td><button onclick="addToQueueMS(specific_<?php echo $ticker2; ?>)" class="btn btn-success-outline">＋</button></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
                                    
                                    
                                    
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

