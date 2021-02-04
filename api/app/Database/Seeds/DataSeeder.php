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


        // User Types
        $this->db->table('user_types')->insert([ 'name' => 'นักเรียนระดับประถมต้น' ]);
        $parentId = $this->db->insertID();
        $this->db->table('user_types')->insert([
            'parent_id' => $parentId, 'name' => 'ประถมศึกษาปีที่ 1'
        ]);
        $this->db->table('user_types')->insert([
            'parent_id' => $parentId, 'name' => 'ประถมศึกษาปีที่ 2'
        ]);
        $this->db->table('user_types')->insert([
            'parent_id' => $parentId, 'name' => 'ประถมศึกษาปีที่ 3'
        ]);

        $this->db->table('user_types')->insert([ 'name' => 'นักเรียนระดับประถมปลาย' ]);
        $parentId = $this->db->insertID();
        $this->db->table('user_types')->insert([
            'parent_id' => $parentId, 'name' => 'ประถมศึกษาปีที่ 4'
        ]);
        $this->db->table('user_types')->insert([
            'parent_id' => $parentId, 'name' => 'ประถมศึกษาปีที่ 5'
        ]);
        $this->db->table('user_types')->insert([
            'parent_id' => $parentId, 'name' => 'ประถมศึกษาปีที่ 6'
        ]);

        $this->db->table('user_types')->insert([ 'name' => 'นักเรียนระดับมัธยมต้น' ]);
        $parentId = $this->db->insertID();
        $this->db->table('user_types')->insert([
            'parent_id' => $parentId, 'name' => 'มัธยมศึกษาปีที่ 1'
        ]);
        $this->db->table('user_types')->insert([
            'parent_id' => $parentId, 'name' => 'มัธยมศึกษาปีที่ 2'
        ]);
        $this->db->table('user_types')->insert([
            'parent_id' => $parentId, 'name' => 'มัธยมศึกษาปีที่ 3'
        ]);

        $this->db->table('user_types')->insert([ 'name' => 'นักเรียนระดับมัธยมปลาย' ]);
        $parentId = $this->db->insertID();
        $this->db->table('user_types')->insert([
            'parent_id' => $parentId, 'name' => 'มัธยมศึกษาปีที่ 4'
        ]);
        $this->db->table('user_types')->insert([
            'parent_id' => $parentId, 'name' => 'มัธยมศึกษาปีที่ 5'
        ]);
        $this->db->table('user_types')->insert([
            'parent_id' => $parentId, 'name' => 'มัธยมศึกษาปีที่ 6'
        ]);

        $this->db->table('user_types')->insert([ 'name' => 'นักเรียนระดับปริญญาตรี' ]);
        $this->db->table('user_types')->insert([ 'name' => 'นักเรียนระดับปริญญาโท' ]);
        $this->db->table('user_types')->insert([ 'name' => 'นักเรียนระดับปริญญาเอก' ]);
        $this->db->table('user_types')->insert([ 'name' => 'คุณครู' ]);
        $this->db->table('user_types')->insert([ 'name' => 'อาจารย์มหาวิทยาลัย' ]);


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


        // External Apps
        $this->db->table('external_apps')->insert([
            'name' => 'Student Application',
        ]);
        
    }
}
