<?php

namespace Tests\Feature;

use App\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use JWTAuth;

class SubjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can retrieve careers from data base with a correct role.
     *
     * @return void
     */
    public function testViewSubjectsWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/subjects/';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

    /**
     * Can retrieve a career from data base with a correct role.
     *
     * @return void
     */
    public function testViewSubjectWithIdWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/subjects/1';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

    /**
     * Can create a career in the data base with a correct role.
     *
     * @return void
     */
    public function testCreateSubjectWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/subjects/';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $subject = factory(Subject::class, 1)->make()->first();
        $this->json('POST', $baseUrl, $subject->toArray(), $headers)
            ->assertStatus(201);
    }

    /**
     * Can update a career from data base with a correct role.
     *
     * @return void
     */
    public function testUpdateSubjectWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/subjects/1';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $subject = Subject::find(1);
        $subject->name = $subject->name.' modificado';
        $this->json('PUT', $baseUrl, $subject->toArray(), $headers)
            ->assertStatus(200);
    }

    /**
     * Can retrieve careers from data base with a correct role.
     *
     * @return void
     */
    public function testDeleteSubjectWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/subjects/1/disabled';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('PUT', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

}
