//
// Source code recreated from a .class file by IntelliJ IDEA
// (powered by Fernflower decompiler)
//


import java.util.Collection;
import java.util.Collections;
import java.util.HashMap;
import java.util.Map;
import java.util.Set;
import java.util.TreeSet;
import java.util.Vector;
import java.util.Map.Entry;

public class SparseInstance extends AbstractInstance implements Instance {
    private HashMap<Integer, Double> data;
    private double defaultValue;
    private int noAttributes;
    private static final long serialVersionUID = -7642462956857985858L;

    public void setNoAttributes(int noAttributes) {
        this.noAttributes = noAttributes;
    }

    public SparseInstance() {
        this(-1);
    }

    public SparseInstance(int noAttributes) {
        this(noAttributes, 0.0D, (Object)null);
    }

    public SparseInstance(int noAttributes, double defaultValue) {
        this(noAttributes, defaultValue, (Object)null);
    }

    public SparseInstance(int noAttributes, Object classValue) {
        this(noAttributes, 0.0D, classValue);
    }

    public SparseInstance(int noAttributes, double defaultValue, Object classValue) {
        super(classValue);
        this.data = new HashMap();
        this.noAttributes = -1;
        this.defaultValue = defaultValue;
        this.noAttributes = noAttributes;
    }

    public SparseInstance(double[] datavector) {
        this(datavector, 0.0D, (Object)null);
    }

    public SparseInstance(double[] datavector, double defaultValue) {
        this(datavector, defaultValue, (Object)null);
    }

    public SparseInstance(double[] datavector, Object classValue) {
        this(datavector, 0.0D, classValue);
    }

    public SparseInstance(double[] datavector, double defaultValue, Object classValue) {
        super(classValue);
        this.data = new HashMap();
        this.noAttributes = -1;
        this.defaultValue = defaultValue;
        this.initiate(datavector);
    }

    private void initiate(double[] datavector) {
        this.data.clear();
        this.noAttributes = datavector.length;

        for(int i = 0; i < datavector.length; ++i) {
            if(datavector[i] != this.defaultValue) {
                this.put(Integer.valueOf(i), Double.valueOf(datavector[i]));
            }
        }

    }

    public double value(int pos) {
        return this.get(Integer.valueOf(pos)).doubleValue();
    }

    public void clear() {
        this.data.clear();
    }

    public boolean containsKey(Object key) {
        return this.data.containsKey(key);
    }

    public boolean containsValue(Object value) {
        return this.data.containsValue(value);
    }

    public Set<Entry<Integer, Double>> entrySet() {
        return this.data.entrySet();
    }

    public Double get(Object key) {
        return this.data.containsKey(key)?(Double)this.data.get(key):Double.valueOf(this.defaultValue);
    }

    public boolean isEmpty() {
        return this.data.isEmpty();
    }

    public TreeSet<Integer> keySet() {
        TreeSet set = new TreeSet();
        set.addAll(this.data.keySet());
        return set;
    }

    public Double put(Integer key, Double value) {
        return (Double)this.data.put(key, value);
    }

    public void putAll(Map<? extends Integer, ? extends Double> m) {
        this.data.putAll(m);
    }

    public Double remove(Object key) {
        return (Double)this.data.remove(key);
    }

    /** @deprecated */
    @Deprecated
    public int size() {
        return this.data.size();
    }

    public Collection<Double> values() {
        return this.data.values();
    }

    public int noAttributes() {
        return this.noAttributes < 0?(this.data.keySet().size() == 0?0:((Integer)Collections.max(this.data.keySet())).intValue() + 1):this.noAttributes;
    }

    public void removeAttribute(int remove) {
        this.data.remove(Integer.valueOf(remove));
        Vector indices = new Vector();
        indices.addAll(this.data.keySet());
        Collections.sort(indices);

        for(int i = 0; i < indices.size(); ++i) {
            int index = ((Integer)indices.get(i)).intValue();
            if(index > remove) {
                this.data.put(Integer.valueOf(index - 1), this.data.get(Integer.valueOf(index)));
                this.data.remove(Integer.valueOf(index));
            }
        }

        --this.noAttributes;
    }

    public String toString() {
        return "{" + this.data.toString() + ";" + this.classValue() + "}";
    }

    public int hashCode() {
        boolean prime = true;
        byte result = 1;
        int result1 = 31 * result + (this.data == null?0:this.data.hashCode());
        long temp = Double.doubleToLongBits(this.defaultValue);
        result1 = 31 * result1 + (int)(temp ^ temp >>> 32);
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
            SparseInstance other = (SparseInstance)obj;
            if(this.data == null) {
                if(other.data != null) {
                    return false;
                }
            } else if(!this.data.equals(other.data)) {
                return false;
            }

            return Double.doubleToLongBits(this.defaultValue) == Double.doubleToLongBits(other.defaultValue);
        }
    }

    public Instance copy() {
        SparseInstance out = new SparseInstance();
        out.data = new HashMap();
        out.data.putAll(this.data);
        out.defaultValue = this.defaultValue;
        out.noAttributes = this.noAttributes;
        out.setClassValue(this.classValue());
        return out;
    }

    public void removeAttributes(Set<Integer> indices) {
        Vector indix = new Vector();
        indix.addAll(indices);
        Collections.sort(indix);

        for(int i = indix.size() - 1; i >= 0; --i) {
            this.removeAttribute(((Integer)indix.get(i)).intValue());
        }

    }
}
