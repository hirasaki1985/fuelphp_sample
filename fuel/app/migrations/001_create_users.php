<?php

namespace Fuel\Migrations;

class Create_Users
{
  public function up()
  {
    \DBUtil::create_table('users', array(
      'id' => array('type' => 'int',
      'unsigned' => true,
      'null' => false,
      'auto_increment' => true,
      'constraint' => '11',
      'comment' => 'unique key'),
    'username' => array('type' => 'varchar',
      'constraint' => '50',
      'null' => false,
      'comment' => 'ユーザ名'),
    'password' => array('type' => 'varchar',
      'constraint' => '50',
      'null' => false,
      'comment' => 'パスワード'),
    'email' => array('type' => 'varchar',
      'constraint' => '255',
      'null' => false,
      'comment' => 'メールアドレス'),
    'last_login' => array('type' => 'timestamp',
      'null' => false,
      'comment' => '最終ログイン日時'),
    'login_hash' => array('type' => 'varchar',
      'constraint' => '255',
      'null' => false,
      'comment' => 'ログインに使用するハッシュ値'),
    'profile_fields' => array('type' => 'text',
      'null' => true,
      'comment' => 'プロフィール'),
    'created_at' => array('type' => 'timestamp', 'null' => true, 'default' => \DB::expr('CURRENT_TIMESTAMP')),
    'updated_at' => array('type' => 'timestamp', 'null' => true, 'default' => \DB::expr('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP')),
      ),
      array('id'),
      false,
      'InnoDB',
      'utf8mb4_general_ci'
    );

    \DBUtil::create_index('users', 'username', 'idx_users_username');
    \DBUtil::create_index('users', 'email', 'idx_users_email');
    \DBUtil::create_index('users', 'last_login', 'idx_users_last_login');
    \DBUtil::create_index('users', 'login_hash', 'idx_users_login_hash');
  }

  public function down()
  {
    \DBUtil::drop_table('users');
  }
}