#!/usr/bin/env bash

sudo apt-get update
sudo apt-get install git
sudo apt-get install maven
sudo apt-get install default-jre
sudo apt-get install apache2


git clone https://github.com/devin-petersohn/StockStalk.git

cd StockStalk

(cd All_Against_All && mvn install)
(cd All_Against_All && mvn package)

(cd Cache_Data && mvn install)
(cd Cache_Data && mvn package)

(cd One_Against_All && mvn install)
(cd One_Against_All && mvn package)

#Do the initial caching of data. Get all data for last 20 years.
spark-submit --class Cache_Data Cache_Data/target/cache_data-1.0-SNAPSHOT.jar INITIAL


