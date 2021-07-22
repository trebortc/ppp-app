<?php

namespace Tests\Feature;

use App\Career;
use App\Faculty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use JWTAuth;

class FacultyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can retrieve Facultys from data base with a correct role.
     *
     * @return void
     */
    public function testViewFacultysWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/faculties/';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

    /**
     * Can retrieve a Faculty from data base with a correct role.
     *
     * @return void
     */
    public function testViewFacultyWithIdWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/faculties/1';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

    /**
     * Can create a Faculty in the data base with a correct role.
     *
     * @return void
     */
    public function testCreateFacultyWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/faculties/';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $faculty = factory(Faculty::class, 1)->create()
            ->each(function ($faculty) {
                $faculty->careers()->saveMany(factory(Career::class, 1)->make());
            });

        $faculty = $faculty->first();
        $faculty->name = $faculty->name.'modificado';
        $faculty->id = $faculty->id+1;
        $this->json('POST', $baseUrl, $faculty->toArray(), $headers)
            ->assertStatus(201);
    }



    /**
     * Can retrieve Facultys from data base with a correct role.
     *
     * @return void
     */
    public function testDeleteFacultyWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/faculties/1/disabled';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('PUT', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

}
