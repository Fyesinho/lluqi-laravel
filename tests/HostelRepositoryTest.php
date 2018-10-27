<?php

use App\Models\Hostel;
use App\Repositories\HostelRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HostelRepositoryTest extends TestCase
{
    use MakeHostelTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HostelRepository
     */
    protected $hostelRepo;

    public function setUp()
    {
        parent::setUp();
        $this->hostelRepo = App::make(HostelRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateHostel()
    {
        $hostel = $this->fakeHostelData();
        $createdHostel = $this->hostelRepo->create($hostel);
        $createdHostel = $createdHostel->toArray();
        $this->assertArrayHasKey('id', $createdHostel);
        $this->assertNotNull($createdHostel['id'], 'Created Hostel must have id specified');
        $this->assertNotNull(Hostel::find($createdHostel['id']), 'Hostel with given id must be in DB');
        $this->assertModelData($hostel, $createdHostel);
    }

    /**
     * @test read
     */
    public function testReadHostel()
    {
        $hostel = $this->makeHostel();
        $dbHostel = $this->hostelRepo->find($hostel->id);
        $dbHostel = $dbHostel->toArray();
        $this->assertModelData($hostel->toArray(), $dbHostel);
    }

    /**
     * @test update
     */
    public function testUpdateHostel()
    {
        $hostel = $this->makeHostel();
        $fakeHostel = $this->fakeHostelData();
        $updatedHostel = $this->hostelRepo->update($fakeHostel, $hostel->id);
        $this->assertModelData($fakeHostel, $updatedHostel->toArray());
        $dbHostel = $this->hostelRepo->find($hostel->id);
        $this->assertModelData($fakeHostel, $dbHostel->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteHostel()
    {
        $hostel = $this->makeHostel();
        $resp = $this->hostelRepo->delete($hostel->id);
        $this->assertTrue($resp);
        $this->assertNull(Hostel::find($hostel->id), 'Hostel should not exist in DB');
    }
}
