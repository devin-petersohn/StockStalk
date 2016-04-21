# StockStalk
### Setup Instructions

##### Step 0: Required Environment
The setup script included in this repository is designed for setting up all dependencies and software requirements, building the sources, and beginning to cache the data in a Microsoft Azure HDInsight environment. There is no guarantee that this script will work for any other environment.

The following software will be downloaded:

* Apache Maven 3
* MySQL
* PHP
* Git
* Apache2
* Jenkins

All of this software is free to use or open source.

##### Step 1: Installing Dependencies and Building the Source
NOTE: It is recommend that you download the script `setup_and_deploy/setup.sh` and run directly from your home directory on your Microsoft Azure allocation. The script automatically clones the repository for you, so if you wish to clone the repo yourself, you must change the `setup.sh` bash script to account for this. 

We have developed scripts to automatically setup the environment and build the project executables. To begin, from your home directory execute:

`bash setup.sh`

The script will begin downloading and installing the software listed above, it will also build the source and cache the previous 20 years of stock data for the S&P500. The entire setup takes between 40 minutes and 1 hour using a 3 node cluster.

##### Step 2: Port Forwarding and Accessing Web UI

When the script is finished, there will be a couple of instructions to follow in order to access the web interface of the application.

Eg: `ssh -L 8080:10.0.14:80 username@<servername>-ssh.azurehdinsight.net`

In this example, 8080 is the local port that will forward all traffic to the cluster head node (indicated by the ip address) port 80. You must use your credentials to ssh into your HDInsight allocation to access this content.

In order to access the web server set up on your cluster allocation you must use port forwarding. It is simple to implement port forwarding:

1.  Use the port forwarding command output from the setup script. Remember to replace the username with your username and servername with the name of your HDInsight allocation name.
2.  Using a web browser, navigate to `localhost:8080`. Simply type this address into the navigation bar.
3.  From here you are ready to begin using StockStalk

Currently, Microsoft Azure HDInsight does not support a web server through traditional web browser access. While setting up the port forwarding is an additional step and may seem annoying, it can also provide additional security to your application and protect your cluster from being bombarded by queries. This software is set up and intended for personal use, so you will likely have to change some things to host this software for anyone. 

##### Step 3: Navigating the Web UI

You do not have to have to create an account to search, however creating an account provides two useful features: the ability to view your past search history and keep a 'portfolio' for tracking and search abilities. 