<?php

use App\Models\Prueba;
use App\Repositories\PruebaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PruebaRepositoryTest extends TestCase
{
    use MakePruebaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PruebaRepository
     */
    protected $pruebaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->pruebaRepo = App::make(PruebaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePrueba()
    {
        $prueba = $this->fakePruebaData();
        $createdPrueba = $this->pruebaRepo->create($prueba);
        $createdPrueba = $createdPrueba->toArray();
        $this->assertArrayHasKey('id', $createdPrueba);
        $this->assertNotNull($createdPrueba['id'], 'Created Prueba must have id specified');
        $this->assertNotNull(Prueba::find($createdPrueba['id']), 'Prueba with given id must be in DB');
        $this->assertModelData($prueba, $createdPrueba);
    }

    /**
     * @test read
     */
    public function testReadPrueba()
    {
        $prueba = $this->makePrueba();
        $dbPrueba = $this->pruebaRepo->find($prueba->id);
        $dbPrueba = $dbPrueba->toArray();
        $this->assertModelData($prueba->toArray(), $dbPrueba);
    }

    /**
     * @test update
     */
    public function testUpdatePrueba()
    {
        $prueba = $this->makePrueba();
        $fakePrueba = $this->fakePruebaData();
        $updatedPrueba = $this->pruebaRepo->update($fakePrueba, $prueba->id);
        $this->assertModelData($fakePrueba, $updatedPrueba->toArray());
        $dbPrueba = $this->pruebaRepo->find($prueba->id);
        $this->assertModelData($fakePrueba, $dbPrueba->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePrueba()
    {
        $prueba = $this->makePrueba();
        $resp = $this->pruebaRepo->delete($prueba->id);
        $this->assertTrue($resp);
        $this->assertNull(Prueba::find($prueba->id), 'Prueba should not exist in DB');
    }
}
