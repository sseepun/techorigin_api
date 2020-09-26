<?php namespace App\Database\Seeds;

class UserRoleSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $this->db->table('user_roles')->insert([
            'name' => 'Super Admin',
            'is_admin' => 1,
            'is_super_admin' => 1,
            'is_default' => 0,
            'rank' => 99,
        ]);
        $this->db->table('user_roles')->insert([
            'name' => 'Admin',
            'is_admin' => 1,
            'is_super_admin' => 0,
            'is_default' => 0,
            'rank' => 98,
        ]);
        $this->db->table('user_roles')->insert([
            'name' => 'Member',
            'is_default' => 1,
            'rank' => 0,
        ]);
        $this->db->table('user_roles')->insert([
            'name' => 'Sales',
            'is_default' => 0,
            'rank' => 1,
        ]);
        $this->db->table('user_roles')->insert([
            'name' => 'Employee',
            'is_default' => 0,
            'rank' => 2,
        ]);
        $this->db->table('user_roles')->insert([
            'name' => 'HR',
            'is_default' => 0,
            'rank' => 3,
        ]);
        $this->db->table('user_roles')->insert([
            'name' => 'Partner',
            'is_default' => 0,
            'rank' => 4,
        ]);
    }
}
