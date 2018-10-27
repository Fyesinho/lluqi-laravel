<?php

use App\Models\HostelActivity;
use App\Repositories\HostelActivityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HostelActivityRepositoryTest extends TestCase
{
    use MakeHostelActivityTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HostelActivityRepository
     */
    protected $hostelActivityRepo;

    public function setUp()
    {
        parent::setUp();
        $this->hostelActivityRepo = App::make(HostelActivityRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateHostelActivity()
    {
        $hostelActivity = $this->fakeHostelActivityData();
        $createdHostelActivity = $this->hostelActivityRepo->create($hostelActivity);
        $createdHostelActivity = $createdHostelActivity->toArray();
        $this->assertArrayHasKey('id', $createdHostelActivity);
        $this->assertNotNull($createdHostelActivity['id'], 'Created HostelActivity must have id specified');
        $this->assertNotNull(HostelActivity::find($createdHostelActivity['id']), 'HostelActivity with given id must be in DB');
        $this->assertModelData($hostelActivity, $createdHostelActivity);
    }

    /**
     * @test read
     */
    public function testReadHostelActivity()
    {
        $hostelActivity = $this->makeHostelActivity();
        $dbHostelActivity = $this->hostelActivityRepo->find($hostelActivity->id);
        $dbHostelActivity = $dbHostelActivity->toArray();
        $this->assertModelData($hostelActivity->toArray(), $dbHostelActivity);
    }

    /**
     * @test update
     */
    public function testUpdateHostelActivity()
    {
        $hostelActivity = $this->makeHostelActivity();
        $fakeHostelActivity = $this->fakeHostelActivityData();
        $updatedHostelActivity = $this->hostelActivityRepo->update($fakeHostelActivity, $hostelActivity->id);
        $this->assertModelData($fakeHostelActivity, $updatedHostelActivity->toArray());
        $dbHostelActivity = $this->hostelActivityRepo->find($hostelActivity->id);
        $this->assertModelData($fakeHostelActivity, $dbHostelActivity->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteHostelActivity()
    {
        $hostelActivity = $this->makeHostelActivity();
        $resp = $this->hostelActivityRepo->delete($hostelActivity->id);
        $this->assertTrue($resp);
        $this->assertNull(HostelActivity::find($hostelActivity->id), 'HostelActivity should not exist in DB');
    }
}
