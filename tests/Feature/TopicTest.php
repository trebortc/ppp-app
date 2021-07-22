<?php

namespace Tests\Feature;

use App\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use JWTAuth;

class TopicTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Can retrieve careers from data base with a correct role.
     *
     * @return void
     */
    public function testViewTopicsWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/topics/';
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
    public function testViewTopicWithIdWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/topics/1';
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
    public function testCreateTopicWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/topics/';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $topic = factory(Topic::class, 1)->make()->first();
        $topic->subject_id = 1;

        $this->json('POST', $baseUrl, $topic->toArray(), $headers)
            ->assertStatus(201);
    }

    /**
     * Can update a career from data base with a correct role.
     *
     * @return void
     */
    public function testUpdateTopicWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/topics/8';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $topic = factory(Topic::class, 1)->make()->first();
        $topic->name = $topic->name.' modificado';
        $topic->subject_id = 1;

        $this->json('PUT', $baseUrl, $topic->toArray(), $headers)
            ->assertStatus(200);
    }

    /**
     * Can retrieve careers from data base with a correct role.
     *
     * @return void
     */
    public function testDeleteTopicWithCorrectRole()
    {
        $this->withoutExceptionHandling();

        $baseUrl =  env('APP_URL').'/api/topics/1/disabled';
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('PUT', $baseUrl, [], $headers)
            ->assertStatus(200);
    }

}
