<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserCustomColumns extends Migration{
	public function up(){
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 4,
				'unsigned' => true,
				'auto_increment' => true
			],
			'column_id' => [
				'type' => 'INT',
				'constraint' => 2
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
		$this->forge->addUniqueKey('name');
		$this->forge->createTable('user_custom_columns', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down(){
		$this->forge->dropTable('user_custom_columns');
	}
}
