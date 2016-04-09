<html>
<head>
<title>Loading Results</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/load-page.css">
</head>
<body>

    <!---Navbar call----->
    <?php 
        $searchtype = $_POST['searchtype'];
        echo $searchtype;
        if(strcmp($searchtype,"onetoall")==0){
            $ticker1 = $_POST['searchbox1'];
            $sector1 = $_POST['sector1'];
            $fromDate1 = $_POST['from1'];
            $toDate1 = $_POST['to1'];
            
            echo $ticker1;
            echo $sector1;
            echo $fromDate1;
            echo $toDate1;
        }
        if(strcmp($searchtype,"alltoall")==0){
            $sector2 = $_POST['sector2'];
            $fromDate2 = $_POST['from2'];
            $toDate2 = $_POST['to2'];
          
            echo $sector2;
            echo $fromDate2;
            echo $toDate2;
        }
        if(strcmp($searchtype,"specific")==0){
            $ticker2 = $_POST['searchbox2'];
            $fromDate3 = $_POST['from3'];
            $toDate3 = $_POST['to3'];
            
            echo $ticker2;
            echo $fromDate3;
            echo $toDate3;
        }

        

    ?>
    
    <h2 class="quotes">Searching for your stocks...</h2>
    <h2 class="quotes">The hamster's wheels are running, please wait.</h2>
    
    <br>
    
    <center>
          <img src="img/ldin.gif" width="150" height="150" alt="loading, please wait">
    </center>

    <h4>It could take a little while to gather all of your results. There's a lot of stocks to search through to find the perfect match for you! <br> <b>Please do not hit the back button or refresh.</b></h4>
    
    <br>
    
    <center>
    <div id="gameDiv"  style="display:none;" class="answer_list" > Insert games here.</div>
<input id="show_button" type="button" name="answer" value="Play games while you wait?" onclick="showDiv()" />
    </center>
    
    
    
    
    
	<script src="js/app.js" type="text/javascript" charset="utf-8"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<!--<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/quotes.js"></script>
    <script src="js/bootstrap.min.js"></script>


</body>
</html>
