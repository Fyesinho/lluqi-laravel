<?php

use App\Models\Traveler;
use App\Repositories\TravelerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TravelerRepositoryTest extends TestCase
{
    use MakeTravelerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TravelerRepository
     */
    protected $travelerRepo;

    public function setUp()
    {
        parent::setUp();
        $this->travelerRepo = App::make(TravelerRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTraveler()
    {
        $traveler = $this->fakeTravelerData();
        $createdTraveler = $this->travelerRepo->create($traveler);
        $createdTraveler = $createdTraveler->toArray();
        $this->assertArrayHasKey('id', $createdTraveler);
        $this->assertNotNull($createdTraveler['id'], 'Created Traveler must have id specified');
        $this->assertNotNull(Traveler::find($createdTraveler['id']), 'Traveler with given id must be in DB');
        $this->assertModelData($traveler, $createdTraveler);
    }

    /**
     * @test read
     */
    public function testReadTraveler()
    {
        $traveler = $this->makeTraveler();
        $dbTraveler = $this->travelerRepo->find($traveler->id);
        $dbTraveler = $dbTraveler->toArray();
        $this->assertModelData($traveler->toArray(), $dbTraveler);
    }

    /**
     * @test update
     */
    public function testUpdateTraveler()
    {
        $traveler = $this->makeTraveler();
        $fakeTraveler = $this->fakeTravelerData();
        $updatedTraveler = $this->travelerRepo->update($fakeTraveler, $traveler->id);
        $this->assertModelData($fakeTraveler, $updatedTraveler->toArray());
        $dbTraveler = $this->travelerRepo->find($traveler->id);
        $this->assertModelData($fakeTraveler, $dbTraveler->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTraveler()
    {
        $traveler = $this->makeTraveler();
        $resp = $this->travelerRepo->delete($traveler->id);
        $this->assertTrue($resp);
        $this->assertNull(Traveler::find($traveler->id), 'Traveler should not exist in DB');
    }
}
