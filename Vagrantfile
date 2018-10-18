# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # default_provider = "virtualbox"
  # default_provider = "hyperv"
  # active_provider = "hyperv"
  # config.vm.provider "hyperv"

  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "centos/7"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  config.vm.network "forwarded_port", guest: 80, host: 20080

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  # config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  # config.vm.network "private_network", ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.

  ## windows - hyper-v
  #config.vm.synced_folder ".", "/var/www/html", type: "smb", mount_options: ["username=${YOUR_USERNAME}","password=${YOUR_PASSWORD"]

  ## other os
  config.vm.synced_folder "./", "/var/www/html"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  # config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
  # end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Enable provisioning with a shell script. Additional provisioners such as
  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
  # config.vm.provision "shell", inline: <<-SHELL
  #   apt-get update
  #   apt-get install -y apache2
  # SHELL
  config.vm.provision "shell", inline: $setup
  config.vm.provision "shell", run: "always", inline: $start
end

$setup = <<SCRIPT
  ## defines
  PROJECT_ROOT=/var/www/html
  #mkdir -p /var/www/
  #ln -s /vagrant/ /var/www/html

  ## init
  yum update -y && yum upgrade -y
  yum install -y http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
  yum install -y yum-utils
  yum install -y git unzip lsof sendmail sendmail-cf npm gzip vim php-fpm
  yum install -y gcc gcc-c++ wget tar autoconf gd-devel libxml2-devel t1lib-devel bzip2-devel curl-devel gmp-devel aspell-devel recode-devel

  ## jpn lang
  yum -y install ibus-kkc vlgothic-*
  localectl set-locale LANG=ja_JP.UTF-8
  source /etc/locale.conf
  localedef -f UTF-8 -i ja_JP ja_JP.UTF-8

  ## timezone
  timedatectl set-timezone Asia/Tokyo

  #
  # Apache
  #
  yum -y install httpd httpd-devel
  # /sbin/service httpd restart
  /sbin/chkconfig httpd on
  cp -rp /etc/httpd/conf/httpd.conf /etc/httpd/conf/httpd.conf.bkup
  cp -rp $PROJECT_ROOT/docker/webserver/httpd/httpdconf.vagrant.conf /etc/httpd/conf/httpd.conf
  cp -rp $PROJECT_ROOT/docker/webserver/vhosts/* /etc/httpd/conf.d/

  ## install php71 preparation
  ### re2c
  #cd /tmp && wget http://downloads.sourceforge.net/project/re2c/re2c/0.14.3/re2c-0.14.3.tar.gz \
  #  tar zxvf re2c-0.14.3.tar.gz && cd re2c-0.14.3 && ./configure && make && make install
  cd /tmp && curl http://dl.fedoraproject.org/pub/epel/7/x86_64/Packages/r/re2c-0.14.3-2.el7.x86_64.rpm --output re2c-0.14.3-2.el7.x86_64.rpm
  rpm -Uvh re2c-0.14.3-2.el7.x86_64.rpm

  ### bison
  cd /tmp && wget http://ftp.gnu.org/gnu/bison/bison-3.0.4.tar.gz && tar zxvf bison-3.0.4.tar.gz && \
    cd bison-3.0.4 && ./configure && make && make install

  ## install php71
  # yum-config-manager --enable remi-php71
  # yum install -y --enablerepo=remi-php71 php-fpm php-mcrypt php-cli php-common php-devel php-gd php-mbstring php-mysqlnd php-opcache php-pdo php-pear php-pecl-apcu php-pecl-zip php-process php-xml
  cd /tmp && git clone https://git.php.net/repository/php-src.git
  cd php-src/ && git checkout tags/php-7.1.23 -b php-7.1.23 && buildconf --force
  ./configure \
    --prefix=$HOME/tmp/usr \
    --with-config-file-path=$HOME/tmp/usr/etc \
    --enable-mbstring \
    --enable-zip \
    --enable-bcmath \
    --enable-pcntl \
    --enable-ftp \
    --enable-exif \
    --enable-calendar \
    --enable-sysvmsg \
    --enable-sysvsem \
    --enable-sysvshm \
    --enable-wddx \
    --with-curl \
    --with-mcrypt \
    --with-iconv \
    --with-gmp \
    --with-pspell \
    --with-gd \
    --with-jpeg-dir=/usr \
    --with-png-dir=/usr \
    --with-zlib-dir=/usr \
    --with-xpm-dir=/usr \
    --with-freetype-dir=/usr \
    --with-t1lib=/usr \
    --enable-gd-native-ttf \
    --enable-gd-jis-conv \
    --with-openssl \
    --with-mysql=/usr \
    --with-pdo-mysql=/usr \
    --with-gettext=/usr \
    --with-zlib=/usr \
    --with-bz2=/usr \
    --with-recode=/usr \
    --with-mysqli=/usr/bin/mysql_config \
    --with-apxs2=/usr/sbin/apxs


  cp -p /etc/php.ini /etc/php.ini.bkup
  cp -p $PROJECT_ROOT/docker/webserver/php/php.vagrant.ini /etc/php.ini
  php -v

  ## install composer
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  php composer-setup.php
  php -r "unlink('composer-setup.php');"
  mv composer.phar /usr/local/bin/composer
  su vagrant -c "composer --version"

  ## fuel php
  curl https://get.fuelphp.com/oil | sh

  ## uninstall mariadb
  yum remove -y mariadb-libs

  ## install mysql 5.7
  # yum localinstall -y http://dev.mysql.com/get/mysql57-community-release-el6-7.noarch.rpm
  # yum-config-manager --enable mysql57-community
  # yum info mysql-community-server
  # yum install -y mysql57-community-server
  # mysqld --version

  rpm -Uvh http://dev.mysql.com/get/mysql57-community-release-el7-11.noarch.rpm
  yum install -y --enablerepo=mysql57-community mysql-community-server
  mysqld --version

  mkdir -p /etc/mysql/
  ln -s /etc/my.cnf.d /etc/mysql/conf.d
  cp -p /etc/my.cnf /etc/my.cnf.bkup
  cp -p $PROJECT_ROOT/docker/mysql/my.cnf /etc/my.cnf

  ## auto start
  # /usr/bin/systemctl enable mysqld.service
  /sbin/chkconfig mysqld on

  #
  # iptables off
  #
  /sbin/iptables -F
  /sbin/service iptables stop
  /sbin/chkconfig iptables off

  #
  setenforce 0

  #
  # project
  #
  cd $PROJECT_ROOT && /usr/local/bin/composer install

SCRIPT

$start = <<SCRIPT
  #/sbin/service httpd restart
  #/sbin/service mysqld restart
  sudo /usr/bin/systemctl start mysqld.service
  sudo /usr/bin/systemctl start httpd
  setenforce 0
SCRIPT
