<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Slips extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 15,
				'unsigned' => true,
				'auto_increment' => true
			],
			'slip_import_id' => [
				'type' => 'INT',
				'constraint' => 13,
				'unsigned' => true,
				'null' => true,
			],

			'slip_id' => [
				'type' => 'VARCHAR',
				'constraint' => 32
			],
			'year' => [
				'type' => 'INT',
				'constraint' => 4,
			],
			'month' => [
				'type' => 'INT',
				'constraint' => 2,
			],
			'prefix' => [
				'type' => 'VARCHAR',
				'constraint' => 32,
				'null' => true,
			],
			'firstname' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
			],
			'lastname' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
			],
			'psn_id' => [
				'type' => 'VARCHAR',
				'constraint' => 32,
			],
			'bank_id' => [
				'type' => 'VARCHAR',
				'constraint' => 32,
			],
			
			'credit_1' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_1' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_2' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_2' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_3' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_3' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_4' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_4' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_5' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_5' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_6' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_6' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_7' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_7' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_8' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_8' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_9' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_9' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_10' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_10' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_11' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_11' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_12' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_12' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_13' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_13' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_14' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_14' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'credit_15' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'credit_amount_15' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			
			'debit_1' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_1' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_2' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_2' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_3' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_3' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_4' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_4' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_5' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_5' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_6' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_6' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_7' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_7' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_8' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_8' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_9' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_9' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_10' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_10' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_11' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_11' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_12' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_12' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_13' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_13' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_14' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_14' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'debit_15' => [ 'type' => 'VARCHAR', 'constraint' => 128, 'null' => true, ],
			'debit_amount_15' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			
			'income' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'payment' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],
			'amount' => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true, ],

			'status' => [
				'type' => 'INT',
				'constraint' => 1,
				'default' => 1
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('slip_import_id', 'slip_imports', 'id', 'NO ACTION', 'SET NULL');
		$this->forge->addUniqueKey('slip_id');
		$this->forge->createTable('slips', true);
		
        $this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('slips');
	}
}
