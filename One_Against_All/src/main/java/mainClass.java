/**
 * Created by ZeningZhang on 2/21/16.
 */

import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import org.apache.spark.SparkConf;
import org.apache.spark.api.java.JavaSparkContext;
import scala.Tuple2;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.Serializable;
import java.math.BigDecimal;
import java.sql.Timestamp;
import java.util.*;
public class mainClass implements Serializable{
    private ArrayList<String> stockNameList=new ArrayList<>();
    private ArrayList<Date> sampleDate;
    private ArrayList<Double> samplePercent;

//    private static String[] stockList={"MMM","ABT","ABBV","ACN","ATVI","ADBE","ADT","AAP","AES","AET","AFL","AMG","A","GAS","APD","ARG","AKAM","AA","AGN","ALXN","ALLE","ADS","ALL","GOOGL","GOOG","MO","AMZN","AEE","AAL","AEP","AXP","AIG","AMT","AMP","ABC","AME","AMGN","APH","APC","ADI","AON","APA","AIV","AAPL","AMAT","ADM","AIZ","T","ADSK","ADP","AN","AZO","AVGO","AVB","AVY","BHI","BLL","BAC","BK","BCR","BXLT","BAX","BBT","BDX","BBBY","BRK-B","BBY","BIIB","BLK","HRB","BA","BWA","BXP","BSX","BMY","BF-B","CHRW","CA","CVC","COG","CAM","CPB","COF","CAH","HSIC","KMX","CCL","CAT","CBG","CBS","CELG","CNP","CTL","CERN","CF","SCHW","CHK","CVX","CMG","CB","CHD","CI","XEC","CINF","CTAS","CSCO","C","CTXS","CLX","CME","CMS","COH","KO","CCE","CTSH","CL","CPGX","CMCSA","CMA","CAG","CXO","COP","CNX","ED","STZ","GLW","COST","CCI","CSRA","CSX","CMI","CVS","DHI","DHR","DRI","DVA","DE","DLPH","DAL","XRAY","DVN","DO","DFS","DISCA","DISCK","DG","DLTR","D","DOV","DOW","DPS","DTE","DD","DUK","DNB","ETFC","EMN","ETN","EBAY","ECL","EIX","EW","EA","EMC","EMR","ENDP","ESV","ETR","EOG","EQT","EFX","EQIX","EQR","ESS","EL","ES","EXC","EXPE","EXPD","ESRX","EXR","XOM","FFIV","FB","FAST","FRT","FDX","FIS","FITB","FSLR","FE","FISV","FLIR","FLS","FLR","FMC","FTI","F","BEN","FCX","FTR","GME","GPS","GRMN","GD","GE","GGP","GIS","GM","GPC","GILD","GS","GT","GWW","HAL","HBI","HOG","HAR","HRS","HIG","HAS","HCA","HCP","HP","HES","HPE","HD","HON","HRL","HST","HPQ","HUM","HBAN","ITW","ILMN","IR","INTC","ICE","IBM","IP","IPG","IFF","INTU","ISRG","IVZ","IRM","JEC","JBHT","JNJ","JCI","JPM","JNPR","KSU","K","KEY","GMCR","KMB","KIM","KMI","KLAC","KSS","KHC","KR","LB","LLL","LH","LRCX","LM","LEG","LEN","LVLT","LUK","LLY","LNC","LLTC","LMT","L","LOW","LYB","MTB","MAC","M","MNK","MRO","MPC","MAR","MMC","MLM","MAS","MA","MAT","MKC","MCD","MHFI","MCK","MJN","WRK","MDT","MRK","MET","KORS","MCHP","MU","MSFT","MHK","TAP","MDLZ","MON","MNST","MCO","MS","MOS","MSI","MUR","MYL","NDAQ","NOV","NAVI","NTAP","NFLX","NWL","NFX","NEM","NWSA","NWS","NEE","NLSN","NKE","NI","NBL","JWN","NSC","NTRS","NOC","NRG","NUE","NVDA","ORLY","OXY","OMC","OKE","ORCL","OI","PCAR","PH","PDCO","PAYX","PYPL","PNR","PBCT","POM","PEP","PKI","PRGO","PFE","PCG","PM","PSX","PNW","PXD","PBI","PNC","RL","PPG","PPL","PX","CFG","PCLN","PFG","PG","PGR","PLD","PRU","PEG","PSA","PHM","PVH","QRVO","PWR","QCOM","DGX","RRC","RTN","O","RHT","REGN","RF","RSG","RAI","RHI","ROK","COL","ROP","ROST","RCL","R","CRM","SNDK","SCG","SLB","SNI","STX","SEE","SRE","SHW","SIG","SPG","SWKS","SLG","SJM","SNA","SO","LUV","SWN","SE","STJ","SWK","SPLS","SBUX","HOT","STT","SRCL","SYK","STI","SYMC","SYF","SYY","TROW","TGT","TEL","TE","TGNA","THC","TDC","TSO","TXN","TXT","HSY","TRV","TMO","TIF","TWX","TWC","TJX","TMK","TSS","TSCO","RIG","TRIP","FOXA","FOX","TSN","TYC","USB","UA","UNP","UAL","UNH","UPS","URI","UTX","UHS","UNM","URBN","VFC","VLO","VAR","VTR","VRSN","VRSK","VZ","VRTX","VIAB","V","VNO","VMC","WMT","WBA","DIS","WM","WAT","ANTM","WFC","HCN","WDC","WU","WY","WHR","WFM","WMB","WLTW","WEC","WYN","WYNN","XEL","XRX","XLNX","XL","XYL","YHOO","YUM","ZBH","ZION","ZTS"};
    private static String[] stockList={"MMM","ABT","ABBV","ACN","ATVI","ADBE","ADT","AAP","AES","AET","AFL","AMG","A","GAS","APD","ARG","AKAM","AA","AGN","ALXN","ALLE","ADS","ALL","GOOGL","GOOG","MO","AMZN","AEE","AAL","AEP","AXP","AIG","AMT","AMP","ABC","AME","AMGN","APH" };
    public static void main(String[] args) throws IOException {
        new mainClass().compareOneStockToOtherStocks(args[0],args[1],args[2]);
    }


    public void compareOneStockToOtherStocks(String stockName,String startDate,String endDate) throws IOException
    {
        SparkConf conf = new SparkConf().setAppName("testSpark").setMaster("local[1]");

        JavaSparkContext sc = new JavaSparkContext(conf);
        HashMap<String,Double> map=new HashMap<>();
        int startYear = Integer.parseInt(startDate.split("-")[0]);
        int startMonth = Integer.parseInt(startDate.split("-")[1]);
        int startDay = Integer.parseInt(startDate.split("-")[2]);
        int endYear = Integer.parseInt(endDate.split("-")[0]);
        int endMonth = Integer.parseInt(endDate.split("-")[1]);
        int endDay = Integer.parseInt(endDate.split("-")[2]);


        for(int i=0;i<stockList.length;i++)
        {
            if(stockList[i].equals(stockName)) continue;;
//            JavaRDD<Tuple2<Tuple2<Date, String>, Double>> data=sc.objectFile("data/"+stockList[i]);
//            List <Tuple2<Tuple2<Date,String>,Double>> list= data.collect();
//            JavaRDD<Tuple2<Tuple2<Date, String>, Double>> dataMain=sc.objectFile("data/"+stockName);
//            List <Tuple2<Tuple2<Date,String>,Double>> listMain= dataMain.collect();
            Stock stock1 = YahooFinance.get(stockList[i]);
            Stock stock2 = YahooFinance.get(stockName);
            Calendar from = new GregorianCalendar(startYear, startMonth-1, startDay);
            Calendar to = new GregorianCalendar(endYear, endMonth-1, endDay);

            List<HistoricalQuote> his1 = stock1.getHistory(from,to,Interval.DAILY);
            List<HistoricalQuote> his2 = stock1.getHistory(from,to,Interval.DAILY);

            BigDecimal prev = stock1.getHistory().get(0).getClose();
            List <Tuple2<Tuple2<Date,String>,Double>> list1 = new ArrayList<>();
            List<HistoricalQuote> hists1 = stock1.getHistory(from,to,Interval.DAILY);

            for(HistoricalQuote hist:hists1){
//                buffer += (((hist.getDate().getTime(), stock1.getSymbol()), (hist.getClose().doubleValue()/prev.doubleValue() - 1) * 100));
                //buffer.add((((hist.getDate().getTime(), stock1.getSymbol()), (hist.getClose().doubleValue()/prev.doubleValue() - 1) * 100)));
                list1.add((new Tuple2<>(new Tuple2<Date, String>(hist.getDate().getTime(), stock1.getSymbol()), (hist.getClose().doubleValue()/prev.doubleValue() -1) * 100)));
                prev = hist.getClose();
            }

            BigDecimal prev2 = stock2.getHistory().get(0).getClose();
            List <Tuple2<Tuple2<Date,String>,Double>> list2 = new ArrayList<>();
            List<HistoricalQuote> hists2 = stock2.getHistory(from,to,Interval.DAILY);

            for(HistoricalQuote hist:hists2){
//                buffer += (((hist.getDate().getTime(), stock1.getSymbol()), (hist.getClose().doubleValue()/prev.doubleValue() - 1) * 100));
                //buffer.add((((hist.getDate().getTime(), stock1.getSymbol()), (hist.getClose().doubleValue()/prev.doubleValue() - 1) * 100)));
                list2.add((new Tuple2<>(new Tuple2<Date, String>(hist.getDate().getTime(), stock2.getSymbol()), (hist.getClose().doubleValue()/prev2.doubleValue() -1) * 100)));
                prev2 = hist.getClose();
            }

            System.out.println(list1);
            System.out.println(list2);

            map.put(stockList[i],computeStock(list1,list2));

        }
        Map<String,Double> sorted=sortByComparator(map);
        JsonObject stockLists=new JsonObject();
        JsonArray stock=new JsonArray();
        for (Map.Entry<String, Double> entry : sorted.entrySet()) {
            stockLists.addProperty(entry.getKey(),entry.getValue());
        }
        System.out.println(stockLists);
//         try-with-resources statement based on post comment below :)

        String fileName = "temp.json";
        if(new File(fileName).exists())
        {
            new File(fileName).delete();
        }

        try (FileWriter file = new FileWriter(fileName)) {
            file.write(stockLists.toString());
            System.out.println(stockLists);
        }
        catch (IOException e){

        }

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


