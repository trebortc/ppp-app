<?php

use App\Career;
use App\Subject;
use App\Topic;
use Illuminate\Database\Seeder;

class SubjectTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $careers = Career::all();

        $careers->each(function ($career) {
            $career->subjects()->saveMany(factory(Subject::class, 30)->make())
                ->each(function ($subject) {
                    $subject->topics()->saveMany(factory(Topic::class, 10)->make());
                });
        });


    }
}
