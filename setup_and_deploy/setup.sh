#!/usr/bin/env bash

echo "Please wait for packages to be installed"

sudo apt-get -y update
sudo apt-get -y install git
sudo apt-get -y install maven

sudo apt-get -y install apache2

wget -q -O - https://jenkins-ci.org/debian/jenkins-ci.org.key | sudo apt-key add -
sudo sh -c 'echo deb http://pkg.jenkins-ci.org/debian binary/ > /etc/apt/sources.list.d/jenkins.list'
sudo apt-get -y update
sudo apt-get -y install jenkins

git clone https://github.com/devin-petersohn/StockStalk.git

cd StockStalk

(cd All_Against_All && mvn clean)
(cd All_Against_All && mvn install)
(cd All_Against_All && mvn package)

(cd Cache_Data && mvn clean)
(cd Cache_Data && mvn install)
(cd Cache_Data && mvn package)

(cd One_Against_All && mvn clean)
(cd One_Against_All && mvn install)
(cd One_Against_All && mvn package)

#Do the initial caching of data. Get all data for last 20 years.
spark-submit --class CacheData Cache_Data/target/CacheData-1.0-SNAPSHOT.jar INITIAL



