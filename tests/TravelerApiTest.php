<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TravelerApiTest extends TestCase
{
    use MakeTravelerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTraveler()
    {
        $traveler = $this->fakeTravelerData();
        $this->json('POST', '/api/v1/travelers', $traveler);

        $this->assertApiResponse($traveler);
    }

    /**
     * @test
     */
    public function testReadTraveler()
    {
        $traveler = $this->makeTraveler();
        $this->json('GET', '/api/v1/travelers/'.$traveler->id);

        $this->assertApiResponse($traveler->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTraveler()
    {
        $traveler = $this->makeTraveler();
        $editedTraveler = $this->fakeTravelerData();

        $this->json('PUT', '/api/v1/travelers/'.$traveler->id, $editedTraveler);

        $this->assertApiResponse($editedTraveler);
    }

    /**
     * @test
     */
    public function testDeleteTraveler()
    {
        $traveler = $this->makeTraveler();
        $this->json('DELETE', '/api/v1/travelers/'.$traveler->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/travelers/'.$traveler->id);

        $this->assertResponseStatus(404);
    }
}
