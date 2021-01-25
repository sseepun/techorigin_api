<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserCustomDetails extends Migration{
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
			'column_1' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_2' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_3' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_4' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_5' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_6' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_7' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_8' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_9' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_10' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_11' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_12' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_13' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_14' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_15' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_16' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_17' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_18' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_19' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'column_20' => [
				'type' => 'VARCHAR',
				'constraint' => 256,
				'default' => null,
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('user_id', 'users', 'id', 'NO ACTION', 'CASCADE');
		$this->forge->addUniqueKey('user_id');
		$this->forge->createTable('user_custom_details', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down(){
		$this->forge->dropTable('user_custom_details');
	}
}
