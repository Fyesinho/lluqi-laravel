<?php

use App\Models\HostelOffer;
use App\Repositories\HostelOfferRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HostelOfferRepositoryTest extends TestCase
{
    use MakeHostelOfferTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HostelOfferRepository
     */
    protected $hostelOfferRepo;

    public function setUp()
    {
        parent::setUp();
        $this->hostelOfferRepo = App::make(HostelOfferRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateHostelOffer()
    {
        $hostelOffer = $this->fakeHostelOfferData();
        $createdHostelOffer = $this->hostelOfferRepo->create($hostelOffer);
        $createdHostelOffer = $createdHostelOffer->toArray();
        $this->assertArrayHasKey('id', $createdHostelOffer);
        $this->assertNotNull($createdHostelOffer['id'], 'Created HostelOffer must have id specified');
        $this->assertNotNull(HostelOffer::find($createdHostelOffer['id']), 'HostelOffer with given id must be in DB');
        $this->assertModelData($hostelOffer, $createdHostelOffer);
    }

    /**
     * @test read
     */
    public function testReadHostelOffer()
    {
        $hostelOffer = $this->makeHostelOffer();
        $dbHostelOffer = $this->hostelOfferRepo->find($hostelOffer->id);
        $dbHostelOffer = $dbHostelOffer->toArray();
        $this->assertModelData($hostelOffer->toArray(), $dbHostelOffer);
    }

    /**
     * @test update
     */
    public function testUpdateHostelOffer()
    {
        $hostelOffer = $this->makeHostelOffer();
        $fakeHostelOffer = $this->fakeHostelOfferData();
        $updatedHostelOffer = $this->hostelOfferRepo->update($fakeHostelOffer, $hostelOffer->id);
        $this->assertModelData($fakeHostelOffer, $updatedHostelOffer->toArray());
        $dbHostelOffer = $this->hostelOfferRepo->find($hostelOffer->id);
        $this->assertModelData($fakeHostelOffer, $dbHostelOffer->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteHostelOffer()
    {
        $hostelOffer = $this->makeHostelOffer();
        $resp = $this->hostelOfferRepo->delete($hostelOffer->id);
        $this->assertTrue($resp);
        $this->assertNull(HostelOffer::find($hostelOffer->id), 'HostelOffer should not exist in DB');
    }
}
