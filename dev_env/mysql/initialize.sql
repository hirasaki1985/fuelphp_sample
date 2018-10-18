use mysql;

GRANT ALL PRIVILEGES ON *.* TO root@127.0.0.1;
GRANT ALL PRIVILEGES ON *.* TO root@10.0.2.2;
GRANT ALL PRIVILEGES ON *.* TO root@192.168.33.10;
GRANT ALL PRIVILEGES ON *.* TO root@localhost;

UPDATE user SET authentication_string=password('secret') WHERE user='root'

FLUSH PRIVILEGES;
