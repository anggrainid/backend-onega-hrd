<?php

namespace Database\Seeders;

use App\Models\Presence;
use App\Models\User;
use Carbon\Carbon;
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
        $user = User::create([
            "id_company" => "FE-123",
            "name" => "Andi",
            "email"=> "andi@gmail.com",
            "password"=> bcrypt("12345678"),
            "role" => "Karyawan",
            "nik" => "3216065408020009",
            "npwp"=> "9958239909",
            "started"=>Carbon::parse('2000-01-01'),
            "finished"=> Carbon::parse('2022-01-01'),
        ]);

        $presence = Presence::create([

            "id_user" => $user->id,
            "check_in" => Carbon::parse('15:29:12'),
            "check_out" => Carbon::parse('15:29:12'),
            "date" =>Carbon::parse('2000-01-01'),
            // "status"=>
            "attend" => true
        ]);

    }
}
