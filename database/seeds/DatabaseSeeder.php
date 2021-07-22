<?php

use App\Administrative;
use App\Career;
use App\Company;
use App\Faculty;
use App\Internship;
//use App\InternshipReport;
use App\InternshipActivity;
use App\RecommendedTopic;
use App\Representative;
use App\Student;
use App\Subject;
use App\Teacher;
use App\Topic;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Faculty::truncate();
        Career::truncate();
        DB::table('career_subject')->truncate();
        Subject::truncate();
        Topic::truncate();
        Administrative::truncate();
        Teacher::truncate();
        Student::truncate();
        User::truncate();
        Representative::truncate();
        Company::truncate();
        Internship::truncate();
        InternshipActivity::truncate();
        RecommendedTopic::truncate();
        DB::table('internship_topic')->truncate();


        $this->call(FacultyCareerSeeder::class);
        $this->call(SubjectTopicSeeder::class);
        $this->call(AdministrativeSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(InternshipSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
