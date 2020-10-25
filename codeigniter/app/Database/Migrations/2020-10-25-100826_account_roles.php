<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AccountRoles extends Migration{
	public function up(){
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'auto_increment' => true
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 256
			],
			'access_code' => [
				'type' => 'INT',
				'constraint' => 2,
				'default' => 0
			],
			'is_default' => [
				'type' => 'INT',
				'constraint' => 1,
				'default' => 0
			],
			'order' => [
				'type' => 'INT',
				'constraint' => 2,
				'default' => 0
			],
			'status' => [
				'type' => 'INT',
				'constraint' => 1,
				'default' => 1
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addUniqueKey('name');
		$this->forge->createTable('account_roles', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down(){
		$this->forge->dropTable('account_roles');
	}
}
