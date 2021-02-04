<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ActionLogs extends Migration{
	public function up(){
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 13,
				'unsigned' => true,
				'auto_increment' => true
			],
			'external_app_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true,
			],
			'user_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => true,
				'null' => true,
			],
			'target_user_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => true,
			],
			'action' => [
				'type' => 'VARCHAR',
				'constraint' => 32,
			],
			'url' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'null' => true,
			],
			'ip' => [
				'type' => 'VARCHAR',
				'constraint' => 32,
				'null' => true,
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('external_app_id', 'external_apps', 'id', 'NO ACTION', 'SET NULL');
		$this->forge->addForeignKey('user_id', 'users', 'id', 'NO ACTION', 'CASCADE');
		$this->forge->createTable('action_logs', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down(){
		$this->forge->dropTable('action_logs');
	}
}
