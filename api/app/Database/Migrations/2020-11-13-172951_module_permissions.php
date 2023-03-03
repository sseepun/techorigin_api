<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModulePermissions extends Migration{
	public function up(){
		$this->db->disableForeignKeyChecks();

		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => true,
				'auto_increment' => true
			],
			'module_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true,
			],
			'role_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'null' => true,
			],
			'create' => [
				'type' => 'INT',
				'constraint' => 1,
				'default' => 0
			],
			'read' => [
				'type' => 'INT',
				'constraint' => 1,
				'default' => 0
			],
			'update' => [
				'type' => 'INT',
				'constraint' => 1,
				'default' => 0
			],
			'delete' => [
				'type' => 'INT',
				'constraint' => 1,
				'default' => 0
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('module_id', 'modules', 'id', 'NO ACTION', 'CASCADE');
		$this->forge->addForeignKey('role_id', 'user_roles', 'id', 'NO ACTION', 'CASCADE');
		$this->forge->createTable('module_permissions', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down(){
		$this->forge->dropTable('module_permissions');
	}
}

