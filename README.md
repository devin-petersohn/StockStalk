# StockStalk
## Setup Instructions

#### Step 0: Required Environment
The setup script included in this repository is designed for setting up all dependencies and software requirements, building the sources, and beginning to cache the data in a Microsoft Azure HDInsight environment. There is no guarantee that this script will work for any other environment.

The following software will be downloaded:

* Apache Maven 3
* MySQL
* PHP
* Git
* Apache2
* Jenkins

All of this software is free to use or open source.

#### Step 1: Installing Dependencies and Building the Source
NOTE: It is recommend that you download the script `setup_and_deploy/setup.sh` and run directly from your home directory on your Microsoft Azure allocation. The script automatically clones the repository for you, so if you wish to clone the repo yourself or use a different version, you must change the `setup.sh` bash script to account for this. From your home directory type:

`wget raw.githubusercontent.com/devin-petersohn/StockStalk/master/setup_and_deploy/setup.sh`

We have developed scripts to automatically setup the environment and build the project executables. To begin, from your home directory execute:

`bash setup.sh`

The script will begin downloading and installing the software listed above, it will also build the source and cache the previous 20 years of stock data for the S&P500. The entire setup takes between 40 minutes and 1 hour using a 3 node cluster.

#### Step 2: Port Forwarding and Accessing Web UI

When the script is finished, there will be a couple of instructions to follow in order to access the web interface of the application.

Eg: `ssh -L 8080:10.0.14:80 username@<servername>-ssh.azurehdinsight.net`

In this example, 8080 is the local port that will forward all traffic to the cluster head node (indicated by the ip address) port 80. You must use your credentials to ssh into your HDInsight allocation to access this content.

In order to access the web server set up on your cluster allocation you must use port forwarding. It is simple to implement port forwarding:

1.  Use the port forwarding command output from the setup script. Remember to replace the username with your username and servername with the name of your HDInsight allocation name.
2.  Using a web browser, navigate to `localhost:8080`. Simply type this address into the navigation bar.
3.  From here you are ready to begin using StockStalk

Currently, Microsoft Azure HDInsight does not support a web server through traditional web browser access. While setting up the port forwarding is an additional step and may seem annoying, it can also provide additional security to your application and protect your cluster from being bombarded by queries. This software is set up and intended for personal use, so you will likely have to change some things to host this software for anyone. 

#### Step 3: Navigating the Web UI

You do not have to have to create an account to search, however creating an account provides two useful features: the ability to view your past search history and keep a 'portfolio' for tracking and search abilities. 

#### Creating an Account
From the home page, click the login button in the navigation bar at the top of the page. This navigation bar will be useful for moving between page. If you'd like, you can login using Facebook or Google, or you can create an account. Once you create an account you can log in and begin using the application.

#### Portfolio
To get to your portfolio, click 'Portfolio' from the navigation bar. In your portfolio, you can look at the historical chart of any number of stocks you'd like to see together. You are free to add as many stocks as you'd like from the S&P500 to your portfolio.

#### Search
There are 3 searches available in this application:

##### All against All
In this search type, you are looking to find the longest period of time that any 2+ stocks moved very similarly. You may choose any number of stocks in the S&P500, or even search among all S&P500 stocks.

    NOTE: The more stocks you add the longer this search will take. Please be aware of this.

##### One against All
In this search type, you are looking to score a stocks price movement against that off all other stocks in the S&P500.

##### Single Stock Search
In Single Stock search, you will look at the chart of a single stock. 
