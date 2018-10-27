<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GenderApiTest extends TestCase
{
    use MakeGenderTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateGender()
    {
        $gender = $this->fakeGenderData();
        $this->json('POST', '/api/v1/genders', $gender);

        $this->assertApiResponse($gender);
    }

    /**
     * @test
     */
    public function testReadGender()
    {
        $gender = $this->makeGender();
        $this->json('GET', '/api/v1/genders/'.$gender->id);

        $this->assertApiResponse($gender->toArray());
    }

    /**
     * @test
     */
    public function testUpdateGender()
    {
        $gender = $this->makeGender();
        $editedGender = $this->fakeGenderData();

        $this->json('PUT', '/api/v1/genders/'.$gender->id, $editedGender);

        $this->assertApiResponse($editedGender);
    }

    /**
     * @test
     */
    public function testDeleteGender()
    {
        $gender = $this->makeGender();
        $this->json('DELETE', '/api/v1/genders/'.$gender->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/genders/'.$gender->id);

        $this->assertResponseStatus(404);
    }
}
