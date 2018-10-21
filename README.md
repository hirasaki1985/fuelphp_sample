# fuelphp_sample
docker-composeかvagrantを使用してfuel_php1.8の開発環境構築をするためのリポジトリです。

## develop
### install
#### use docker
```
$ docker-compose up -d
```

#### use vagrant
```
$ vagrant plugin install vagrant-vbguest
$ vagrant up
```

### /etc/hosts
```
127.0.0.1 example.com
```

### access
```
http://example.com:20080/
```

### migrate
```
$ docker exec -it fuelphp_sample_webserver_1 bash
```

## memo
```
$ docker exec -it fuelphp_sample_webserver_1 bash
(container)$ cp /var/www/html/dev_env/webserver/vhosts/driverteach.conf /etc/apache2/sites-enabled
(container)$ apachectl configtest
(container)$ service apache2 restart

$ docker-compose stop && docker-compose rm -f
$ docker stop fuelphp_sample_webserver_1 && docker rm fuelphp_sample_webserver_1 && docker stop fuelphp_sample_mysql_1 && docker rm fuelphp_sample_mysql_1
$ docker-compose build --no-cache && docker-compose up -d
```

## 参考
[【PHP】PHPをインストールしたらやっておきたい設定](https://qiita.com/knife0125/items/0e1af52255e9879f9332)
[CentOS 6 の環境にPHP7をインストールしてApacheで動かすまで](https://qiita.com/ssaita/items/9e0170251d45ed1b8818)

