<?php

use Faker\Factory as Faker;
use App\Models\Month;
use App\Repositories\MonthRepository;

trait MakeMonthTrait
{
    /**
     * Create fake instance of Month and save it in database
     *
     * @param array $monthFields
     * @return Month
     */
    public function makeMonth($monthFields = [])
    {
        /** @var MonthRepository $monthRepo */
        $monthRepo = App::make(MonthRepository::class);
        $theme = $this->fakeMonthData($monthFields);
        return $monthRepo->create($theme);
    }

    /**
     * Get fake instance of Month
     *
     * @param array $monthFields
     * @return Month
     */
    public function fakeMonth($monthFields = [])
    {
        return new Month($this->fakeMonthData($monthFields));
    }

    /**
     * Get fake data of Month
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMonthData($monthFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $monthFields);
    }
}
