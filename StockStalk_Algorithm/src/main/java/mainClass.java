/**
 * Created by ZeningZhang on 2/21/16.
 */
import net.sf.javaml.core.Instance;
import net.sf.javaml.core.SparseInstance;
import net.sf.javaml.distance.dtw.DTWSimilarity;
import net.sf.javaml.distance.fastdtw.dtw.*;
import net.sf.javaml.distance.fastdtw.dtw.DTW;

public class mainClass {
    public static void main(String[] args)
    {
//        float[] n2 = {1.5f, 3.9f, 4.1f, 3.3f};
//        float[] n1 = {2.1f, 2.45f, 3.673f, 4.32f, 2.05f, 1.93f, 5.67f, 6.01f};
//        DTW dtw = new DTW(n1, n2);
//        System.out.println(dtw);
        Instance instanceOne= new SparseInstance(10);
        instanceOne.put(1,1.0);
        instanceOne.put(2,2.0);
        instanceOne.put(3,3.0);
        Instance instanceTwo= new SparseInstance(10);
        instanceTwo.put(1,2.0);
        instanceTwo.put(2,3.0);
        instanceTwo.put(3,4.0);
        DTWSimilarity ds=new DTWSimilarity();
        DTW dtw=new DTW();

        System.out.println(ds.measure(instanceOne,instanceTwo));

    }


}
