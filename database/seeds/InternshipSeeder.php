<?php

use App\Internship;
use App\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class InternshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Internship::class, 200)->create()
        ->each(function ($internship) {
            $faker = \Faker\Factory::create();


            if(!in_array($internship->status, ['pending', 'rejected'])) {
                $internship->followups()->saveMany(factory(\App\Followup::class, $faker->numberBetween(0, 10))->make()
                ->each(function($followup) use ($faker, $internship) {
                    $followup->user_type = $faker->randomElement(['student', 'teacher', 'representative']);

                    if($followup->user_type === 'student') {
                        $followup->user_id = $internship->student_id;
                    } elseif ($followup->user_type === 'teacher') {
                        $followup->user_id = $internship->teacher_id;
                    } else {
                        $followup->user_id = $internship->representative_id;
                    }
                }));
            }

            if(in_array($internship->status, ['representative_pending', 'tutor_pending', 'commission_pending', 'approved', 'registered'])) {
                $internship->activities()->saveMany(factory(\App\InternshipActivity::class, $faker->numberBetween(3, 5))->make());

                $careerSubjects = $internship->student->career->subjects;
                $careerTopics = null;
                foreach ($careerSubjects as $subject) {
                    if ($careerTopics) {
                        $careerTopics->merge($subject->topics);
                    } else {
                        $careerTopics = $subject->topics;
                    }
                }
                $usefulTopics = $faker->randomElements($careerTopics, $faker->numberBetween(3, 8), false);
                $internship->usefulTopics()->saveMany($usefulTopics);
                $internship->recommendedTopics()->saveMany(factory(\App\RecommendedTopic::class, $faker->numberBetween(1, 6))->make());
            }
        });
    }
}
