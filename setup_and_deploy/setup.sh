#!/usr/bin/env bash

MASTER='local'
EXEC_MEM='7G'

(cd All_Against_All && mvn install)
(cd All_Against_All && mvn package)

(cd Cache_Data && mvn install)
(cd Cache_Data && mvn package)

(cd One_Against_All && mvn install)
(cd One_Against_All && mvn package)



spark-submit --master $MASTER --executor_memory $EXEC_MEM Cache_Data/target/cache_data-1.0-SNAPSHOT.jar INITIAL