<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Accounts extends Migration{
	public function up(){
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 13,
				'unsigned' => true,
				'auto_increment' => true
			],
			'owner_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'null' => true,
			],
			'parent_id' => [
				'type' => 'INT',
				'constraint' => 13,
				'unsigned' => true,
				'null' => true,
			],
			'account_role_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true,
			],
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => 128
			],
			'firstname' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'null' => true,
			],
			'lastname' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'null' => true,
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => 512,
			],
			'profile' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'null' => true,
			],
			'thai_id' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'null' => true,
			],
			'last_ip' => [
				'type' => 'VARCHAR',
				'constraint' => 32,
				'null' => true,
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
		$this->forge->addForeignKey('owner_id', 'users', 'id', 'NO ACTION', 'SET NULL');
		$this->forge->addForeignKey('account_role_id', 'account_roles', 'id', 'NO ACTION', 'SET NULL');
		$this->forge->addUniqueKey('username');
		$this->forge->addUniqueKey('email');
		$this->forge->createTable('accounts', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down(){
		$this->forge->dropTable('accounts');
	}
}
