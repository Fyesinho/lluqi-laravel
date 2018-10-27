<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HostelActivityApiTest extends TestCase
{
    use MakeHostelActivityTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateHostelActivity()
    {
        $hostelActivity = $this->fakeHostelActivityData();
        $this->json('POST', '/api/v1/hostelActivities', $hostelActivity);

        $this->assertApiResponse($hostelActivity);
    }

    /**
     * @test
     */
    public function testReadHostelActivity()
    {
        $hostelActivity = $this->makeHostelActivity();
        $this->json('GET', '/api/v1/hostelActivities/'.$hostelActivity->id);

        $this->assertApiResponse($hostelActivity->toArray());
    }

    /**
     * @test
     */
    public function testUpdateHostelActivity()
    {
        $hostelActivity = $this->makeHostelActivity();
        $editedHostelActivity = $this->fakeHostelActivityData();

        $this->json('PUT', '/api/v1/hostelActivities/'.$hostelActivity->id, $editedHostelActivity);

        $this->assertApiResponse($editedHostelActivity);
    }

    /**
     * @test
     */
    public function testDeleteHostelActivity()
    {
        $hostelActivity = $this->makeHostelActivity();
        $this->json('DELETE', '/api/v1/hostelActivities/'.$hostelActivity->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/hostelActivities/'.$hostelActivity->id);

        $this->assertResponseStatus(404);
    }
}
