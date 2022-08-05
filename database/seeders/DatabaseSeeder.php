<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Presence;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(10)->create();

        $employee = Employee::create([

            "id_company" => "FE-121",
            "name" => "Andi",
            "role" => "Karyawan",
            "nik" => "3216065408020009",
            "npwp"=> "9958239909",
            "started"=> 2022-04-27,
            "finished"=> 2022-04-27,

        ]);

        $presence = Presence::create([

            "id_employee" => $employee->id,
            //"check_in" =>
            // "check_out" =>
            // "date" =>
            // "status"=>
            // "attend" =>
        ]);

        User::create([
            "name"=> "Admin",
            "email"=> "admin@gmail.com",
            "password"=> bcrypt("12345678"),
        ]);
    }
}
