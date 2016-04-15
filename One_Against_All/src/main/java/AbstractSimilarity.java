//
// Source code recreated from a .class file by IntelliJ IDEA
// (powered by Fernflower decompiler)
//



public abstract class AbstractSimilarity implements DistanceMeasure {
    private static final long serialVersionUID = 8279234668623952242L;

    public AbstractSimilarity() {
    }

    public boolean compare(double x, double y) {
        return x > y;
    }

    public double getMinValue() {
        return 1.0D;
    }

    public double getMaxValue() {
        return 0.0D;
    }
}
