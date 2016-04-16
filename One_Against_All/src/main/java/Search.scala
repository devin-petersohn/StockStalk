import java.sql.Timestamp
import java.util
import java.util.Calendar

import org.apache.spark.SparkContext
import org.apache.spark.SparkContext._
import org.apache.spark.SparkConf
import org.apache.spark.rdd.RDD
import java.sql.Timestamp

import scala.collection.mutable.ArrayBuffer

object Search {
  val sc = new SparkContext(new SparkConf().setAppName("Testing_Scala").setMaster("local[4]"))

  val sANDp500 = Array("GOOG")
  def main(args: Array[String]) = {
    println("Hello World")
    val instanceOne: Instance = new SparseInstance(10)
    instanceOne.put(1, 1.0)
    instanceOne.put(2, 2.0)
    instanceOne.put(3, 3.0)
    val instanceTwo: Instance = new SparseInstance(10)
    instanceTwo.put(1, 2.0)
    instanceTwo.put(2, 3.0)
    instanceTwo.put(3, 4.0)
    val ds: DTWSimilarity = new DTWSimilarity
//    val dtw: DTW = new DTW

    System.out.println(ds.measure(instanceOne, instanceTwo))

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
  }


//  def calculatePercentChange(stock:Stock): RDD[(((Date, String), Double))] = {
//    val from = new GregorianCalendar(2006, 0, 1)
//    val calendar = Calendar.getInstance
//    var prev = stock.getHistory.get(0).getClose
//    var buffer = new ArrayBuffer[((((Date, String)),Double))]
//    val hists = stock.getHistory(from, calendar, Interval.DAILY)
    //sc.parallelize(hists).saveAsObjectFile("data/history_data")

    //hists.foreach(println)
//    for(hist <- hists){
//      buffer += (((hist.getDate.getTime, stock.getSymbol), (hist.getClose.doubleValue/prev.doubleValue - 1) * 100))
//      prev = hist.getClose
//    }
//    sc.parallelize(buffer)
//  }
}