<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Teacher;
use JWTAuth;

class TeacherTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can retrieve students from data base with a correct role.
     *
     * @return void
     */
    public function testViewTeachersWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/teachers/';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

    /**
     * Can retrieve a student from data base with a correct role.
     *
     * @return void
     */
    public function testViewTeacherWithIdWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/teachers/10';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

    /**
     * Can create a student in the data base with a correct role.
     *
     * @return void
     */
    public function testCreateTeacherWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/teachers/';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $teacher = array(
            'career_id' => '3',
            'degree' => 'Ingeniero en Desarrollo Web',
            'name' => 'Andres Vicente',
            'lastname' => 'Suarez Tello',
            'email' => 'andres.vicente@epn.edu.ec',
            'phone' => '022625072',
            'mobile' => '0969305524',
            'sex' => 'male',
        );

        $this->json('POST', $baseUrl, $teacher, $headers)
            ->assertStatus(201);
    }

    /**
     * Can update a student from data base with a correct role.
     *
     * @return void
     */
    public function testUpdateTeacherWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/teachers/10';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $teacher = array(
            'career_id' => 3,
            'degree' => 'Ingeniero en Sistemas',
            'name' => 'Pedro Javier',
            'lastname' => 'Suarez Collaguazo',
            'phone' => '022625072',
            'mobile' => '0969305524',
            'sex' => 'male',
        );
        $this->json('PUT', $baseUrl, $teacher, $headers)
            ->assertStatus(200);
    }

    /**
     * Can retrieve students from data base with a correct role.
     *
     * @return void
     */
    public function testDeleteTeacherWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/teachers/10/disabled';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('PUT', $baseUrl, [], $headers)
            ->assertStatus(200);
    }
}
