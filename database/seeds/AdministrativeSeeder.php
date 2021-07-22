<?php

use App\Administrative;
use App\Faculty;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministrativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculties = Faculty::all();

        $administrative = Administrative::create([
            'faculty_id' => 1
        ]);

        $administrative->user()->create(factory(User::class)->raw([
            'email' => 'administrativo@epn.edu.ec',
            'role' => User::ROLE_ADMINISTRATIVE
        ]));

        foreach ($faculties as $faculty) {
            for ($i = 0; $i < 2; $i++) {
                $administrative = Administrative::create([
                    'faculty_id' => $faculty->id
                ]);

                $administrative->user()->create(factory(User::class)->raw([
                    'role' => User::ROLE_ADMINISTRATIVE
                ]));

            }
        }
    }
}
