# DRP
## What is DRP? 

Daily Recipes Provider (DRP) is a web-application, which daily provides users nutritious recipes. DRP base on the information gathered from users such as: ‘age, health condition, tastes, and vice versa’, to calculate and estimate the nutrition contents the user’s body require to balance health.

Then from the data it has calculated, DRP provides alternative dinner recipes to users for their meals. In this way, people have no more worries about what they have to eat to balance their body nutrition and reduce many kinds of diseases related to uncontrolled-eating.

-- 
## How to run server to connect with MySQL server?

First, Sure to turn on MySQL server in Ammps before running index.php

Second, Make sure that $DB_USER has the necessary privileges to connect to the database from the specified host ('localhost'). You can do this by running in the MySQL command line on phpMyAdmin:

    Example with $DB_USER = 'ad_db_ct07' 
    SHOW GRANTS FOR 'ad_db_ct07'@'localhost';
    If not:
    GRANT ALL PRIVILEGES ON db_accounts.* TO 'ad_db_ct07'@'localhost';
    FLUSH PRIVILEGES;

Final, $DB_NAME, $DB_USER, $DB_PASSWORD in DataBase which privileged must be the same with in utils/config.php/

 !!!DB_SOCKET can other PATH in your PC!!!
