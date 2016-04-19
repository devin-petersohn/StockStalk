#!/usr/bin/env bash

#Git and Maven
sudo apt-get -y update
sudo apt-get -y install git
sudo apt-get -y install maven

#Clone the remote repository if you haven't yet
git clone https://github.com/devin-petersohn/StockStalk.git

#MySQL and set up the database
sudo apt-get -y install mysql-server
mysql -uroot -e "create database stockstalk"
mysql -uroot -h localhost stockstalk < setup_and_deploy/stockstalkdump.sql

#Apache Server and relocation of web pages
sudo apt-get -y install apache2
sudo apt-get -y install php5 libapache2-mod-php5
sudo apt-get -y install php5-mysql
sudo /etc/init.d/apache2 restart
sudo rm /var/www/html/index.html

#Jenkins and setup the daily caching of data
wget -q -O - https://jenkins-ci.org/debian/jenkins-ci.org.key | sudo apt-key add -
sudo sh -c 'echo deb http://pkg.jenkins-ci.org/debian binary/ > /etc/apt/sources.list.d/jenkins.list'
sudo apt-get -y update
sudo apt-get -y install jenkins

cd StockStalk

#Relocate all web files to the web server files location
sudo cp -r www/* /var/www/html

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

echo "Type the following command into a new terminal connection from your local machine:
"
echo "ssh -L 8080:`(/sbin/ifconfig $1 | grep "inet addr" | awk -F: '{print $2}' | awk '{print $1}' | head -n 1)`:80 username@<servername>-ssh.azurehdinsight.net
"
echo "You may access this application through a web browser using the following address:"
echo "localhost:8080"
