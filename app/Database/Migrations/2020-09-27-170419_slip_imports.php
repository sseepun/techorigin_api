<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SlipImports extends Migration
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
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 256
			],
			'files' => [
				'type' => 'VARCHAR',
				'constraint' => 2048,
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
		$this->forge->addForeignKey('user_id', 'users', 'id', 'NO ACTION', 'SET NULL');
		$this->forge->createTable('slip_imports', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('slip_imports');
	}
}
