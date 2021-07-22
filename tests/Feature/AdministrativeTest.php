<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use JWTAuth;
use App\Administrative;

class AdministrativeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can retrieve administratives from data base with a correct role.
     *
     * @return void
     */
    public function testViewAdministrativesWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/administratives/';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

    /**
     * Can retrieve a administrative from data base with a correct role.
     *
     * @return void
     */
    public function testViewAdministrativeWithIdWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/administratives/1';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

    /**
     * Can create a administrative in the data base with a correct role.
     *
     * @return void
     */
    public function testCreateAdministrativeWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/administratives/';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $administrative = array(
            'faculty_id' => '1',
            'name' => 'Administrativo',
            'lastname' => 'Administrativo',
            'email' => 'administrativo11@epn.edu.ec',
            'phone' => '022625072',
            'mobile' => '0969305524',
            'sex' => 'male',
        );

        $this->json('POST', $baseUrl, $administrative, $headers)
            ->assertStatus(201);
    }

    /**
     * Can update a administrative from data base with a correct role.
     *
     * @return void
     */
    public function testUpdateAdministrativeWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/administratives/1';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $administrative = array(
            'faculty_id' => '1',
            'name' => 'Administrativo modificado',
            'lastname' => 'Administrativo modificado',
            'phone' => '022625072',
            'mobile' => '0969305524',
            'sex' => 'male',
        );
        $this->json('PUT', $baseUrl, $administrative, $headers)
            ->assertStatus(200);
    }

    /**
     * Can retrieve administratives from data base with a correct role.
     *
     * @return void
     */
    public function testDeleteAdministrativeWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/administratives/1/disabled';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('PUT', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

}
