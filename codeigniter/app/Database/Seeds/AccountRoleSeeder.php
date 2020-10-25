<?php namespace App\Database\Seeds;

class AccountRoleSeeder extends \CodeIgniter\Database\Seeder{
    public function run(){
        $this->db->table('account_roles')->insert([
            'name' => 'Partner',
            'access_code' => 0,
            'is_default' => 0,
            'order' => 0,
        ]);
        $this->db->table('account_roles')->insert([
            'name' => 'Sales',
            'access_code' => 1,
            'is_default' => 0,
            'order' => 1,
        ]);
        $this->db->table('account_roles')->insert([
            'name' => 'User',
            'access_code' => 2,
            'is_default' => 1,
            'order' => 2,
        ]);
    }
}
