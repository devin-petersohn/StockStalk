
import java.io.{IOException, FileWriter}
import java.util.{GregorianCalendar, Date, Calendar}

import org.apache.spark.SparkContext
import org.apache.spark.SparkContext._
import org.apache.spark.SparkConf

import scala.collection.mutable.ArrayBuffer
import com.google.gson.JsonArray
import com.google.gson.JsonObject

object Search {
  val sc = new SparkContext(new SparkConf().setAppName("Testing_Scala").setMaster("local[4]"))
  //val sc = new SparkContext()

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
                        "EXPE", "EXPD", "ESRX", "EXR", "XOM", "FFIV", "FB")/*, "FAST", "FRT", "FDX", "FIS", "FITB", "FSLR", "FE", "FISV", "FLIR", "FLS",
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
                        "WLTW", "WEC", "WYN", "WYNN", "XEL", "XRX", "XLNX", "XL", "XYL", "YHOO", "YUM", "ZBH", "ZION", "ZTS")*/

  def getAllStocks(stock_query: String, fromDate: Calendar, toDate: Calendar) = {
    var stock_data = sc.parallelize(new ArrayBuffer[(String,Iterable[(Long, Double)])])
    for(stock <- sANDp500) {
      if(stock_query!=stock) {
        val quotes = sc.objectFile[(Date, Double)]("data/" + stock).sortBy(f => f._1.getTime).filter(f => f._1.getTime > fromDate.getTime.getTime && f._1.getTime < toDate.getTime.getTime).zipWithIndex.map(f => (stock, (f._2, f._1._2))).groupByKey
        stock_data = sc.union(stock_data, quotes)
      }
    }
    val query_data = sc.objectFile[(Date, Double)]("data/"+stock_query).sortBy(f => f._1.getTime).filter(f => f._1.getTime > fromDate.getTime.getTime && f._1.getTime < toDate.getTime.getTime).zipWithIndex.map(f => (stock_query, (f._2, f._1._2))).groupByKey.first._2
    stock_data.map(f => (f._1, calculate_similarity(f._2, query_data))).collect.sortBy(_._2 * -1)
  }

  def calculate_similarity(t1: Iterable[(Long, Double)], t2: Iterable[(Long, Double)]): Double ={
    val host: Instance = new SparseInstance(t1.size)
    val guest: Instance = new SparseInstance(t2.size)
    if (t1.size != t2.size) {
      System.out.println("The size time is not the same as percentage")
    }
    for (temp1 <- t1) {
      host.put(temp1._1.toInt, temp1._2)
    }
    for (temp2 <- t2) {
      guest.put(temp2._1.toInt, temp2._2)
    }
    val ds: DTWSimilarity = new DTWSimilarity
    ds.measure(host, guest)
  }

  def main(args: Array[String]) {
    val fromDate: Calendar = new GregorianCalendar(args(0).toInt, args(1).toInt, args(2).toInt)
    val toDate: Calendar = new GregorianCalendar(args(3).toInt, args(4).toInt, args(5).toInt)
    val query: String = args(6)
    val results = getAllStocks(query, fromDate, toDate)
    val resultJSON = new JsonObject
    for(result <- results) {
      resultJSON.addProperty(result._1, result._2)
    }
    val filename: String = "temp_data/OnevsAll_"+ args(0) +"_"+ args(1) +"_" + args(2) +"_" +args(3) +"_" +args(4) +"_" +args(5) +"_" +args(6) +".json"
    try {
      val file: FileWriter = new FileWriter(filename)
      try {
        file.write(resultJSON.toString)
        println(resultJSON)
      }
      catch {
        case e: IOException => { sys.exit(-1) }
      } finally {
        if (file != null) file.close()
      }
    }
    sys.exit(0)
  }

}
