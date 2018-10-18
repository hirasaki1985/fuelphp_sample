<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			// 'dsn'        => 'mysql:host=localhost;dbname=fuel_dev;charset=utf8;unix_socket=/var/run/mysqld/mysqld.sock',
			'hostname' => 'localhost',
			'port'     => '3306',
			'database' => 'fuel_dev',
			'username'   => 'root',
			'password'   => '',
			'socket' => '/var/run/mysqld/mysqld.sock'
		),
		'profiling' => true,
	),
);
