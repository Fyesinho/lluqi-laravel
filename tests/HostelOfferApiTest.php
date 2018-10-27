<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HostelOfferApiTest extends TestCase
{
    use MakeHostelOfferTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateHostelOffer()
    {
        $hostelOffer = $this->fakeHostelOfferData();
        $this->json('POST', '/api/v1/hostelOffers', $hostelOffer);

        $this->assertApiResponse($hostelOffer);
    }

    /**
     * @test
     */
    public function testReadHostelOffer()
    {
        $hostelOffer = $this->makeHostelOffer();
        $this->json('GET', '/api/v1/hostelOffers/'.$hostelOffer->id);

        $this->assertApiResponse($hostelOffer->toArray());
    }

    /**
     * @test
     */
    public function testUpdateHostelOffer()
    {
        $hostelOffer = $this->makeHostelOffer();
        $editedHostelOffer = $this->fakeHostelOfferData();

        $this->json('PUT', '/api/v1/hostelOffers/'.$hostelOffer->id, $editedHostelOffer);

        $this->assertApiResponse($editedHostelOffer);
    }

    /**
     * @test
     */
    public function testDeleteHostelOffer()
    {
        $hostelOffer = $this->makeHostelOffer();
        $this->json('DELETE', '/api/v1/hostelOffers/'.$hostelOffer->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/hostelOffers/'.$hostelOffer->id);

        $this->assertResponseStatus(404);
    }
}
