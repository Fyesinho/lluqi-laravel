<?php

use App\Models\Month;
use App\Repositories\MonthRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MonthRepositoryTest extends TestCase
{
    use MakeMonthTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MonthRepository
     */
    protected $monthRepo;

    public function setUp()
    {
        parent::setUp();
        $this->monthRepo = App::make(MonthRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMonth()
    {
        $month = $this->fakeMonthData();
        $createdMonth = $this->monthRepo->create($month);
        $createdMonth = $createdMonth->toArray();
        $this->assertArrayHasKey('id', $createdMonth);
        $this->assertNotNull($createdMonth['id'], 'Created Month must have id specified');
        $this->assertNotNull(Month::find($createdMonth['id']), 'Month with given id must be in DB');
        $this->assertModelData($month, $createdMonth);
    }

    /**
     * @test read
     */
    public function testReadMonth()
    {
        $month = $this->makeMonth();
        $dbMonth = $this->monthRepo->find($month->id);
        $dbMonth = $dbMonth->toArray();
        $this->assertModelData($month->toArray(), $dbMonth);
    }

    /**
     * @test update
     */
    public function testUpdateMonth()
    {
        $month = $this->makeMonth();
        $fakeMonth = $this->fakeMonthData();
        $updatedMonth = $this->monthRepo->update($fakeMonth, $month->id);
        $this->assertModelData($fakeMonth, $updatedMonth->toArray());
        $dbMonth = $this->monthRepo->find($month->id);
        $this->assertModelData($fakeMonth, $dbMonth->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMonth()
    {
        $month = $this->makeMonth();
        $resp = $this->monthRepo->delete($month->id);
        $this->assertTrue($resp);
        $this->assertNull(Month::find($month->id), 'Month should not exist in DB');
    }
}
