create database fuel_dev character set utf8mb4;

# use fuel_dev;
# create table migration(
#   type varchar(25),
#   name varchar(50),
#   migration varchar(100) NOT NULL DEFAULT ''
# );

use mysql;

#GRANT ALL PRIVILEGES ON *.* TO root@127.0.0.1;
#GRANT ALL PRIVILEGES ON *.* TO root@10.0.2.2;
#GRANT ALL PRIVILEGES ON *.* TO root@172.19.0.1;
#GRANT ALL PRIVILEGES ON *.* TO root@192.168.33.10;
#GRANT ALL PRIVILEGES ON *.* TO root@localhost;
GRANT ALL PRIVILEGES ON *.* TO root@'%';

# UPDATE user SET authentication_string=password('secret') WHERE user='root'

FLUSH PRIVILEGES;
