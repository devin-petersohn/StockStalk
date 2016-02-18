/**
 * Created by DevinPetersohn on 2/18/16.
 */

import yahoofinance.Stock;
import yahoofinance.YahooFinance;
import yahoofinance.histquotes.HistoricalQuote;
import yahoofinance.histquotes.Interval;

public class TestClass {

    public static void test(String[] args) {

        System.out.println("Hello World");
        Stock stock = YahooFinance.get("GOOG");
        if(!stock.getName().equals("N/A")) {
            System.out.println(stock.getSymbol() + " - " + stock.getName() + " => $" + stock.getQuote().getPrice() + " (" + stock.getQuote().getChangeInPercent() + "%)");
        }
    }
}
