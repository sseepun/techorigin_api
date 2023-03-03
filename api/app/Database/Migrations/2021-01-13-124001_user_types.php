<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTypes extends Migration{
	public function up(){
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'auto_increment' => true
			],
			'parent_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'null' => true
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 256
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
		$this->forge->createTable('user_types', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down(){
		$this->forge->dropTable('user_types');
	}
}
