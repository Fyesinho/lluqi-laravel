<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NeedActivityApiTest extends TestCase
{
    use MakeNeedActivityTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateNeedActivity()
    {
        $needActivity = $this->fakeNeedActivityData();
        $this->json('POST', '/api/v1/needActivities', $needActivity);

        $this->assertApiResponse($needActivity);
    }

    /**
     * @test
     */
    public function testReadNeedActivity()
    {
        $needActivity = $this->makeNeedActivity();
        $this->json('GET', '/api/v1/needActivities/'.$needActivity->id);

        $this->assertApiResponse($needActivity->toArray());
    }

    /**
     * @test
     */
    public function testUpdateNeedActivity()
    {
        $needActivity = $this->makeNeedActivity();
        $editedNeedActivity = $this->fakeNeedActivityData();

        $this->json('PUT', '/api/v1/needActivities/'.$needActivity->id, $editedNeedActivity);

        $this->assertApiResponse($editedNeedActivity);
    }

    /**
     * @test
     */
    public function testDeleteNeedActivity()
    {
        $needActivity = $this->makeNeedActivity();
        $this->json('DELETE', '/api/v1/needActivities/'.$needActivity->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/needActivities/'.$needActivity->id);

        $this->assertResponseStatus(404);
    }
}
