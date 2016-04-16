//
// Source code recreated from a .class file by IntelliJ IDEA
// (powered by Fernflower decompiler)
//


import java.io.Serializable;
import java.util.Map;
import java.util.Set;
import java.util.SortedSet;

public interface Instance extends Map<Integer, Double>, Iterable<Double>, Serializable {
    Object classValue();

    void setClassValue(Object var1);

    int noAttributes();

    /** @deprecated */
    @Deprecated
    int size();

    double value(int var1);

    Instance minus(Instance var1);

    SortedSet<Integer> keySet();

    Instance minus(double var1);

    Instance add(Instance var1);

    Instance divide(double var1);

    Instance divide(Instance var1);

    Instance add(double var1);

    Instance multiply(double var1);

    Instance multiply(Instance var1);

    void removeAttribute(int var1);

    Instance sqrt();

    int getID();

    Instance copy();

    void removeAttributes(Set<Integer> var1);
}
