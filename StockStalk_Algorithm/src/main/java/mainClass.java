/**
 * Created by ZeningZhang on 2/21/16.
 */
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import net.sf.javaml.core.Instance;
import net.sf.javaml.core.SparseInstance;
import net.sf.javaml.distance.dtw.DTWSimilarity;
import org.apache.spark.*;
import org.apache.spark.api.java.*;
import java.io.FileWriter;
import java.io.IOException;
import java.io.Serializable;
import java.sql.Timestamp;
import java.util.*;

import org.apache.spark.api.python.SerDeUtil;
import org.apache.spark.rdd.RDD;
import org.apache.spark.sql.DataFrame;
import org.apache.spark.sql.SQLContext;
import org.apache.spark.util.CollectionsUtils;
import org.apache.spark.util.SystemClock;
import scala.Tuple2;
import org.apache.spark.api.java.function.VoidFunction;
import org.apache.spark.api.java.function.Function;
public class mainClass implements Serializable{
    private ArrayList<String> stockNameList=new ArrayList<>();
    private ArrayList<Date> sampleDate;
    private ArrayList<Double> samplePercent;

    private static String[] stockList={"MMM","ABT","ABBV","ACN","ATVI","ADBE","ADT","AAP","AES","AET","AFL","AMG","A","GAS","APD","ARG","AKAM","AA","AGN","ALXN","ALLE","ADS","ALL","GOOGL","GOOG","MO","AMZN","AEE","AAL","AEP","AXP","AIG","AMT","AMP","ABC","AME","AMGN","APH","APC","ADI","AON","APA","AIV","AAPL","AMAT","ADM","AIZ","T","ADSK","ADP","AN","AZO","AVGO","AVB","AVY","BHI","BLL","BAC","BK","BCR","BXLT","BAX","BBT","BDX","BBBY","BRK-B","BBY","BIIB","BLK","HRB","BA","BWA","BXP","BSX","BMY","BF-B","CHRW","CA","CVC","COG","CAM","CPB","COF","CAH","HSIC","KMX","CCL","CAT","CBG","CBS","CELG","CNP","CTL","CERN","CF","SCHW","CHK","CVX","CMG","CB","CHD","CI","XEC","CINF","CTAS","CSCO","C","CTXS","CLX","CME","CMS","COH","KO","CCE","CTSH","CL","CPGX","CMCSA","CMA","CAG","CXO","COP","CNX","ED","STZ","GLW","COST","CCI","CSRA","CSX","CMI","CVS","DHI","DHR","DRI","DVA","DE","DLPH","DAL","XRAY","DVN","DO","DFS","DISCA","DISCK","DG","DLTR","D","DOV","DOW","DPS","DTE","DD","DUK","DNB","ETFC","EMN","ETN","EBAY","ECL","EIX","EW","EA","EMC","EMR","ENDP","ESV","ETR","EOG","EQT","EFX","EQIX","EQR","ESS","EL","ES","EXC","EXPE","EXPD","ESRX","EXR","XOM","FFIV","FB","FAST","FRT","FDX","FIS","FITB","FSLR","FE","FISV","FLIR","FLS","FLR","FMC","FTI","F","BEN","FCX","FTR","GME","GPS","GRMN","GD","GE","GGP","GIS","GM","GPC","GILD","GS","GT","GWW","HAL","HBI","HOG","HAR","HRS","HIG","HAS","HCA","HCP","HP","HES","HPE","HD","HON","HRL","HST","HPQ","HUM","HBAN","ITW","ILMN","IR","INTC","ICE","IBM","IP","IPG","IFF","INTU","ISRG","IVZ","IRM","JEC","JBHT","JNJ","JCI","JPM","JNPR","KSU","K","KEY","GMCR","KMB","KIM","KMI","KLAC","KSS","KHC","KR","LB","LLL","LH","LRCX","LM","LEG","LEN","LVLT","LUK","LLY","LNC","LLTC","LMT","L","LOW","LYB","MTB","MAC","M","MNK","MRO","MPC","MAR","MMC","MLM","MAS","MA","MAT","MKC","MCD","MHFI","MCK","MJN","WRK","MDT","MRK","MET","KORS","MCHP","MU","MSFT","MHK","TAP","MDLZ","MON","MNST","MCO","MS","MOS","MSI","MUR","MYL","NDAQ","NOV","NAVI","NTAP","NFLX","NWL","NFX","NEM","NWSA","NWS","NEE","NLSN","NKE","NI","NBL","JWN","NSC","NTRS","NOC","NRG","NUE","NVDA","ORLY","OXY","OMC","OKE","ORCL","OI","PCAR","PH","PDCO","PAYX","PYPL","PNR","PBCT","POM","PEP","PKI","PRGO","PFE","PCG","PM","PSX","PNW","PXD","PBI","PNC","RL","PPG","PPL","PX","CFG","PCLN","PFG","PG","PGR","PLD","PRU","PEG","PSA","PHM","PVH","QRVO","PWR","QCOM","DGX","RRC","RTN","O","RHT","REGN","RF","RSG","RAI","RHI","ROK","COL","ROP","ROST","RCL","R","CRM","SNDK","SCG","SLB","SNI","STX","SEE","SRE","SHW","SIG","SPG","SWKS","SLG","SJM","SNA","SO","LUV","SWN","SE","STJ","SWK","SPLS","SBUX","HOT","STT","SRCL","SYK","STI","SYMC","SYF","SYY","TROW","TGT","TEL","TE","TGNA","THC","TDC","TSO","TXN","TXT","HSY","TRV","TMO","TIF","TWX","TWC","TJX","TMK","TSS","TSCO","RIG","TRIP","FOXA","FOX","TSN","TYC","USB","UA","UNP","UAL","UNH","UPS","URI","UTX","UHS","UNM","URBN","VFC","VLO","VAR","VTR","VRSN","VRSK","VZ","VRTX","VIAB","V","VNO","VMC","WMT","WBA","DIS","WM","WAT","ANTM","WFC","HCN","WDC","WU","WY","WHR","WFM","WMB","WLTW","WEC","WYN","WYNN","XEL","XRX","XLNX","XL","XYL","YHOO","YUM","ZBH","ZION","ZTS"};
    public static void main(String[] args)
    {

        new mainClass().compareOneStockToOtherStocks("AAPL");

//        mainClass mainClass=new mainClass();
//        mainClass.compareOneStockToOtherStocks("MMM");
//        HashMap<String,Double> map=new HashMap<>();
//
//        map.put("AAA",0.2);
//        map.put("BBB",0.1);
//        map.put("CCC",0.5);
//        map.put("DDD",0.7);
//        map.put("EEE",0.98);
//        Map<String,Double> sorted=sortByComparator(map);
//        JsonObject stockList=new JsonObject();
//        JsonArray stock=new JsonArray();
//        for (Map.Entry<String, Double> entry : sorted.entrySet()) {
//            System.out.println(entry.getKey()+" "+ entry.getValue());
//            stockList.addProperty(entry.getKey(),entry.getValue());
//
//
//        }
//            // try-with-resources statement based on post comment below :)
//
//            try (FileWriter file = new FileWriter("file1.txt")) {
//                file.write(stockList.toString());
//                System.out.println("Successfully Copied JSON Object to File...");
//                System.out.println("\nJSON Object: " + stockList);
//            }
//            catch (IOException e){
//
//            }
    }





//        def calculatePercentChange(stock:Stock): RDD[(((Date, String), Double))] = {
//        val from = new GregorianCalendar(2006, 0, 1)
//        val calendar = Calendar.getInstance
//        var prev = stock.getHistory.get(0).getClose
//        var buffer = new ArrayBuffer[((((Date, String)),Double))]
//        val hists = stock.getHistory(from, calendar, Interval.DAILY)
//        //sc.parallelize(hists).saveAsObjectFile("data/history_data")
//
//        //hists.foreach(println)
//        for(hist <- hists){
//            buffer += (((hist.getDate.getTime, stock.getSymbol), (hist.getClose.doubleValue/prev.doubleValue - 1) * 100))
//            prev = hist.getClose
//        }
//        sc.parallelize(buffer)
//    }




    public void compareOneStockToOtherStocks(String stockName)
    {
//        ArrayList<String> stocklists = new ArrayList<String>(Arrays.asList(stockList));
//        HashMap<String,Double> table=new HashMap<>();
//
//        for(String name:stocklists)
//        {
//            if(name.equals(stockName))
//            {
//                stocklists.remove(stockName);
//            }
//        }
//
//        for(String name:stocklists)
//        {
//
//        }

        SparkConf conf = new SparkConf().setAppName("testSpark").setMaster("local[1]");
        JavaSparkContext sc = new JavaSparkContext(conf);
        JavaRDD<Tuple2<Tuple2<Date, String>, Double>> data=sc.objectFile("data/STOCKS");
        List <Tuple2<Tuple2<Date,String>,Double>> list= data.collect();



    }

    private static Map<String, Double> sortByComparator(Map<String, Double> unsortMap) {

        // Convert Map to List
        List<Map.Entry<String, Double>> list =
                new LinkedList<Map.Entry<String, Double>>(unsortMap.entrySet());

        // Sort list with comparator, to compare the Map values
        Collections.sort(list, new Comparator<Map.Entry<String, Double>>() {
            public int compare(Map.Entry<String, Double> o1,
                               Map.Entry<String, Double> o2) {
                return (o1.getValue()).compareTo(o2.getValue());
            }
        });

        // Convert sorted map back to a Map
        Map<String, Double> sortedMap = new LinkedHashMap<String, Double>();
        for (Iterator<Map.Entry<String, Double>> it = list.iterator(); it.hasNext();) {
            Map.Entry<String, Double> entry = it.next();
            sortedMap.put(entry.getKey(), entry.getValue());
        }
        return sortedMap;
    }

    public int makeTimeStamp(Date d)
    {
        Timestamp ts_now = new Timestamp(d.getTime());
        String result;
        result=ts_now.toString().replaceAll(":","");
        result=result.replaceAll("-","");
        result=result.replaceAll(" ","");
        result=result.replaceAll("\\.","");
        return Integer.parseInt(result);
    }

    public double computeStock(List <Tuple2<Tuple2<Date,String>,Double>> t1, List <Tuple2<Tuple2<Date,String>,Double>> t2)
    {

        Instance host= new SparseInstance(t1.size());
        Instance guest= new SparseInstance(t2.size());
        if(t1.size()!=t2.size() )
        {
            System.out.println("The size time is not the same as percentage");
        }
        int count=0;
        for(Tuple2<Tuple2<Date,String>,Double> temp1:t1)
        {
            host.put(count++,temp1._2());
        }
        count=0;
        for(Tuple2<Tuple2<Date,String>,Double> temp2:t2)
        {
            guest.put(count++,temp2._2());
        }
        DTWSimilarity ds=new DTWSimilarity();
        return ds.measure(host,guest);
    }


}


