<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HostelMonthApiTest extends TestCase
{
    use MakeHostelMonthTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateHostelMonth()
    {
        $hostelMonth = $this->fakeHostelMonthData();
        $this->json('POST', '/api/v1/hostelMonths', $hostelMonth);

        $this->assertApiResponse($hostelMonth);
    }

    /**
     * @test
     */
    public function testReadHostelMonth()
    {
        $hostelMonth = $this->makeHostelMonth();
        $this->json('GET', '/api/v1/hostelMonths/'.$hostelMonth->id);

        $this->assertApiResponse($hostelMonth->toArray());
    }

    /**
     * @test
     */
    public function testUpdateHostelMonth()
    {
        $hostelMonth = $this->makeHostelMonth();
        $editedHostelMonth = $this->fakeHostelMonthData();

        $this->json('PUT', '/api/v1/hostelMonths/'.$hostelMonth->id, $editedHostelMonth);

        $this->assertApiResponse($editedHostelMonth);
    }

    /**
     * @test
     */
    public function testDeleteHostelMonth()
    {
        $hostelMonth = $this->makeHostelMonth();
        $this->json('DELETE', '/api/v1/hostelMonths/'.$hostelMonth->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/hostelMonths/'.$hostelMonth->id);

        $this->assertResponseStatus(404);
    }
}
