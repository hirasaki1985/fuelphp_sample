# fuelphp_sample
docker-composeかvagrantを使用してfuel_php1.8の開発環境構築をするためのリポジトリです。

## develop
### use docker
#### require
* docker / docker-compose

#### install
```
$ docker-compose up -d
```

#### /etc/hosts
```
127.0.0.1 example.com
```

#### initialize
```
$ docker exec -it fuelphp_sample_mysql_1 bash
(container)$ mysql -u root -p < /docker-entrypoint-initdb.d/initialize.sql (pass: secret)
(container)$ exit
$ docker exec -it fuelphp_sample_webserver_1 bash
(container)$ php composer.phar install
(container)$ php oil refine migrate
```

#### access
```
http://example.com:20080/
```

### use vagrant
```
$ vagrant plugin install vagrant-vbguest
$ vagrant up
```

#### /etc/hosts
```
127.0.0.1 example.com
```

#### migrate
```
// $ vagrant ssh
// $ cd /var/www/html && php oil refine migrate
```

#### config
log output   : /var/log/fuelphp/
project root : /var/www/html

## 参考
[【PHP】PHPをインストールしたらやっておきたい設定](https://qiita.com/knife0125/items/0e1af52255e9879f9332)
[CentOS 6 の環境にPHP7をインストールしてApacheで動かすまで](https://qiita.com/ssaita/items/9e0170251d45ed1b8818)
