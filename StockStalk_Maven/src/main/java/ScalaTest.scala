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
import org.apache.spark.SparkConf
import org.apache.spark.rdd.RDD


object ScalaTest {
  val sc = new SparkContext(new SparkConf().setAppName("Testing_Scala").setMaster("local[4]"))

  def main(args: Array[String]) {
    println("Hello from Scala!")
    println("Hello World")
    val stock: Stock = YahooFinance.get("GOOG")
    if (!(stock.getName == "N/A")) {
      println(stock.getSymbol + " - " + stock.getName + " => $" + stock.getQuote.getPrice + " (" + stock.getQuote.getChangeInPercent + "%)")
    }
    val sc = new SparkContext(new SparkConf().setAppName("Testing_Scala").setMaster("local[4]"))

    val percent_hist = calculatePercentChange(stock)
    percent_hist.saveAsObjectFile("data/DAILY")
    //val test = sc.objectFile[(Double, Long)]("data/WEEKLY")
    val percent_hist = calculatePercentChange(stock)
    val b = percent_hist.collect
    b.foreach(println)
    TestClass.test()
  }

  def calculatePercentChange(stock:Stock): RDD[((Date, Double))] = {
    val from = new GregorianCalendar(2006, 0, 1)
    val calendar = Calendar.getInstance()
    var prev = stock.getHistory().get(0).getClose
    var buffer = new ArrayBuffer[((Date,Double))]()
    val hists = stock.getHistory(from, calendar, Interval.DAILY)
    //sc.parallelize(hists).saveAsObjectFile("data/history_data")

    hists.foreach(println)
    for(hist <- hists){
      buffer += ((hist.getDate.getTime, (hist.getClose().doubleValue()/prev.doubleValue() - 1) * 100))
      prev = hist.getClose()
    }
    return sc.parallelize(buffer)
  }

  def convertPercentChange(percentRDD: RDD[((Double, Long))], threshold: Double): RDD[((String, Long))] = {
    val base = 0.0
    return percentRDD.map(period => ((percentToString(period._1, threshold), period._2)))
  }

  def percentToString(percent: Double, threshold: Double) : String = {
    val base = 0.0

    return ""
  }


}