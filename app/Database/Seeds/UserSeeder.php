<?php namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
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
    }
}
