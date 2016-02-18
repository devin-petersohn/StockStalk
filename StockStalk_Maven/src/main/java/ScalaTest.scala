import java.util.Calendar
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
    val x = sc.parallelize(Array(1,2,3,4,5,6,7,8,9,10))
    x.collect().foreach(println)

    val from = Calendar.getInstance();
    from.add(Calendar.YEAR, -1)
    val stock_history = sc.parallelize(stock.getHistory(from, Interval.DAILY))
    println(Interval.DAILY)
    println(stock_history.first())
  }
}