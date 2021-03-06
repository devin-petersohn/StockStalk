import java.io.{IOException, FileWriter}
import java.util.{Calendar, Date, GregorianCalendar}
import scala.collection.mutable.ArrayBuffer
import org.apache.spark.SparkContext
import org.apache.spark.SparkConf
import org.apache.spark.rdd._

object ScalaTest {
  val sc = new SparkContext(new SparkConf().setAppName("Testing_Scala").setMaster("local[4]"))

  val sANDp500 = Vector("MMM", "ABT", "ABBV", "ACN", "ATVI", "ADBE", "ADT", "AAP", "AES", "AET", "AFL", "AMG", "A", "GAS", "APD", "ARG", "AKAM",
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
                        "WLTW", "WEC", "WYN", "WYNN", "XEL", "XRX", "XLNX", "XL", "XYL", "YHOO", "YUM", "ZBH", "ZION", "ZTS")


  def getAllStocks(stock_query_list: scala.Vector[String], fromDate: Calendar, toDate: Calendar, interval: Interval, percent_threshold: Double) = {
    var stock_data = sc.parallelize(new ArrayBuffer[((String, (Long, String)))])
    for(stock <- stock_query_list) {

      val quotes = sc.objectFile[(Date, Double)]("data/" + stock).sortBy(f => f._1.getTime).filter(f => f._1.getTime > fromDate.getTime.getTime && f._1.getTime < toDate.getTime.getTime).zipWithIndex.map(f => (f._1._2, (f._2,stock)))

      val x = convertPercentChange(quotes, percent_threshold)
      stock_data = sc.union(stock_data, x)
    }
    stock_data
  }

  def merge(x: String, y: String): String = {
    if(x.contains("*")) x.dropRight(1)+y else y.dropRight(1)+x
  }

  def expand(rdd: RDD[((Long, String), Iterable[String])]): RDD[((Long, String), String)] = {
    rdd.flatMap(f => f._2.map(g => ((f._1._1, g), f._1._2)))
  }

  def coarseGrainedAggregation(blocks: RDD[((Long, String), String)], currentNumDays: Int): RDD[((Long, String), Iterable[(String)])] = {
    blocks.map(_.swap)
      .flatMap(f => Iterable((f._2.swap,f._1),((f._2._2, f._2._1 + currentNumDays),f._1+"*")))
      .reduceByKey((a,b) => merge(a,b)).map(z => (z._1._1, (z._2, z._1._2)))
      .filter(_._2._1.length>(2 * currentNumDays)).filter(_._2._1.last != '*')
      .map(f => ((f._2._2 - currentNumDays, f._2._1), f._1))
      .groupByKey
      .filter(_._2.size>1)
  }

  def filterDate(quote: Array[HistoricalQuote], fromDate: Calendar, toDate: Calendar) : Array[HistoricalQuote] = {
    quote.filter(f => f.getDate.getTimeInMillis < toDate.getTimeInMillis && f.getDate.getTimeInMillis > fromDate.getTimeInMillis)
  }

  def calculatePercentChange(symbol: String, quote: Array[HistoricalQuote], fromDate: Calendar, toDate: Calendar): RDD[(((Date, String), Double))] = {
    val hists = filterDate(quote, fromDate, toDate)
    var prev = hists(0).getClose
    var buffer = new ArrayBuffer[((((Date, String)),Double))]
    for(hist <- hists){
      buffer += (((hist.getDate.getTime, symbol), (hist.getClose.doubleValue/prev.doubleValue - 1) * 100))
      prev = hist.getClose
    }
    sc.parallelize(buffer)
  }

  def convertPercentChange(percentRDD: RDD[((Double, (Long, String)))], threshold: Double): RDD[((String, (Long, String)))] = {
    percentRDD.map(period => (percentToString(period._1, threshold), period._2))
  }

  def percentToString(percent: Double, threshold: Double) : String = {
    var string = ""
    Math.abs((percent/threshold).toInt) match {
      case 0  => string = "00"
      case 1  => string = "0A"
      case 2  => string = "0B"
      case 3  => string = "0C"
      case 4  => string = "0D"
      case 5  => string = "0E"
      case 6  => string = "0F"
      case 7  => string = "0G"
      case 8  => string = "0H"
      case 9  => string = "0I"
      case 10 => string = "0J"
      case 11 => string = "0K"
      case 12 => string = "0L"
      case 13 => string = "0M"
      case 14 => string = "0N"
      case 15 => string = "0O"
      case 16 => string = "0P"
      case 17 => string = "0Q"
      case 18 => string = "0R"
      case 19 => string = "0S"
      case 20 => string = "0T"
      case 21 => string = "0U"
      case 22 => string = "0V"
      case 23 => string = "0W"
      case 24 => string = "0X"
      case 25 => string = "0Y"
      case 26 => string = "ZA"
      case 27 => string = "ZB"
      case 28 => string = "ZC"
      case 29 => string = "ZD"
      case 30 => string = "ZE"
      case 31 => string = "ZF"
      case 32 => string = "ZG"
      case 33 => string = "ZH"
      case 34 => string = "ZI"
      case 35 => string = "ZJ"
      case 36 => string = "ZK"
      case 37 => string = "ZL"
      case 38 => string = "ZM"
      case 39 => string = "ZN"
      case 40 => string = "ZO"
      case 41 => string = "ZP"
      case 42 => string = "ZQ"
      case 43 => string = "ZR"
      case 44 => string = "ZS"
      case 45 => string = "ZT"
      case 46 => string = "ZU"
      case 47 => string = "ZV"
      case 48 => string = "ZW"
      case 49 => string = "ZX"
      case 50 => string = "ZY"
      case _  => string = "ZZ"
    }
    if(percent > 0) string else if(string.charAt(0) == 'Z') "-" + string.drop(1) else "_" + string.drop(1)

  }

  def main(args: Array[String]) {

    val fromDate: Calendar = new GregorianCalendar(args(0).toInt, args(1).toInt-1, args(2).toInt)
    val toDate: Calendar = new GregorianCalendar(args(3).toInt, args(4).toInt-1, args(5).toInt)
    System.err.println("\n\n\n\n\n\n\n\n\n\n\n")
    System.err.println(fromDate);
    System.err.println(toDate);
    System.err.println("\n\n\n\n\n\n\n\n\n\n\n")
    val percent_threshold = args(6).toDouble
    val interval: Interval =
      if(args(7) == "Daily") Interval.DAILY
      else if(args(7) == "Weekly") sys.exit(-1)
      else sys.exit(-1)

    val stock_query_list = if(args(8) == "SP500") sANDp500 else args.drop(8).toVector
    var stock_data_list = getAllStocks(stock_query_list, fromDate, toDate, interval, percent_threshold).map(_.swap)

    val indexes_of_dates = sc.objectFile[(Date, Double)]("data/AAPL").sortBy(f => f._1.getTime).filter(f => f._1.getTime > fromDate.getTime.getTime && f._1.getTime < toDate.getTime.getTime).zipWithIndex.map(f => (f._2.toLong, f._1)).collect.toMap

    var numDays = 1
    var temp = coarseGrainedAggregation(stock_data_list, numDays)
    var previous = temp
    stock_data_list = expand(temp)
    while(!stock_data_list.isEmpty){
      numDays *= 2
      previous = temp
      temp = coarseGrainedAggregation(stock_data_list, numDays)
      stock_data_list = expand(temp)
    }


    val results = previous.collect
    var counter=0
    var jsonString = "{\"number_of_results\":"+"\"" + results.length + "\",\"results\":["
    print("{\"number_of_results\":"+"\"" + results.length + "\",\"results\":[")
    for(result <- results) {
      jsonString = jsonString + "{\"result"+counter+"\":{" + "\"names\":["
      print("{\"result"+counter+"\":{" + "\"names\":[")
      for(value <- result._2) {
        jsonString = jsonString + "\"" + value + "\""
        print("\"" + value + "\"")
        if(value != result._2.last) {
          jsonString = jsonString + ","
          print(",")
        }
      }
      jsonString = jsonString + "],"
      print("],")
      jsonString = jsonString + "\"Number of Intervals\":\"" + result._1._2.length/2 + "\","
      print("\"Number of Intervals\":\"" + result._1._2.length/2 + "\",")
      jsonString = jsonString + "\"Date Start\":" + "\"" + indexes_of_dates.getOrElse(result._1._1, "Error").toString + "\"" + "}}"
      print("\"Date Start\":" + "\"" + indexes_of_dates.getOrElse(result._1._1, "Error").toString + "\"" + "}}")
      counter+=1
      if(counter != results.length) {
        jsonString = jsonString + ","
        print(",")
      }
    }
    jsonString = jsonString + "]}"
    println("]}")
    var filename: String = "temp_data/AllvsAll_"
    for(arg <- args) {
      filename = filename + "_" + arg
    }
    filename = filename + ".json"
    try {
      val file: FileWriter = new FileWriter(filename)
      try {
        file.write(jsonString)
      }
      catch {
        case e: IOException => {sys.exit(-1)}
      } finally if (file != null) file.close()

    }
    sys.exit(0)
  }

}