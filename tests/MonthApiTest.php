<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MonthApiTest extends TestCase
{
    use MakeMonthTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMonth()
    {
        $month = $this->fakeMonthData();
        $this->json('POST', '/api/v1/months', $month);

        $this->assertApiResponse($month);
    }

    /**
     * @test
     */
    public function testReadMonth()
    {
        $month = $this->makeMonth();
        $this->json('GET', '/api/v1/months/'.$month->id);

        $this->assertApiResponse($month->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMonth()
    {
        $month = $this->makeMonth();
        $editedMonth = $this->fakeMonthData();

        $this->json('PUT', '/api/v1/months/'.$month->id, $editedMonth);

        $this->assertApiResponse($editedMonth);
    }

    /**
     * @test
     */
    public function testDeleteMonth()
    {
        $month = $this->makeMonth();
        $this->json('DELETE', '/api/v1/months/'.$month->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/months/'.$month->id);

        $this->assertResponseStatus(404);
    }
}
