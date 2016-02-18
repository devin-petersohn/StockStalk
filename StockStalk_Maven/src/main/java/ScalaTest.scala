import yahoofinance.Stock
import yahoofinance.YahooFinance
import yahoofinance.histquotes.HistoricalQuote
import yahoofinance.histquotes.Interval

object ScalaTest {
  def main(args: Array[String]) {
    println("Hello from Scala!")
    println("Hello World")
    val stock: Stock = YahooFinance.get("GOOG")
    if (!(stock.getName == "N/A")) {
      println(stock.getSymbol + " - " + stock.getName + " => $" + stock.getQuote.getPrice + " (" + stock.getQuote.getChangeInPercent + "%)")
    }
  }
}