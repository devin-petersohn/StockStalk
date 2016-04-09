# StockStalk
### Setup Instructions

##### Step 0: Required Software
In order to setup the environment, you must first install the following software for everything to work properly:
* Apache Maven 3.3.9+
* Apache Spark 1.4+
* Java 1.6+
* Scala 2.10.3+
* MySQL
* PHP

All of this software is free to use or open source.

##### Step 1: Building and Compiling required code
NOTE: All commands must be executed from the root directory of this software package: StockStalk.

We have developed scripts to automatically setup the environment and build the project executables. To begin, from the root directory type:
`bash setup_and_deploy/setup.sh`
The script will begin downloading and installing all Maven dependencies. This may take some time.