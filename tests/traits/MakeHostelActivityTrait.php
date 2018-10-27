<?php

use Faker\Factory as Faker;
use App\Models\HostelActivity;
use App\Repositories\HostelActivityRepository;

trait MakeHostelActivityTrait
{
    /**
     * Create fake instance of HostelActivity and save it in database
     *
     * @param array $hostelActivityFields
     * @return HostelActivity
     */
    public function makeHostelActivity($hostelActivityFields = [])
    {
        /** @var HostelActivityRepository $hostelActivityRepo */
        $hostelActivityRepo = App::make(HostelActivityRepository::class);
        $theme = $this->fakeHostelActivityData($hostelActivityFields);
        return $hostelActivityRepo->create($theme);
    }

    /**
     * Get fake instance of HostelActivity
     *
     * @param array $hostelActivityFields
     * @return HostelActivity
     */
    public function fakeHostelActivity($hostelActivityFields = [])
    {
        return new HostelActivity($this->fakeHostelActivityData($hostelActivityFields));
    }

    /**
     * Get fake data of HostelActivity
     *
     * @param array $postFields
     * @return array
     */
    public function fakeHostelActivityData($hostelActivityFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'hostel_id' => $fake->randomDigitNotNull,
            'activity_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $hostelActivityFields);
    }
}
