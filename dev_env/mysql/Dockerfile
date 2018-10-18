FROM mysql:5.7.10

RUN cp -p /etc/mysql/my.cnf /etc/mysql/my.cnf.bkup
COPY initialize.sql /docker-entrypoint-initdb.d/initialize.sql
COPY my.cnf /etc/mysql/my.cnf
# RUN mysql -u root -psecret < /tmp/initialize.sql

