# Library Management System (PHP, MariaDB)
This project showcases use of MariaDB database and SQL in conjunction with
PHP back-end. It is extension of the previous Library Management Project. It
uses existing MariaDB database management system instead of a naive
implementation. This uses PHP scripting to generate queries, get data from
database, and return the response in HTML format. This is more focused on
the PHP scripting and SQL queries.
 
## Overview

The operations supported in this are divided into three categories.
* Insert Operations
	* Person
	* Book
* Query Operations
	* Person
		* By Name
		* By ID
	* Book
		* By Name
		* By ID
* Transaction Operations
	* Issue a book
	* Return a book
	* List issued books issued to a person

## Requirements, Setup Procedure

The system hosting the website must have PHP and MariaDB (or any SQL server). I have used XAMPP on windows laptop. Once you get the PHP server and MariaDB server running and configured then you are good to go.

In setup, the host name, user name, password, database name are needed to be provided in a  PHP array named collection. This is later used by the back end server to connect to SQL server. This is stored in a file connections.php stored in directory called htconfig in the same directory as htdocs where the PHP scripts reside. Inside the XAMPP install directory. The connections.php I used is [here](%3Cscript%20src=%22https://gist.github.com/akhilesh-kumar-verma/ddb2bd6a799fe55020b09e3ec1917520.js%22%3E%3C/script%3E).

## Possible Improvements
* Bootstrap can used to improve the front-end.
