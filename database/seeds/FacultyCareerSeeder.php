<?php

use App\Career;
use App\Faculty;
use App\Subject;
use Illuminate\Database\Seeder;

class FacultyCareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Faculty::class, 1)->create()
            ->each(function ($faculty) {
                $faculty->careers()->saveMany(factory(App\Career::class, 8)->make());
            });
    }
}
