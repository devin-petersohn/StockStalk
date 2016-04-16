//
// Source code recreated from a .class file by IntelliJ IDEA
// (powered by Fernflower decompiler)
//


import java.io.Serializable;

public interface DistanceMeasure extends Serializable {
    double measure(Instance var1, Instance var2);

    boolean compare(double var1, double var3);

    double getMinValue();

    double getMaxValue();
}
