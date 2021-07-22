<?php

use App\Administrative;
use App\Career;
use App\Faculty;
use App\Teacher;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();
        $careers = Career::all();

        $teacher = Teacher::create([
            'career_id' => 1,
            'degree' => $faker->jobTitle,
        ]);

        $teacher->user()->create(factory(User::class)->raw([
            'email' => 'profesor@epn.edu.ec',
            'role' => User::ROLE_TEACHER
        ]));

        $commission = Teacher::create([
            'career_id' => 1,
            'degree' => $faker->jobTitle,
        ]);

        $commissionUser = $commission->user()->create(factory(User::class)->raw([
            'email' => 'comision@epn.edu.ec'
        ]));

        // necessary because boot y user assigns role according to userable_type,
        // so commission role can be assigned only when editing
        $commissionUser->role = User::ROLE_COMMISSION;
        $commissionUser->save();

        foreach ($careers as $career) {
            $num_teachers = $faker->numberBetween(5, 8);

            for ($i = 0; $i < $num_teachers; $i++) {
                $teacher = Teacher::create([
                    'career_id' => $career->id,
                    'degree' => $faker->jobTitle
                ]);

                $teacher->user()->create(factory(User::class)->raw([
                    'role' => User::ROLE_TEACHER
                ]));
            }
        }
    }
}
