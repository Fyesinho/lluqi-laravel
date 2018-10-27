<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PruebaApiTest extends TestCase
{
    use MakePruebaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePrueba()
    {
        $prueba = $this->fakePruebaData();
        $this->json('POST', '/api/v1/pruebas', $prueba);

        $this->assertApiResponse($prueba);
    }

    /**
     * @test
     */
    public function testReadPrueba()
    {
        $prueba = $this->makePrueba();
        $this->json('GET', '/api/v1/pruebas/'.$prueba->id);

        $this->assertApiResponse($prueba->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePrueba()
    {
        $prueba = $this->makePrueba();
        $editedPrueba = $this->fakePruebaData();

        $this->json('PUT', '/api/v1/pruebas/'.$prueba->id, $editedPrueba);

        $this->assertApiResponse($editedPrueba);
    }

    /**
     * @test
     */
    public function testDeletePrueba()
    {
        $prueba = $this->makePrueba();
        $this->json('DELETE', '/api/v1/pruebas/'.$prueba->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/pruebas/'.$prueba->id);

        $this->assertResponseStatus(404);
    }
}
