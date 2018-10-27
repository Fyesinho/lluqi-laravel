<?php

use App\Models\NeedActivity;
use App\Repositories\NeedActivityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NeedActivityRepositoryTest extends TestCase
{
    use MakeNeedActivityTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var NeedActivityRepository
     */
    protected $needActivityRepo;

    public function setUp()
    {
        parent::setUp();
        $this->needActivityRepo = App::make(NeedActivityRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateNeedActivity()
    {
        $needActivity = $this->fakeNeedActivityData();
        $createdNeedActivity = $this->needActivityRepo->create($needActivity);
        $createdNeedActivity = $createdNeedActivity->toArray();
        $this->assertArrayHasKey('id', $createdNeedActivity);
        $this->assertNotNull($createdNeedActivity['id'], 'Created NeedActivity must have id specified');
        $this->assertNotNull(NeedActivity::find($createdNeedActivity['id']), 'NeedActivity with given id must be in DB');
        $this->assertModelData($needActivity, $createdNeedActivity);
    }

    /**
     * @test read
     */
    public function testReadNeedActivity()
    {
        $needActivity = $this->makeNeedActivity();
        $dbNeedActivity = $this->needActivityRepo->find($needActivity->id);
        $dbNeedActivity = $dbNeedActivity->toArray();
        $this->assertModelData($needActivity->toArray(), $dbNeedActivity);
    }

    /**
     * @test update
     */
    public function testUpdateNeedActivity()
    {
        $needActivity = $this->makeNeedActivity();
        $fakeNeedActivity = $this->fakeNeedActivityData();
        $updatedNeedActivity = $this->needActivityRepo->update($fakeNeedActivity, $needActivity->id);
        $this->assertModelData($fakeNeedActivity, $updatedNeedActivity->toArray());
        $dbNeedActivity = $this->needActivityRepo->find($needActivity->id);
        $this->assertModelData($fakeNeedActivity, $dbNeedActivity->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteNeedActivity()
    {
        $needActivity = $this->makeNeedActivity();
        $resp = $this->needActivityRepo->delete($needActivity->id);
        $this->assertTrue($resp);
        $this->assertNull(NeedActivity::find($needActivity->id), 'NeedActivity should not exist in DB');
    }
}
