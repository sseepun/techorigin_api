<?php namespace App\Database\Seeds;

class ModuleSeeder extends \CodeIgniter\Database\Seeder{
    public function run(){
        $this->db->table('modules')->insert([
            'name' => 'Content Management System',
            'order' => 0
        ]);
    }
}
