# fuelphp_sample


## develop
### install
```
$ docker-compose up -d
```

### /etc/hosts
```
127.0.0.1 example.com
```

### access
```
http://example.com:20080/
```

## memo
```
$ docker exec -it fuelphp_sample_webserver_1 bash
(container)$ cp /var/www/html/docker/webserver/vhosts/driverteach.conf /etc/apache2/sites-enabled
(container)$ apachectl configtest
(container)$ service apache2 restart

$ docker-compose stop && docker-compose rm -f
$ docker stop fuelphp_sample_webserver_1 && docker rm fuelphp_sample_webserver_1 && docker stop fuelphp_sample_mysql_1 && docker rm fuelphp_sample_mysql_1
```


