<html>
<head>
<title>Loading Results</title>
<script src="js/jquery-2.2.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/load-page.css">
</head>
<body>


 
    <div id="loading"> 
    <h2 class="quotes">Searching for your stocks...</h2>
    <h2 class="quotes">The hamster's wheels are running, please wait.</h2>
    
    <br>
    
    <center>
          <img src="img/ldin.gif" width="150" height="150" alt="loading, please wait">
    </center>

    <h4>It could take a little while to gather all of your results. There's a lot of stocks to search through to find the perfect match for you! <br> <b>Please do not hit the back button or refresh.</b></h4>
    
    <br>
    </div>
    <center>
    <div id="gameDiv"  style="display:none;" class="answer_list" > Insert games here.</div>
<input id="show_button" type="button" name="answer" value="Play games while you wait?" onclick="showDiv()" />
    </center>

    <script type="text/javascript">
        var data = <?php
            $searchtype = $_GET['searchtype'];
            // echo $searchtype;
            if(strcmp($searchtype,"onetoall")==0){
                $ticker1 = $_GET['searchbox1'];
                $sector1 = $_GET['sector1'];
                $fromDate1 = $_GET['from1'];
                $toDate1 = $_GET['to1'];
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
            $ticker2 = $_GET['searchbox2'];
            $fromDate3 = $_GET['from3'];
            $toDate3 = $_GET['to3'];
            echo $_GET['ticker'];
            echo '['.'"'.$ticker2.'",'.'"'.$fromDate3.'",'.'"'.$toDate3.'",'.'"'.$searchtype.'"'.']';
          
        }
         ?>;
         console.log(data);
         if(data[3]=="specific")
         {
            window.location.href = "chart.php?tickers=" + data[0] + "&from=" + data[1] + "&to=" +data[2] + "&searchtype="+ data[3];
         }
         else
            window.location.href = "chart.php?tickers=" + data[0] + "&from=" + data[2] + "&to=" +data[3] + "&sector=" + data[1] + "&searchtype="+ data[4];
    </script>
       <?php 
        // $searchtype = $_GET['searchtype'];
        // echo $searchtype;
        // if(strcmp($searchtype,"onetoall")==0){
        //     $ticker1 = $_POST['searchbox1'];
        //     $sector1 = $_POST['sector1'];
        //     $fromDate1 = $_POST['from1'];
        //     $toDate1 = $_POST['to1'];
        //     header('chart.php?ticker='.$ticker1."&sector=".$sector1."&from=".$fromDate1."&to=".$toDate1);
        //     exit();

        // }
        

        

    ?>
    
    
    
    
    
	<script src="js/app.js" type="text/javascript" charset="utf-8"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<!--<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/quotes.js"></script>
    <script src="js/bootstrap.min.js"></script>


</body>
</html>
