<?php

namespace Tests\Feature;

use App\Career;
use App\Faculty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use JWTAuth;
use Illuminate\Support\Facades\DB;

class CareerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can retrieve careers from data base with a correct role.
     *
     * @return void
     */
    public function testViewCareersWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/careers/';
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
    public function testViewCareerWithIdWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/careers/1';
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
    public function testCreateCareerWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/careers/';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $faculty = factory(Faculty::class, 1)->create()
            ->each(function ($faculty) {
                $faculty->careers()->saveMany(factory(Career::class, 1)->make());
            });

        $career = Career::where('faculty_id',$faculty->first()->id)->orderBy('id', 'desc')->first();
        $career->name = $career->name.' test';
        $this->json('POST', $baseUrl, $career->toArray(), $headers)
            ->assertStatus(201);
    }

    /**
     * Can update a career from data base with a correct role.
     *
     * @return void
     */
    public function testUpdateCareerWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/careers/8';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $faculty = factory(Faculty::class, 1)->create()
            ->each(function ($faculty) {
                $faculty->careers()->saveMany(factory(Career::class, 1)->make());
            });

        $career = Career::where('faculty_id',$faculty->first()->id)->orderBy('id', 'desc')->first();
        $career->name = $career->name.' modificado';
        $this->json('PUT', $baseUrl, $career->toArray(), $headers)
            ->assertStatus(200);
    }

    /**
     * Can retrieve careers from data base with a correct role.
     *
     * @return void
     */
    public function testDeleteCareerWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/careers/1/disabled';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('PUT', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

}
