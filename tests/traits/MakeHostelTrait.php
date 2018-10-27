<?php

use Faker\Factory as Faker;
use App\Models\Hostel;
use App\Repositories\HostelRepository;

trait MakeHostelTrait
{
    /**
     * Create fake instance of Hostel and save it in database
     *
     * @param array $hostelFields
     * @return Hostel
     */
    public function makeHostel($hostelFields = [])
    {
        /** @var HostelRepository $hostelRepo */
        $hostelRepo = App::make(HostelRepository::class);
        $theme = $this->fakeHostelData($hostelFields);
        return $hostelRepo->create($theme);
    }

    /**
     * Get fake instance of Hostel
     *
     * @param array $hostelFields
     * @return Hostel
     */
    public function fakeHostel($hostelFields = [])
    {
        return new Hostel($this->fakeHostelData($hostelFields));
    }

    /**
     * Get fake data of Hostel
     *
     * @param array $postFields
     * @return array
     */
    public function fakeHostelData($hostelFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name_hostel' => $fake->word,
            'name_host' => $fake->word,
            'city_id' => $fake->randomDigitNotNull,
            'main_picture' => $fake->word,
            'verified' => $fake->randomDigitNotNull,
            'start_stay' => $fake->randomDigitNotNull,
            'end_stay' => $fake->randomDigitNotNull,
            'travelers_reciebed' => $fake->randomDigitNotNull,
            'calification' => $fake->randomDigitNotNull,
            'web' => $fake->word,
            'description' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $hostelFields);
    }
}
