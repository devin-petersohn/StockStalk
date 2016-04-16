//
// Source code recreated from a .class file by IntelliJ IDEA
// (powered by Fernflower decompiler)
//


import java.util.Iterator;

public abstract class AbstractInstance implements Instance {
    private static final long serialVersionUID = -1712202124913999825L;
    static int nextID = 0;
    private final int ID;
    private Object classValue;

    public int getID() {
        return this.ID;
    }

    public Iterator<Double> iterator() {
        return new AbstractInstance.InstanceValueIterator();
    }

    protected AbstractInstance() {
        this((Object)null);
    }

    protected AbstractInstance(Object classValue) {
        this.ID = nextID++;
        this.classValue = classValue;
    }

    public Object classValue() {
        return this.classValue;
    }

    public void setClassValue(Object classValue) {
        this.classValue = classValue;
    }

    public Instance minus(Instance min) {
        DenseInstance out = new DenseInstance(new double[this.noAttributes()]);

        for(int i = 0; i < this.noAttributes(); ++i) {
            out.put(Integer.valueOf(i), Double.valueOf(((Double)this.get(Integer.valueOf(i))).doubleValue() - ((Double)min.get(Integer.valueOf(i))).doubleValue()));
        }

        return out;
    }

    public Instance minus(double min) {
        DenseInstance out = new DenseInstance(new double[this.noAttributes()]);

        for(int i = 0; i < this.noAttributes(); ++i) {
            out.put(Integer.valueOf(i), Double.valueOf(((Double)this.get(Integer.valueOf(i))).doubleValue() - min));
        }

        return out;
    }

    public Instance divide(double min) {
        DenseInstance out = new DenseInstance(new double[this.noAttributes()]);

        for(int i = 0; i < this.noAttributes(); ++i) {
            out.put(Integer.valueOf(i), Double.valueOf(((Double)this.get(Integer.valueOf(i))).doubleValue() / min));
        }

        return out;
    }

    public Instance multiply(double value) {
        DenseInstance out = new DenseInstance(new double[this.noAttributes()]);

        for(int i = 0; i < this.noAttributes(); ++i) {
            out.put(Integer.valueOf(i), Double.valueOf(((Double)this.get(Integer.valueOf(i))).doubleValue() * value));
        }

        return out;
    }

    public int hashCode() {
        return this.ID;
    }

    public boolean equals(Object obj) {
        if(this == obj) {
            return true;
        } else if(obj == null) {
            return false;
        } else if(this.getClass() != obj.getClass()) {
            return false;
        } else {
            AbstractInstance other = (AbstractInstance)obj;
            return this.ID == other.ID;
        }
    }

    public Instance multiply(Instance value) {
        DenseInstance out = new DenseInstance(new double[this.noAttributes()]);

        for(int i = 0; i < this.noAttributes(); ++i) {
            out.put(Integer.valueOf(i), Double.valueOf(((Double)this.get(Integer.valueOf(i))).doubleValue() * ((Double)value.get(Integer.valueOf(i))).doubleValue()));
        }

        return out;
    }

    public Instance divide(Instance min) {
        DenseInstance out = new DenseInstance(new double[this.noAttributes()]);

        for(int i = 0; i < this.noAttributes(); ++i) {
            out.put(Integer.valueOf(i), Double.valueOf(((Double)this.get(Integer.valueOf(i))).doubleValue() / ((Double)min.get(Integer.valueOf(i))).doubleValue()));
        }

        return out;
    }

    public Instance add(double min) {
        DenseInstance out = new DenseInstance(new double[this.noAttributes()]);

        for(int i = 0; i < this.noAttributes(); ++i) {
            out.put(Integer.valueOf(i), Double.valueOf(((Double)this.get(Integer.valueOf(i))).doubleValue() + min));
        }

        return out;
    }

    public Instance add(Instance min) {
        DenseInstance out = new DenseInstance(new double[this.noAttributes()]);

        for(int i = 0; i < this.noAttributes(); ++i) {
            out.put(Integer.valueOf(i), Double.valueOf(((Double)this.get(Integer.valueOf(i))).doubleValue() + ((Double)min.get(Integer.valueOf(i))).doubleValue()));
        }

        return out;
    }

    public Instance sqrt() {
        DenseInstance out = new DenseInstance(new double[this.noAttributes()]);

        for(int i = 0; i < this.noAttributes(); ++i) {
            out.put(Integer.valueOf(i), Double.valueOf(Math.sqrt(((Double)this.get(Integer.valueOf(i))).doubleValue())));
        }

        return out;
    }

    class InstanceValueIterator implements Iterator<Double> {
        private int index = 0;

        InstanceValueIterator() {
        }

        public boolean hasNext() {
            return this.index < AbstractInstance.this.noAttributes();
        }

        public Double next() {
            ++this.index;
            return Double.valueOf(AbstractInstance.this.value(this.index - 1));
        }

        public void remove() {
            throw new UnsupportedOperationException("Cannot remove from instance using the iterator.");
        }
    }
}
