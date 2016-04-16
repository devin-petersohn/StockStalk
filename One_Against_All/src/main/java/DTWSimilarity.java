//
// Source code recreated from a .class file by IntelliJ IDEA
// (powered by Fernflower decompiler)
//


import java.util.ArrayList;

public class DTWSimilarity extends AbstractSimilarity {
    private static final long serialVersionUID = -8898553450277603746L;

    public DTWSimilarity() {
    }

    private double pointDistance(int i, int j, double[] ts1, double[] ts2) {
        double diff = ts1[i] - ts2[j];
        return diff * diff;
    }

    private double distance2Similarity(double x) {
        return 1.0D - x / (1.0D + x);
    }

    public double measure(Instance x, Instance y) {
        ArrayList l1 = new ArrayList();
        ArrayList l2 = new ArrayList();

        int i;
        double ts1;
        for(i = 0; i < x.noAttributes(); ++i) {
            ts1 = x.value(i);
            if(!Double.isNaN(ts1)) {
                l1.add(Double.valueOf(ts1));
            }
        }

        for(i = 0; i < y.noAttributes(); ++i) {
            ts1 = y.value(i);
            if(!Double.isNaN(ts1)) {
                l2.add(new Double(ts1));
            }
        }

        double[] var17 = new double[l1.size()];
        double[] ts2 = new double[l2.size()];

        for(i = 0; i < var17.length; ++i) {
            var17[i] = ((Double)l1.get(i)).doubleValue();
        }

        for(i = 0; i < ts2.length; ++i) {
            ts2[i] = ((Double)l2.get(i)).doubleValue();
        }

        double[][] dP2P = new double[var17.length][ts2.length];

        int j;
        for(i = 0; i < var17.length; ++i) {
            for(j = 0; j < ts2.length; ++j) {
                dP2P[i][j] = this.pointDistance(i, j, var17, ts2);
            }
        }

        if(var17.length != 0 && ts2.length != 0) {
            if(var17.length == 1 && ts2.length == 1) {
                return this.distance2Similarity(Math.sqrt(dP2P[0][0]));
            } else {
                double[][] D = new double[var17.length][ts2.length];
                D[0][0] = dP2P[0][0];

                for(i = 1; i < var17.length; ++i) {
                    D[i][0] = dP2P[i][0] + D[i - 1][0];
                }

                double var19;
                if(ts2.length == 1) {
                    var19 = 0.0D;

                    for(i = 0; i < var17.length; ++i) {
                        var19 += D[i][0];
                    }

                    return this.distance2Similarity(Math.sqrt(var19) / (double)var17.length);
                } else {
                    for(j = 1; j < ts2.length; ++j) {
                        D[0][j] = dP2P[0][j] + D[0][j - 1];
                    }

                    if(var17.length == 1) {
                        var19 = 0.0D;

                        for(j = 0; j < ts2.length; ++j) {
                            var19 += D[0][j];
                        }

                        return this.distance2Similarity(Math.sqrt(var19) / (double)ts2.length);
                    } else {
                        double dist;
                        for(i = 1; i < var17.length; ++i) {
                            for(j = 1; j < ts2.length; ++j) {
                                double[] k = new double[]{D[i - 1][j - 1], D[i - 1][j], D[i][j - 1]};
                                dist = Math.min(k[0], Math.min(k[1], k[2]));
                                D[i][j] = dP2P[i][j] + dist;
                            }
                        }

                        i = var17.length - 1;
                        j = ts2.length - 1;
                        int var18 = 1;

                        for(dist = D[i][j]; i + j > 2; dist += D[i][j]) {
                            if(i == 0) {
                                --j;
                            } else if(j == 0) {
                                --i;
                            } else {
                                double[] steps = new double[]{D[i - 1][j - 1], D[i - 1][j], D[i][j - 1]};
                                double min = Math.min(steps[0], Math.min(steps[1], steps[2]));
                                if(min == steps[0]) {
                                    --i;
                                    --j;
                                } else if(min == steps[1]) {
                                    --i;
                                } else if(min == steps[2]) {
                                    --j;
                                }
                            }

                            ++var18;
                        }

                        return this.distance2Similarity(Math.sqrt(dist) / (double)var18);
                    }
                }
            }
        } else {
            return 0.0D / 0.0;
        }
    }
}
