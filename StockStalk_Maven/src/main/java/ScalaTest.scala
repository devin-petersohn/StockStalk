import java.util.Calendar
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


object ScalaTest {
  def main(args: Array[String]) {
    println("Hello from Scala!")
    println("Hello World")
    val stock: Stock = YahooFinance.get("GOOG")
    if (!(stock.getName == "N/A")) {
      println(stock.getSymbol + " - " + stock.getName + " => $" + stock.getQuote.getPrice + " (" + stock.getQuote.getChangeInPercent + "%)")
    }
    val sc = new SparkContext(new SparkConf().setAppName("Testing_Scala").setMaster("local[4]"))

    val percent_hist = calculatePercentChange(sc, stock)
    val b = percent_hist.collect
    b.foreach(println)
  }

  def calculatePercentChange(sc: SparkContext, stock:Stock): RDD[((Double, Long))] = {
    val from = Calendar.getInstance()
    from.add(Calendar.YEAR, -1)
    var prev = stock.getHistory.get(0).getClose
    var buffer = new ArrayBuffer[Double]()
    val hists = stock.getHistory(from, Interval.DAILY)
    for(hist <- hists){
      buffer += (hist.getClose.doubleValue()/prev.doubleValue() - 1) * 100
      prev = hist.getClose
    }
    return sc.parallelize(buffer).zipWithIndex
  }
}