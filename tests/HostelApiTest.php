<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HostelApiTest extends TestCase
{
    use MakeHostelTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateHostel()
    {
        $hostel = $this->fakeHostelData();
        $this->json('POST', '/api/v1/hostels', $hostel);

        $this->assertApiResponse($hostel);
    }

    /**
     * @test
     */
    public function testReadHostel()
    {
        $hostel = $this->makeHostel();
        $this->json('GET', '/api/v1/hostels/'.$hostel->id);

        $this->assertApiResponse($hostel->toArray());
    }

    /**
     * @test
     */
    public function testUpdateHostel()
    {
        $hostel = $this->makeHostel();
        $editedHostel = $this->fakeHostelData();

        $this->json('PUT', '/api/v1/hostels/'.$hostel->id, $editedHostel);

        $this->assertApiResponse($editedHostel);
    }

    /**
     * @test
     */
    public function testDeleteHostel()
    {
        $hostel = $this->makeHostel();
        $this->json('DELETE', '/api/v1/hostels/'.$hostel->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/hostels/'.$hostel->id);

        $this->assertResponseStatus(404);
    }
}
