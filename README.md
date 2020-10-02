# MOE Slip Codeigniter 4

## How to inslall

1. Change `app/Config/Database.php` to connect to your database.
2. Run `composer update` to install necessary packages.
3. Run `php spark migrate` to create database structures.
4. Run `php spark db:seed UserRoleSeeder` and `php spark db:seed UserSeeder` to populate initial data.
5. Change `env` to `.env`.
6. Run `php spark serve` to start you app in `http://localhost:8080/`.

## Initial accounts

Username: SuperAdmin<br />
Password: 123456<br /><br />

Username: Admin<br />
Password: 123456<br /><br />

Username: Member<br />
Password: 123456
