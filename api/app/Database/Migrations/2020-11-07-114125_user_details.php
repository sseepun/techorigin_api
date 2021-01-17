<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserDetails extends Migration{
	public function up(){
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true
			],
			'user_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'null' => true,
			],
			'user_type_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true,
			],
			'user_subtype_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true,
			],
			'address' => [
				'type' => 'VARCHAR',
				'constraint' => 512,
				'default' => null,
			],
			'phone' => [
				'type' => 'VARCHAR',
				'constraint' => 64,
				'default' => null,
			],
			'title' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'company' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'company_address' => [
				'type' => 'VARCHAR',
				'constraint' => 512,
				'default' => null,
			],
			'company_phone' => [
				'type' => 'VARCHAR',
				'constraint' => 64,
				'default' => null,
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('user_id', 'users', 'id', 'NO ACTION', 'CASCADE');
		$this->forge->addForeignKey('user_type_id', 'user_types', 'id', 'NO ACTION', 'SET NULL');
		$this->forge->addForeignKey('user_subtype_id', 'user_types', 'id', 'NO ACTION', 'SET NULL');
		$this->forge->addUniqueKey('user_id');
		$this->forge->createTable('user_details', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down(){
		$this->forge->dropTable('user_details');
	}
}
