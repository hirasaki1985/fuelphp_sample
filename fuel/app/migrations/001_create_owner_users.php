<?php

namespace Fuel\Migrations;

class Create_form
{
	public function up()
	{
		\DBUtil::create_table('owner_users', array(
				'id' => array('type' => 'int',
					'unsigned' => true,
					'null' => false,
					'auto_increment' => true,
					'constraint' => '11'),
				'username' => array('type' => 'string',
					'constraint' => '50',
					'null' => false),
				'created_at' => array('type' => 'timestamp',
					'constraint' => '11', 'null' => true),
				'updated_at' => array('type' => 'timestamp',
					'constraint' => '11', 'null' => true),
			),
			array('id'),
			false,
			'InnoDB',
			'utf8_unicode_ci'
		);
	}

	public function down()
	{
		\DBUtil::drop_table('owner_users');
	}
}