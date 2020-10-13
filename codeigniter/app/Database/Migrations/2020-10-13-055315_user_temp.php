<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTemp extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 13,
				'unsigned' => true,
				'auto_increment' => true
			],
			'user_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'null' => true,
			],
			'action' => [
				'type' => 'VARCHAR',
				'constraint' => 128
			],
			'salt' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
			],
			'is_used' => [
				'type' => 'INT',
				'constraint' => 1,
				'default' => 0
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('user_id', 'users', 'id', 'NO ACTION', 'CASCADE');
		$this->forge->addUniqueKey('salt');
		$this->forge->createTable('user_temp', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('user_temp');
	}
}
