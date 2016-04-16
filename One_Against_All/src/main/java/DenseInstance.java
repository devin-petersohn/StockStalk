//
// Source code recreated from a .class file by IntelliJ IDEA
// (powered by Fernflower decompiler)
//


import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collection;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;
import java.util.Set;
import java.util.SortedSet;
import java.util.TreeSet;
import java.util.Map.Entry;

public class DenseInstance extends AbstractInstance implements Instance {
    private static final long serialVersionUID = 3284511291715269081L;
    private double[] attributes;

    public DenseInstance(double[] att) {
        this(att, (Object)null);
    }

    public DenseInstance(double[] att, Object classValue) {
        super(classValue);
        this.attributes = (double[])att.clone();
    }

    private DenseInstance() {
    }

    public DenseInstance(int size) {
        this(new double[size]);
    }

    public double value(int pos) {
        return this.attributes[pos];
    }

    public void clear() {
        this.attributes = new double[this.attributes.length];
    }

    public boolean containsKey(Object key) {
        if(!(key instanceof Integer)) {
            return false;
        } else {
            int i = ((Integer)key).intValue();
            return i >= 0 && i < this.attributes.length;
        }
    }

    public boolean containsValue(Object value) {
        if(value instanceof Number) {
            double val = ((Number)value).doubleValue();

            for(int i = 0; i < this.attributes.length; ++i) {
                if(Math.abs(val - this.attributes[i]) < 1.0E-8D) {
                    return true;
                }
            }
        }

        return false;
    }

    public Set<Entry<Integer, Double>> entrySet() {
        HashMap map = new HashMap();

        for(int i = 0; i < this.attributes.length; ++i) {
            map.put(Integer.valueOf(i), Double.valueOf(this.attributes[i]));
        }

        return map.entrySet();
    }

    public Double get(Object key) {
        return Double.valueOf(this.attributes[((Integer)key).intValue()]);
    }

    public boolean isEmpty() {
        return false;
    }

    public SortedSet<Integer> keySet() {
        TreeSet keys = new TreeSet();

        for(int i = 0; i < this.attributes.length; ++i) {
            keys.add(Integer.valueOf(i));
        }

        return keys;
    }

    public Double put(Integer key, Double value) {
        double val = this.attributes[key.intValue()];
        this.attributes[key.intValue()] = value.doubleValue();
        return Double.valueOf(val);
    }

    public void putAll(Map<? extends Integer, ? extends Double> m) {
        Integer key;
        for(Iterator i$ = m.keySet().iterator(); i$.hasNext(); this.attributes[key.intValue()] = ((Double)m.get(key)).doubleValue()) {
            key = (Integer)i$.next();
        }

    }

    public Double remove(Object key) {
        throw new UnsupportedOperationException("Cannot unset values from a dense instance.");
    }

    /** @deprecated */
    @Deprecated
    public int size() {
        return this.attributes.length;
    }

    public Collection<Double> values() {
        ArrayList vals = new ArrayList();
        double[] arr$ = this.attributes;
        int len$ = arr$.length;

        for(int i$ = 0; i$ < len$; ++i$) {
            double v = arr$[i$];
            vals.add(Double.valueOf(v));
        }

        return vals;
    }

    public int noAttributes() {
        return this.attributes.length;
    }

    public String toString() {
        return "{" + Arrays.toString(this.attributes) + ";" + this.classValue() + "}";
    }

    public void removeAttribute(int i) {
        double[] tmp = (double[])this.attributes.clone();
        this.attributes = new double[tmp.length - 1];
        System.arraycopy(tmp, 0, this.attributes, 0, i);
        System.arraycopy(tmp, i + 1, this.attributes, i, tmp.length - i - 1);
    }

    public int hashCode() {
        boolean prime = true;
        byte result = 1;
        int result1 = 31 * result + Arrays.hashCode(this.attributes);
        return result1;
    }

    public boolean equals(Object obj) {
        if(this == obj) {
            return true;
        } else if(obj == null) {
            return false;
        } else if(this.getClass() != obj.getClass()) {
            return false;
        } else {
            DenseInstance other = (DenseInstance)obj;
            return Arrays.equals(this.attributes, other.attributes);
        }
    }

    public Instance copy() {
        DenseInstance out = new DenseInstance();
        out.attributes = (double[])this.attributes.clone();
        out.setClassValue(this.classValue());
        return out;
    }

    public void removeAttributes(Set<Integer> indices) {
        double[] tmp = (double[])this.attributes.clone();
        this.attributes = new double[tmp.length - indices.size()];
        int index = 0;

        for(int i = 0; i < tmp.length; ++i) {
            if(!indices.contains(Integer.valueOf(i))) {
                this.attributes[index++] = tmp[i];
            }
        }

    }
}
