<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use JWTAuth;
use App\Student;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can retrieve students from data base with a correct role.
     *
     * @return void
     */
    public function testViewStudentsWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/students/';
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
    public function testViewStudentWithIdWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/students/1';
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
    public function testCreateStudentWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/students/';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $student = array(
            'career_id' => '3',
            'name' => 'Luis Raul',
            'lastname' => 'Tarez Perez',
            'email' => 'tarez11.perez22@epn.edu.ec',
            'phone' => '022625072',
            'mobile' => '0969305524',
            'sex' => 'male',
        );

        $this->json('POST', $baseUrl, $student, $headers)
            ->assertStatus(201);
    }

    /**
     * Can update a student from data base with a correct role.
     *
     * @return void
     */
    public function testUpdateStudentWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/students/361';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $student = array(
            'career_id' => 3,
            'name' => 'Luis Raul modificado',
            'lastname' => 'Tarez Perez modificado',
            'phone' => '022625072',
            'mobile' => '0969305524',
            'sex' => 'male',
        );
        $this->json('PUT', $baseUrl, $student, $headers)
            ->assertStatus(200);
    }

    /**
     * Can retrieve students from data base with a correct role.
     *
     * @return void
     */
    public function testDeleteStudentWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/students/361/disabled';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('PUT', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

}
