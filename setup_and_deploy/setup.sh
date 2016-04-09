#!/usr/bin/env bash

(cd All_Against_All && mvn package)
(cd Cache_Data && mvn package)
(cd One_Against_All && mvn package)

spark-submit