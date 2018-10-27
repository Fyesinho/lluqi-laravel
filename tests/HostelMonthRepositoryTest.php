<?php

use App\Models\HostelMonth;
use App\Repositories\HostelMonthRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HostelMonthRepositoryTest extends TestCase
{
    use MakeHostelMonthTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HostelMonthRepository
     */
    protected $hostelMonthRepo;

    public function setUp()
    {
        parent::setUp();
        $this->hostelMonthRepo = App::make(HostelMonthRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateHostelMonth()
    {
        $hostelMonth = $this->fakeHostelMonthData();
        $createdHostelMonth = $this->hostelMonthRepo->create($hostelMonth);
        $createdHostelMonth = $createdHostelMonth->toArray();
        $this->assertArrayHasKey('id', $createdHostelMonth);
        $this->assertNotNull($createdHostelMonth['id'], 'Created HostelMonth must have id specified');
        $this->assertNotNull(HostelMonth::find($createdHostelMonth['id']), 'HostelMonth with given id must be in DB');
        $this->assertModelData($hostelMonth, $createdHostelMonth);
    }

    /**
     * @test read
     */
    public function testReadHostelMonth()
    {
        $hostelMonth = $this->makeHostelMonth();
        $dbHostelMonth = $this->hostelMonthRepo->find($hostelMonth->id);
        $dbHostelMonth = $dbHostelMonth->toArray();
        $this->assertModelData($hostelMonth->toArray(), $dbHostelMonth);
    }

    /**
     * @test update
     */
    public function testUpdateHostelMonth()
    {
        $hostelMonth = $this->makeHostelMonth();
        $fakeHostelMonth = $this->fakeHostelMonthData();
        $updatedHostelMonth = $this->hostelMonthRepo->update($fakeHostelMonth, $hostelMonth->id);
        $this->assertModelData($fakeHostelMonth, $updatedHostelMonth->toArray());
        $dbHostelMonth = $this->hostelMonthRepo->find($hostelMonth->id);
        $this->assertModelData($fakeHostelMonth, $dbHostelMonth->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteHostelMonth()
    {
        $hostelMonth = $this->makeHostelMonth();
        $resp = $this->hostelMonthRepo->delete($hostelMonth->id);
        $this->assertTrue($resp);
        $this->assertNull(HostelMonth::find($hostelMonth->id), 'HostelMonth should not exist in DB');
    }
}
