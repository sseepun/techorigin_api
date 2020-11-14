<?php namespace App\Database\Seeds;

class DataSeeder extends \CodeIgniter\Database\Seeder{
    public function run(){

        // User Roles
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

        // Users
        $this->db->table('users')->insert([
            'role_id' => 1,
            'username' => 'SuperAdmin',
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'email' => 'sarun.seepun@gmail.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'status' => 1
        ]);
        $this->db->table('users')->insert([
            'role_id' => 2,
            'username' => 'Admin',
            'firstname' => 'General',
            'lastname' => 'Admin',
            'email' => 'sarun_sla@hotmail.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'status' => 1
        ]);
        $this->db->table('users')->insert([
            'role_id' => 3,
            'username' => 'Member',
            'firstname' => 'General',
            'lastname' => 'Member',
            'email' => 'a@a.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'status' => 1
        ]);

        // Modules
        $this->db->table('modules')->insert([
            'name' => 'Content Management System',
            'code' => 'cms',
            'order' => 0
        ]);
        
    }
}
