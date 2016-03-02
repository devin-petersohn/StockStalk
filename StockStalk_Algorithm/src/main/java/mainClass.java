/**
 * Created by ZeningZhang on 2/21/16.
 */
import net.sf.javaml.clustering.mcl.DoubleFormat;
import net.sf.javaml.core.Instance;
import net.sf.javaml.core.SparseInstance;
import net.sf.javaml.distance.dtw.DTWSimilarity;
import net.sf.javaml.distance.fastdtw.dtw.*;
import net.sf.javaml.distance.fastdtw.dtw.DTW;

import java.sql.Timestamp;
import java.util.Calendar;
import java.util.Collection;
import java.util.Date;

public class mainClass {
    public static void main(String[] args)
    {
        Date d=new Date();
        Calendar cal = Calendar.getInstance();
        cal.set(Calendar.HOUR_OF_DAY,17);
        cal.set(Calendar.MINUTE,30);
        cal.set(Calendar.SECOND,0);
        cal.set(Calendar.MILLISECOND,2);
        cal.set(Calendar.MONTH,5);
        cal.set(Calendar.YEAR,2015);
        cal.set(Calendar.DATE,4);
        d = cal.getTime();

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

    public double computeStock(Collection<Date> stockTime1, Collection<Integer> stockPercent1,Collection<Date> stockTime2, Collection<Integer> stockPercent2)
    {

        Instance host= new SparseInstance(stockTime1.size());
        Instance guest= new SparseInstance(stockPercent1.size());
        if(stockTime1.size()!=stockPercent1.size() || stockTime2.size()!=stockPercent2.size() )
        {
            System.out.println("The size time is not the same as percentage");
        }
        for(Date time:stockTime1)
        {
            host.put(makeTimeStamp(time), Double.parseDouble(stockPercent1.toString()));
        }
        for(Date time: stockTime2)
        {
            guest.put(makeTimeStamp(time), Double.parseDouble(stockPercent1.toString()));
        }
        DTWSimilarity ds=new DTWSimilarity();
        return ds.measure(host,guest);
    }


}
