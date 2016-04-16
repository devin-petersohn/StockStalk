#!/usr/bin/env bash

echo "Please wait for packages to be installed"

sudo apt-get -y update
sudo apt-get -y install git
sudo apt-get -y install maven
sudo apt-get -y install openjdk-7-jdk

export JAVA_HOME=/usr/lib/jvm/java-7-openjdk-amd64/

# installation of Oracle Java JDK.
sudo apt-get -y update
sudo apt-get -y install python-software-properties

# Installation of commonly used python scipy tools
sudo apt-get -y install python-numpy python-scipy python-matplotlib ipython ipython-notebook python-pandas python-sympy python-nose

# Installation of scala
wget http://www.scala-lang.org/files/archive/scala-2.11.1.deb
sudo dpkg -i scala-2.11.1.deb
sudo apt-get -y update
sudo apt-get -y install scala

# Installation of sbt
echo "deb https://dl.bintray.com/sbt/debian /" | sudo tee -a /etc/apt/sources.list.d/sbt.list
sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 642AC823
sudo apt-get -y update
sudo apt-get -y install sbt

# Downloading spark
wget http://d3kbcqa49mib13.cloudfront.net/spark-1.6.1.tgz
tar -zxf spark-1.6.1.tgz
cd spark-1.6.1

# Building spark
./sbt/sbt assembly

export PATH=~/spark-1.6.1/bin/:$PATH

# Clean-up
rm scala-2.11.1.deb*
rm spark-1.6.1.tgz


sudo apt-get -y install apache2


git clone https://github.com/devin-petersohn/StockStalk.git

cd StockStalk

(cd All_Against_All && mvn install)
(cd All_Against_All && mvn package)

(cd Cache_Data && mvn install)
(cd Cache_Data && mvn package)

(cd One_Against_All && mvn install)
(cd One_Against_All && mvn package)

#Do the initial caching of data. Get all data for last 20 years.
spark-submit --class Cache_Data Cache_Data/target/cache_data-1.0-SNAPSHOT.jar INITIAL &



