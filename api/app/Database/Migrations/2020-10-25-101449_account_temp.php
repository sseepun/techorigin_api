<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AccountTemp extends Migration{
	public function up(){
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 13,
				'unsigned' => true,
				'auto_increment' => true
			],
			'account_id' => [
				'type' => 'INT',
				'constraint' => 13,
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
			'ip' => [
				'type' => 'VARCHAR',
				'constraint' => 32,
				'null' => true,
			],
			'used_ip' => [
				'type' => 'VARCHAR',
				'constraint' => 32,
				'null' => true,
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('account_id', 'accounts', 'id', 'NO ACTION', 'CASCADE');
		$this->forge->addUniqueKey('salt');
		$this->forge->createTable('account_temp', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down(){
		$this->forge->dropTable('account_temp');
	}
}
