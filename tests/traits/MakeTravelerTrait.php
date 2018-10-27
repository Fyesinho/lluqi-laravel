<?php

use Faker\Factory as Faker;
use App\Models\Traveler;
use App\Repositories\TravelerRepository;

trait MakeTravelerTrait
{
    /**
     * Create fake instance of Traveler and save it in database
     *
     * @param array $travelerFields
     * @return Traveler
     */
    public function makeTraveler($travelerFields = [])
    {
        /** @var TravelerRepository $travelerRepo */
        $travelerRepo = App::make(TravelerRepository::class);
        $theme = $this->fakeTravelerData($travelerFields);
        return $travelerRepo->create($theme);
    }

    /**
     * Get fake instance of Traveler
     *
     * @param array $travelerFields
     * @return Traveler
     */
    public function fakeTraveler($travelerFields = [])
    {
        return new Traveler($this->fakeTravelerData($travelerFields));
    }

    /**
     * Get fake data of Traveler
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTravelerData($travelerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'email' => $fake->word,
            'name' => $fake->word,
            'gender' => $fake->word,
            'birthday' => $fake->randomDigitNotNull,
            'password' => $fake->word,
            'phone' => $fake->randomDigitNotNull,
            'country_id' => $fake->randomDigitNotNull,
            'city' => $fake->word,
            'language_id' => $fake->randomDigitNotNull,
            'language_id' => $fake->randomDigitNotNull,
            'language2_id' => $fake->randomDigitNotNull,
            'language3_id' => $fake->randomDigitNotNull,
            'language4_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $travelerFields);
    }
}
