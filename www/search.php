<?php
    session_start();
?>
<html>
<head>
<title>Chart Your Stocks</title>
<script src="js/jquery-2.2.3.min.js"></script>


</head>
<body>

    <?php include "navbar.php"; ?>    
	<h1>Search Your Stocks</h1>
	<ul id="imageGallery">
		<li><a href="stock.jpg"><img src="stock.jpg" width="100" alt="Stocks"></a></li>
	</ul>

    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/one-page-wonder.css">
    <link rel="stylesheet" type="text/css" href="css/charts.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="js/app.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>


    <script>

        function showDiv1() {
            document.getElementById('oneToAll').style.display = "block";
            document.getElementById('allToAll').style.display = "none";
            document.getElementById('specific').style.display = "none";
        }
        function showDiv2() {
            document.getElementById('allToAll').style.display = "block";
            document.getElementById('oneToAll').style.display = "none";
            document.getElementById('specific').style.display = "none";
        }
        function showDiv3() {
            document.getElementById('allToAll').style.display = "none";
            document.getElementById('oneToAll').style.display = "none";
            document.getElementById('specific').style.display = "block";
        }
        
        $(function() {

            var arrRecord=[];
             $(document).ready(function() {
                
                $('#filtering').multiselect({
                    includeSelectAllOption: true,
                    enableFiltering: true
                //     onChange: function(element, checked) {
                //     if (checked ===;\ true) {
                //         //action taken here if true
                //         arrRecord = arrRecord+element;
                //         console.log(arrRecord);

                //     }
                // }
                    });
            });
             
        


        var tickers = ["MMM", "ABT", "ABBV", "ACN", "ATVI", "ADBE", "ADT", "AAP", "AES", "AET", "AFL", "AMG", "A", "GAS", "APD", "ARG", "AKAM",
                        "AA", "AGN", "ALXN", "ALLE", "ADS", "ALL", "GOOGL", "GOOG", "MO", "AMZN", "AEE", "AAL", "AEP", "AXP", "AIG", "AMT", "AMP",
                        "ABC", "AME", "AMGN", "APH", "APC", "ADI", "AON", "APA", "AIV", "AAPL", "AMAT", "ADM", "AIZ", "T", "ADSK", "ADP", "AN", "AZO",
                        "AVGO", "AVB", "AVY", "BHI", "BLL", "BAC", "BK", "BCR", "BXLT", "BAX", "BBT", "BDX", "BBBY", "BRK-B", "BBY", "BIIB", "BLK",
                        "HRB", "BA", "BWA", "BXP", "BSX", "BMY", "BF-B", "CHRW", "CA", "CVC", "COG", "CAM", "CPB", "COF", "CAH", "HSIC", "KMX", "CCL",
                        "CAT", "CBG", "CBS", "CELG", "CNP", "CTL", "CERN", "CF", "SCHW", "CHK", "CVX", "CMG", "CB", "CHD", "CI", "XEC", "CINF", "CTAS",
                        "CSCO", "C", "CTXS", "CLX", "CME", "CMS", "COH", "KO", "CCE", "CTSH", "CL", "CPGX", "CMCSA", "CMA", "CAG", "CXO", "COP", "CNX",
                        "ED", "STZ", "GLW", "COST", "CCI", "CSRA", "CSX", "CMI", "CVS", "DHI", "DHR", "DRI", "DVA", "DE", "DLPH", "DAL", "XRAY", "DVN",
                        "DO", "DFS", "DISCA", "DISCK", "DG", "DLTR", "D", "DOV", "DOW", "DPS", "DTE", "DD", "DUK", "DNB", "ETFC", "EMN", "ETN", "EBAY",
                        "ECL", "EIX", "EW", "EA", "EMC", "EMR", "ENDP", "ESV", "ETR", "EOG", "EQT", "EFX", "EQIX", "EQR", "ESS", "EL", "ES", "EXC",
                        "EXPE", "EXPD", "ESRX", "EXR", "XOM", "FFIV", "FB", "FAST", "FRT", "FDX", "FIS", "FITB", "FSLR", "FE", "FISV", "FLIR", "FLS",
                        "FLR", "FMC", "FTI", "F", "BEN", "FCX", "FTR", "GME", "GPS", "GRMN", "GD", "GE", "GGP", "GIS", "GM", "GPC", "GILD", "GS", "GT",
                        "GWW", "HAL", "HBI", "HOG", "HAR", "HRS", "HIG", "HAS", "HCA", "HCP", "HP", "HES", "HPE", "HD", "HON", "HRL", "HST", "HPQ", "HUM",
                        "HBAN", "ITW", "ILMN", "IR", "INTC", "ICE", "IBM", "IP", "IPG", "IFF", "INTU", "ISRG", "IVZ", "IRM", "JEC", "JBHT", "JNJ", "JCI",
                        "JPM", "JNPR", "KSU", "K", "KEY", "GMCR", "KMB", "KIM", "KMI", "KLAC", "KSS", "KHC", "KR", "LB", "LLL", "LH", "LRCX", "LM", "LEG",
                        "LEN", "LVLT", "LUK", "LLY", "LNC", "LLTC", "LMT", "L", "LOW", "LYB", "MTB", "MAC", "M", "MNK", "MRO", "MPC", "MAR", "MMC", "MLM",
                        "MAS", "MA", "MAT", "MKC", "MCD", "MHFI", "MCK", "MJN", "WRK", "MDT", "MRK", "MET", "KORS", "MCHP", "MU", "MSFT", "MHK", "TAP",
                        "MDLZ", "MON", "MNST", "MCO", "MS", "MOS", "MSI", "MUR", "MYL", "NDAQ", "NOV", "NAVI", "NTAP", "NFLX", "NWL", "NFX", "NEM", "NWSA",
                        "NWS", "NEE", "NLSN", "NKE", "NI", "NBL", "JWN", "NSC", "NTRS", "NOC", "NRG", "NUE", "NVDA", "ORLY", "OXY", "OMC", "OKE", "ORCL",
                        "OI", "PCAR", "PH", "PDCO", "PAYX", "PYPL", "PNR", "PBCT", "POM", "PEP", "PKI", "PRGO", "PFE", "PCG", "PM", "PSX", "PNW", "PXD",
                        "PBI", "PNC", "RL", "PPG", "PPL", "PX", "CFG", "PCLN", "PFG", "PG", "PGR", "PLD", "PRU", "PEG", "PSA", "PHM", "PVH", "QRVO", "PWR",
                        "QCOM", "DGX", "RRC", "RTN", "O", "RHT", "REGN", "RF", "RSG", "RAI", "RHI", "ROK", "COL", "ROP", "ROST", "RCL", "R", "CRM", "SNDK",
                        "SCG", "SLB", "SNI", "STX", "SEE", "SRE", "SHW", "SIG", "SPG", "SWKS", "SLG", "SJM", "SNA", "SO", "LUV", "SWN", "SE", "STJ", "SWK",
                        "SPLS", "SBUX", "HOT", "STT", "SRCL", "SYK", "STI", "SYMC", "SYF", "SYY", "TROW", "TGT", "TEL", "TE", "TGNA", "THC", "TDC", "TSO",
                        "TXN", "TXT", "HSY", "TRV", "TMO", "TIF", "TWX", "TWC", "TJX", "TMK", "TSS", "TSCO", "RIG", "TRIP", "FOXA", "FOX", "TSN", "TYC",
                        "USB", "UA", "UNP", "UAL", "UNH", "UPS", "URI", "UTX", "UHS", "UNM", "URBN", "VFC", "VLO", "VAR", "VTR", "VRSN", "VRSK", "VZ",
                        "VRTX", "VIAB", "V", "VNO", "VMC", "WMT", "WBA", "DIS", "WM", "WAT", "ANTM", "WFC", "HCN", "WDC", "WU", "WY", "WHR", "WFM", "WMB",
                        "WLTW", "WEC", "WYN", "WYNN", "XEL", "XRX", "XLNX", "XL", "XYL", "YHOO", "YUM", "ZBH", "ZION", "ZTS"];
            $.each( tickers, function( key, value ) {
              // console.log(key+value);

                var node = '<option value="'+value+'">'+value+'</option>';
                $("#filtering").append(node);


            });

            
            $("#submitButton").click(function(){
                var tickers = $(".multiselect,dropdown-toggle,btn,btn-default").attr("title");
                var fromdate = $('#from2').val();
                var todate = $('#to2').val();
                var sector = $('#sector2').val();
                var searchtype = "alltoall";
                window.location.href = "loading.php?tickers=" + tickers + "&from=" + fromdate + "&to=" +todate + "&sector=" + sector + "&searchtype="+ searchtype;

            
        });
            $( "#from1" ).datepicker({
                defaultDate: "-1w",
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
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
                changeYear: true,
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
                changeYear: true,
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
                changeYear: true,
                maxDate: -1,
                showOptions: { direction: "down" },
                onClose: function( selectedDate ) {
                $( "#from2" ).datepicker( "option", "maxDate", selectedDate );
                }
            });
            $( "#from3" ).datepicker({
                defaultDate: "-1w",
                changeMonth: true,
                dateFormat: "yy-mm-dd",
                changeYear: true,
                maxDate: "-2d",
                minDate: "-5y",
                showOptions: { direction: "down" },
                onClose: function( selectedDate ) {
                $( "#to3" ).datepicker( "option", "minDate", selectedDate );
            }
        });
            $( "#to3" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                dateFormat: "yy-mm-dd",
                changeYear: true,
                maxDate: -1,
                showOptions: { direction: "down" },
                onClose: function( selectedDate ) {
                $( "#from3" ).datepicker( "option", "maxDate", selectedDate );
                }
            });
      });
      </script>



      

    <!-- Bootstrap Core JavaScript -->
    
    <br><br>
    <div class="container">
        <div class="row" >
            <div class="col-md-12" style="text-align:center"> 
                <h3>Find similar stock</h3>
                <button class="btn btn-primary" onclick="showDiv1()">Compare one stock with all others</button>
                
                <button class="btn btn-primary" onclick="showDiv2()">Compare all stocks</button>
                <button class="btn btn-primary" onclick="showDiv3()">Search for one specific stock</button>
            </div>
        </div>
        <br><br>
        
        <!-- one to all section -->
        <div class="row" id="oneToAll"  style="display:none;">
            
            <!-- Search box -->
            <div id="custom-search-input">
                <form action="loading.php" method="POST" id="search1">
                    <div class="input-group col-sm-6 col-sm-offset-3">
                        <input type="text" class="search-query form-control" name="searchbox1" placeholder="Search"></input>
                        <span class="input-group-btn">
                            <button style="height:34px;" class="btn btn-primary" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                        
                        <input type="hidden" name="searchtype" value="onetoall">
                    </div>
                </form>
            </div>
            
            <br>
            <!-- select sector-->
            <div class="input-group col-sm-6 col-sm-offset-3">
                <h4>Market Sector</h4>
                <select style="width:100%;height:25px; text-align: left;"  form="search1" name="sector1" class="btn btn-default" type="button">
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
                <input style="margin-left: 5px;" type="text" id="from1" name="from1" form="search1">
                <label style="margin-left: 10px;" for="to">to</label>
                <input style="margin-left: 5px;" type="text" id="to1" name="to1" form="search1">
            </div>
                
        </div>
    
    
        <!-- all to all section -->
        
        <div class="row" id="allToAll"  style="display:none;">


            <!-- select sector-->

<!--             <form action="loading.php" method="POST" id="search2">
 -->                <div class="input-group col-sm-6 col-sm-offset-3">
                    <h4>Market Sector</h4>
                    <input type="hidden" name="searchtype" value="alltoall">
                    <select style="width:100%;height:25px; text-align: left;" name="sector2" class="btn btn-default" type="button" id="sector2">
                        <option value="All">All</option>
                        <option value="Technology">Technology</option>
                        <option value="Finance">Finance</option>
                        <option value="Consumer">Consumer Goods</option>
                        <option value="Automotive">Automotive</option>
                        <option value="Conglomerates">Conglomerates</option>
                        <option value="Energy">Energy</option>
                        <option value="Utilities">Utilities</option>
                    </select>

                    <!-- <dl class="dropdown"> 
  
                    <dt>
                    <a href="#" id="selectSector">
                      <span class="hida">Select</span>    
                      <p class="multiSel"></p>  
                    </a>
                    </dt>
                  
                    <dd>
                        <div class="mutliSelect">
                            <ul id="sector">
                                <li>
                                    <input type="checkbox" value="Apple" />Apple</li>
                                <li>
                                    <input type="checkbox" value="Blackberry" />Blackberry</li>
                                <li>
                                    <input type="checkbox" value="HTC" />HTC</li>
                                <li>
                                    <input type="checkbox" value="Sony Ericson" />Sony Ericson</li>
                                <li>
                                    <input type="checkbox" value="Motorola" />Motorola</li>
                                <li>
                                    <input type="checkbox" value="Nokia" />Nokia</li>
                            </ul>
                        </div>
                    </dd>
                </dl>
 -->
                <br><br><br>
                <select id="filtering" multiple="multiple">
                </select>


                    
                </div>
            
                <br>
                <br>
                <!-- choose time period-->
                <div style="height:200px;" class="input-group col-sm-6 col-sm-offset-3">
                    <h4>Choose a time period</h4>

                    <label for="from">From</label>
                    <input style="margin-left: 5px;" type="text" id="from2" name="from2">
                    <label style="margin-left: 10px;" for="to">to</label>
                    <input style="margin-left: 5px;" type="text" id="to2" name="to2">
                    <button class="btn btn-primary" type="submit" id='submitButton'>
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
<!--             </form>
 -->        </div>
    
    
        <!-- one specific stock -->
        <div class="row" id="specific"  style="display:none;">
            
            <!-- Search box -->
            <div id="custom-search-input">
                <form action="loading.php" method="POST" id="search3">
                    <div class="input-group col-sm-6 col-sm-offset-3">
                        <input type="text" class="search-query form-control" name="searchbox2" placeholder="Search"></input>
                        <span class="input-group-btn">
                            <button style="height:34px;" class="btn btn-primary" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                        <input type="hidden" name="searchtype" value="specific">
                    </div>
                    <br>
                    <br>
                    <!-- choose time period-->
                    <div style="height:200px;" class="input-group col-sm-6 col-sm-offset-3">
                        <h4>Choose a time period</h4>

                        <label for="from">From</label>
                        <input style="margin-left: 5px;" type="text" id="from3" name="from3" form="search3">
                        <label style="margin-left: 10px;" for="to">to</label>
                        <input style="margin-left: 5px;" type="text" id="to3" name="to3" form="search3">
                    </div>
                </form>
            </div>
                
        </div>
    </div>
    
   
</body>
</html>

