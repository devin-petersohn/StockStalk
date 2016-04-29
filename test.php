<?php
echo ("Hello Devin");
echo shell_exec("spark-submit --class Search One_Against_All/target/stockstalk-1.0-SNAPSHOT.jar 2015 1 1 2015 2 1 GOOG 2>&1");
?>
