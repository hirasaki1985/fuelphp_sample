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
  config.vm.network "forwarded_port", guest: 3306, host: 23306

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
  config.vm.synced_folder "./", "/var/www/html", mount_options: ['dmode=777','fmode=755']

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
  LOG_DIR=/var/log/fuelphp/
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
  cp -rp $PROJECT_ROOT/dev_env/webserver/httpd/httpd.vagrant.conf /etc/httpd/conf/httpd.conf
  cp -rp $PROJECT_ROOT/dev_env/webserver/vhosts/* /etc/httpd/conf.d/
  /usr/bin/systemctl enable httpd.service

  ## install php71
  # yum-config-manager --enable remi-php71
  # yum install -y --enablerepo=remi-php71 php-fpm php-mcrypt php-cli php-common php-devel php-gd php-mbstring php-mysqlnd php-opcache php-pdo php-pear php-pecl-apcu php-pecl-zip php-process php-xml
  yum install -y https://rpms.remirepo.net/enterprise/7/
  yum install -y --enablerepo=remi-php71,epel php php-devel php-common php-cli php-pdo php-mcrypt php-mbstring php-gd php-mysqlnd php-pear php-soap php-xml php-xmlrpc php-pecl-apc

  cp -p /etc/php.ini /etc/php.ini.bkup
  cp -p $PROJECT_ROOT/dev_env/webserver/php/php.vagrant.ini /etc/php.ini
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
  cp -p $PROJECT_ROOT/dev_env/mysql/my.cnf /etc/my.cnf
  chmod 644 /etc/my.cnf

  service mysqld restart

  ## exec sql
  export MYSQL_PWD=
  echo ${MYSQL_PWD}
  mysql -u root < $PROJECT_ROOT/dev_env/mysql/initialize.sql

  ## auto start
  /usr/bin/systemctl enable mysqld.service
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
  ## hosts
  echo '127.0.0.1 mysql' >> /etc/hosts

  ## log
  mkdir -p $LOG_DIR
  chmod -R 777 $LOG_DIR
  cd $PROJECT_ROOT && \
    /usr/local/bin/composer install && \
    php oil refine migrate
SCRIPT

$start = <<SCRIPT
  #/sbin/service httpd restart
  #/sbin/service mysqld restart
  sudo /usr/bin/systemctl start mysqld.service
  sudo /usr/bin/systemctl start httpd
  setenforce 0
SCRIPT
