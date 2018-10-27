<?php

use Faker\Factory as Faker;
use App\Models\HostelMonth;
use App\Repositories\HostelMonthRepository;

trait MakeHostelMonthTrait
{
    /**
     * Create fake instance of HostelMonth and save it in database
     *
     * @param array $hostelMonthFields
     * @return HostelMonth
     */
    public function makeHostelMonth($hostelMonthFields = [])
    {
        /** @var HostelMonthRepository $hostelMonthRepo */
        $hostelMonthRepo = App::make(HostelMonthRepository::class);
        $theme = $this->fakeHostelMonthData($hostelMonthFields);
        return $hostelMonthRepo->create($theme);
    }

    /**
     * Get fake instance of HostelMonth
     *
     * @param array $hostelMonthFields
     * @return HostelMonth
     */
    public function fakeHostelMonth($hostelMonthFields = [])
    {
        return new HostelMonth($this->fakeHostelMonthData($hostelMonthFields));
    }

    /**
     * Get fake data of HostelMonth
     *
     * @param array $postFields
     * @return array
     */
    public function fakeHostelMonthData($hostelMonthFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'hostel_id' => $fake->randomDigitNotNull,
            'month_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $hostelMonthFields);
    }
}
