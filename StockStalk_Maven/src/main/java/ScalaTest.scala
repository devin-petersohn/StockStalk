import java.util.{Calendar, Date, GregorianCalendar}
import collection.JavaConversions._
import scala.collection.mutable.ArrayBuffer

import org.apache.spark.SparkContext
import org.apache.spark.SparkConf
import org.apache.spark.rdd._

object ScalaTest {
  val sc = new SparkContext(new SparkConf().setAppName("Testing_Scala").setMaster("local[4]"))

  val sANDp500 = Vector("GOOG", "AAPL")

  def getAllStocks(stock_query_list: scala.Vector[String], fromDate: Calendar, toDate: Calendar, interval: Interval, percent_threshold: Double) = {
    var stock_data = sc.parallelize(new ArrayBuffer[((String, (Long, String)))])
    for(stock <- stock_query_list) {
      val x = convertPercentChange(calculatePercentChange(YahooFinance.get(stock), fromDate, toDate, interval).map(_.swap).zipWithIndex.map(f => (f._1._1, (f._2, f._1._2._2))), percent_threshold)
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

  def calculatePercentChange(stock:Stock, fromDate: Calendar, toDate: Calendar, interval: Interval): RDD[(((Date, String), Double))] = {
//    val from = new GregorianCalendar(2006, 0, 1)
//    val calendar : Calendar = Calendar.getInstance
    var prev = stock.getHistory.get(0).getClose
    var buffer = new ArrayBuffer[((((Date, String)),Double))]
    val hists = stock.getHistory(fromDate, toDate, interval)
    for(hist <- hists){
      buffer += (((hist.getDate.getTime, stock.getSymbol), (hist.getClose.doubleValue/prev.doubleValue - 1) * 100))
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
    println(percent)
    if(percent > 0) println(string) else if(string.charAt(0) == 'Z') println("-" + string.drop(1)) else println("_" + string.drop(1))
    if(percent > 0) string else if(string.charAt(0) == 'Z') "-" + string.drop(1) else "_" + string.drop(1)

  }

  def main(args: Array[String]) {

    val fromDate: Calendar = new GregorianCalendar(args(0).toInt, args(1).toInt, args(2).toInt)
    val toDate: Calendar = new GregorianCalendar(args(3).toInt, args(4).toInt, args(5).toInt)
    val percent_threshold = args(6).toDouble
    val interval: Interval =
      if(args(7) == "Daily") Interval.DAILY
      else if(args(7) == "Weekly") Interval.WEEKLY
      else Interval.MONTHLY

    val stock_query_list = if(args(8) == "S&P500") sANDp500 else args.drop(8).toVector
    var stock_data_list = getAllStocks(stock_query_list, fromDate, toDate, interval, percent_threshold).map(_.swap)

    /*
    var stocks = new ArrayBuffer[Stock]()

    var history = new ArrayBuffer[(Stock,util.List[HistoricalQuote])]()
    //val from = new GregorianCalendar(2006, 0, 1)
    val from = Calendar.getInstance()
    from.add(Calendar.DATE, -1)
    val to = Calendar.getInstance
    for(stock <- sANDp500) {
      var temp = YahooFinance.get(stock)
      stocks += temp
      history += ((temp, temp.getHistory(from, to, Interval.DAILY)))
    }
    sc.parallelize(history).saveAsObjectFile("data/TEST_1")
//    var x = sc.objectFile[(Stock, util.List[HistoricalQuote])]("data/stock")
//    x = x.union(sc.parallelize(history)).reduceByKey((a,b) => a ++ b)
    //have to delete previous files at /usr/devin/stocks
    //create java code to delete
    //    x.saveAsObjectFile("data/stock")
 */

    /*
    val stock  = YahooFinance.get("GOOG")
    val stock2 = YahooFinance.get("AAPL")
    val stock3 = YahooFinance.get("MSFT")
    if (!(stock.getName == "N/A")) {
      println(stock.getSymbol + " - " + stock.getName + " => $" + stock.getQuote.getPrice + " (" + stock.getQuote.getChangeInPercent + "%)")
    }

    val percent_hist  = calculatePercentChange(stock , fromDate, toDate, interval).map(_.swap).zipWithIndex.map(f => (f._1._1, (f._2, f._1._2._2)))
    val percent_hist2 = calculatePercentChange(stock2, fromDate, toDate, interval).map(_.swap).zipWithIndex.map(f => (f._1._1, (f._2, f._1._2._2)))
    val percent_hist3 = calculatePercentChange(stock3, fromDate, toDate, interval).map(_.swap).zipWithIndex.map(f => (f._1._1, (f._2, f._1._2._2)))


    var test = sc.union(convertPercentChange(percent_hist, percent_threshold), convertPercentChange(percent_hist2, percent_threshold), convertPercentChange(percent_hist3, percent_threshold)).map(_.swap)

    val indexes_of_dates = calculatePercentChange(stock, fromDate, toDate, interval).map(_._1._1).zipWithIndex.map(_.swap).collect.toMap
    */
    var numDays = 1
//    var interval = 1
    var temp = coarseGrainedAggregation(stock_data_list, numDays)
    println(temp.first)
    var previous = temp
    stock_data_list = expand(temp)
    while(!stock_data_list.isEmpty){
      numDays *= 2
      previous = temp
      temp = coarseGrainedAggregation(stock_data_list, numDays)
      stock_data_list = expand(temp)
    }


    val results = 0

    previous.collect.foreach(println)
    /*
    for(result <- results) {
      println(result._1._2 + " => " + result._2 + " => " + indexes_of_dates.getOrElse(result._1._1, "Error").toString)
    }
    */


    //TestClass.test()

  }

}