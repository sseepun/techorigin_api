<?php namespace App\Database\Seeds;

class UserRoleSeeder extends \CodeIgniter\Database\Seeder{
    public function run(){
        $this->db->table('user_roles')->insert([
            'name' => 'Super Admin',
            'is_super_admin' => 1,
            'is_default' => 0,
            'order' => 99,
        ]);
        $this->db->table('user_roles')->insert([
            'name' => 'Admin',
            'is_admin' => 1,
            'is_default' => 0,
            'order' => 98,
        ]);
        $this->db->table('user_roles')->insert([
            'name' => 'Member',
            'is_default' => 1,
            'order' => 0,
        ]);
        $this->db->table('user_roles')->insert([
            'name' => 'Employee',
            'is_default' => 0,
            'order' => 1,
        ]);
        $this->db->table('user_roles')->insert([
            'name' => 'HR',
            'is_default' => 0,
            'order' => 2,
        ]);
    }
}
