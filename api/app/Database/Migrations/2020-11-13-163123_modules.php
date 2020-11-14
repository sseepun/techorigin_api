<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Modules extends Migration{
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
			'code' => [
				'type' => 'VARCHAR',
				'constraint' => 64
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
		$this->forge->addUniqueKey('code');
		$this->forge->createTable('modules', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down(){
		$this->forge->dropTable('modules');
	}
}
