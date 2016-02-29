import net.sf.javaml.core.Instance
import net.sf.javaml.core.SparseInstance
import net.sf.javaml.distance.dtw.DTWSimilarity
import net.sf.javaml.distance.fastdtw.dtw._

import org.apache.spark.SparkContext
import org.apache.spark.SparkContext._
import org.apache.spark.SparkConf
import org.apache.spark.rdd.RDD

object Search {
  val sc = new SparkContext(new SparkConf().setAppName("Search").setMaster("local[4]"))

  def main(args: Array[String]) = {
    println("Hello World")
    val instanceOne: Instance = new SparseInstance(10)
    instanceOne.put(1, 1.0)
    instanceOne.put(2, 2.0)
    instanceOne.put(3, 3.0)
    val instanceTwo: Instance = new SparseInstance(10)
    instanceTwo.put(1, 2.0)
    instanceTwo.put(2, 3.0)
    instanceTwo.put(3, 4.0)
    val ds: DTWSimilarity = new DTWSimilarity
//    val dtw: DTW = new DTW



    System.out.println(ds.measure(instanceOne, instanceTwo))
  }
}