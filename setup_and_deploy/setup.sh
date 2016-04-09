#!/usr/bin/env bash

MASTER=$1
EXEC_MEM=$2
MASTER_MEM=$3

(cd All_Against_All && mvn install)
(cd All_Against_All && mvn package)

(cd Cache_Data && mvn install)
(cd Cache_Data && mvn package)

(cd One_Against_All && mvn install)
(cd One_Against_All && mvn package)


#Do the initial caching of data. Get all data for last 20 years.
spark-submit --master $MASTER --driver-memory $MASTER_MEM --executor_memory $EXEC_MEM --class Cache_Data Cache_Data/target/cache_data-1.0-SNAPSHOT.jar INITIAL

