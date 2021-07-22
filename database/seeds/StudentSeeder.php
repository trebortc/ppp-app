<?php

use App\Administrative;
use App\Career;
use App\Faculty;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
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

        $student = Student::create([
            'career_id' => 1,
        ]);
        $userData = factory(User::class)->raw([
            'email'=>'estudiante@epn.edu.ec',
            'role' => User::ROLE_STUDENT
        ]);
        $student->user()->create($userData);

        foreach ($careers as $career) {
            $num_students = $faker->numberBetween(40, 50);
            for ($i = 0; $i < $num_students; $i++) {
                $student = Student::create([
                    'career_id' => $career->id,
                ]);
                $userData = factory(User::class)->raw([
                    'role' => User::ROLE_STUDENT
                ]);
                try {
                    $student->user()->create($userData);
                } catch (Exception $e) {
                    print_r('Email Duplicated');
                    $name = $userData["name"];
                    $lastname = $userData["lastname"];
                    $userData['email'] = strtolower("{$name}.{$lastname}01@epn.edu.ec");
                    $student->user()->create($userData);
                }
            }
        }
    }
}
