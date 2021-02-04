<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExternalApps extends Migration{
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
				'constraint' => 128,
			],
			'description' => [
				'type' => 'VARCHAR',
				'constraint' => 512,
				'null' => true,
			],
			'url' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
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
		$this->forge->addUniqueKey('name');
		$this->forge->createTable('external_apps', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down(){
		$this->forge->dropTable('external_apps');
	}
}
