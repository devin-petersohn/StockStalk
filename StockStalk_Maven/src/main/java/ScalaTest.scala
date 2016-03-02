import java.util
import java.util.concurrent.TimeUnit
import java.util.{Date, GregorianCalendar, Calendar}
import org.apache.spark.rdd.RDD

import collection.JavaConversions._

import yahoofinance.Stock
import yahoofinance.YahooFinance
import yahoofinance.histquotes.HistoricalQuote
import yahoofinance.histquotes.Interval

import scala.collection.mutable.ArrayBuffer
import scala.util.control.Breaks._

import org.apache.spark.SparkContext
import org.apache.spark.SparkContext._
import org.apache.spark.SparkConf
import org.apache.spark.rdd.RDD

object ScalaTest {
  val sc = new SparkContext(new SparkConf().setAppName("Testing_Scala").setMaster("local[4]"))

  val sANDp500 = Array("GOOG")
  def main(args: Array[String]) {
    var stocks = new ArrayBuffer[Stock]()
    var history = new ArrayBuffer[(Stock,util.List[HistoricalQuote])]()
    //val from = new GregorianCalendar(2006, 0, 1)
    val from = Calendar.getInstance()
    from.add(Calendar.DATE, -1)
    val to = Calendar.getInstance
    for(stock <- sANDp500) {
      stocks += YahooFinance.get(stock)
      history += ((YahooFinance.get(stock), YahooFinance.get(stock).getHistory(from, to, Interval.DAILY)))
    }
    sc.parallelize(history).saveAsObjectFile("/usr/devin/stocks")
//    var x = sc.objectFile[(Stock, util.List[HistoricalQuote])]("data/stock")
//    x = x.union(sc.parallelize(history)).reduceByKey((a,b) => a ++ b)
    //have to delete previous files at /usr/devin/stocks
    //create java code to delete
//    x.saveAsObjectFile("data/stock")

    /*
    println("Hello from Scala!")

    println("Hello World")

    val stock = YahooFinance.get("GOOG")
    val stock2 = YahooFinance.get("AAPL")
    if (!(stock.getName == "N/A")) {
      println(stock.getSymbol + " - " + stock.getName + " => $" + stock.getQuote.getPrice + " (" + stock.getQuote.getChangeInPercent + "%)")
    }


    val percent_hist = calculatePercentChange(stock).map(_.swap)
    val percent_hist2 = calculatePercentChange(stock2).map(_.swap)
    //percent_hist.saveAsObjectFile("data/DAILY")
    //val test = sc.objectFile[(Double, Long)]("data/WEEKLY")

    var test = sc.union(convertPercentChange(percent_hist, 1.0), convertPercentChange(percent_hist2, 1.0)).map(_.swap)
    //val b = test.collect
    //b.foreach(println)
    var numDays = 1
    val interval = 1
    var temp = coarseGrainedAggregation(test, numDays, interval)
    println(temp.first)
    var previous = temp

    while(!test.isEmpty){
      numDays *= 2
      previous = temp
      temp = coarseGrainedAggregation(test, numDays, interval)
      test = expand(temp)
    }

    previous.collect.foreach(println)
    */
    //TestClass.test()
  }

  def merge(x: String, y: String): String = {
    if(x.contains("*")) x.dropRight(1)+y else y.dropRight(1)+x
  }

  def expand(rdd: RDD[((Date, String), Iterable[String])]): RDD[((Date, String), String)] = {
    rdd.flatMap(f => f._2.map(g => ((f._1._1, g), f._1._2)))
  }

  def coarseGrainedAggregation(blocks: RDD[((Date, String), String)], currentNumDays: Int, interval: Int): RDD[((Date, String), Iterable[(String)])] = {
    val x = blocks.map(_.swap)
      .flatMap(f => Iterable((f._2.swap,f._1),((f._2._2, new Date(f._2._1.getTime + TimeUnit.DAYS.toMillis(currentNumDays * interval))),f._1+"*")))
      .reduceByKey((a,b) => merge(a,b)).map(z => (z._1._1, (z._2, z._1._2)))
    println("_+_+_+_+_+_+_+_+_+_")
    println(x.first)
    println("_+_+_+_+_+_+_+_+_+_")
    x.filter(_._2._1.length>(2 * currentNumDays)).filter(_._2._1.last != '*')
      .map(f => ((new Date(f._2._2.getTime - TimeUnit.DAYS.toMillis(currentNumDays * interval)), f._2._1), f._1))
      .groupByKey
      .filter(_._2.size>1)
  }


  def calculatePercentChange(stock:Stock): RDD[(((Date, String), Double))] = {
    val from = new GregorianCalendar(2006, 0, 1)
    val calendar = Calendar.getInstance
    var prev = stock.getHistory.get(0).getClose
    var buffer = new ArrayBuffer[((((Date, String)),Double))]
    val hists = stock.getHistory(from, calendar, Interval.DAILY)
    //sc.parallelize(hists).saveAsObjectFile("data/history_data")

    //hists.foreach(println)
    for(hist <- hists){
      buffer += (((hist.getDate.getTime, stock.getSymbol), (hist.getClose.doubleValue/prev.doubleValue - 1) * 100))
      prev = hist.getClose
    }
    sc.parallelize(buffer)
  }

  def convertPercentChange(percentRDD: RDD[((Double, (Date, String)))], threshold: Double): RDD[((String, (Date, String)))] = {
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


}