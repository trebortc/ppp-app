<?php

namespace Tests\Feature;

use Tests\TestCase;
use JWTAuth;

class InternshipTest extends TestCase
{
    /**
     * Cannot retrieve internships from db without a token.
     *
     * @return void
     */
    public function testCannotViewAnyInternshipsWithoutToken()
    {
        $this->json('GET', '/api/internships', [], [])
            ->assertStatus(401);
    }

    /**
     * Cannot retrieve internships from db with a incorrect role
     *
     * @return void
     */
    public function testCannotViewAnyInternshipsWithIncorrectRole()
    {
        $token = JWTAuth::attempt(['email' => 'profesor@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('GET', '/api/internships', [], $headers)
            ->assertStatus(403);
    }

    /**
     * Can retrieve internships from db with a correct role.
     *
     * @return void
     */
    public function testCanViewAnyInternshipsWithCorrectRole()
    {
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('GET', '/api/internships', [], $headers)
            ->assertStatus(200);
    }

    /**
     * Can retrieve internships from db with a correct role.
     *
     * @return void
     */
    public function testCanViewInternship()
    {
        $token = JWTAuth::attempt(['email' => 'administrativo@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('GET', '/api/internships/1', [], $headers)
            ->assertStatus(200);


        $token = JWTAuth::attempt(['email' => 'profesor@epn.edu.ec', 'password' => '123123']);
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('GET', '/api/internships/1', [], $headers)
            ->assertStatus(403);

    }
}
