<?php

use Faker\Factory as Faker;
use App\Models\Gender;
use App\Repositories\GenderRepository;

trait MakeGenderTrait
{
    /**
     * Create fake instance of Gender and save it in database
     *
     * @param array $genderFields
     * @return Gender
     */
    public function makeGender($genderFields = [])
    {
        /** @var GenderRepository $genderRepo */
        $genderRepo = App::make(GenderRepository::class);
        $theme = $this->fakeGenderData($genderFields);
        return $genderRepo->create($theme);
    }

    /**
     * Get fake instance of Gender
     *
     * @param array $genderFields
     * @return Gender
     */
    public function fakeGender($genderFields = [])
    {
        return new Gender($this->fakeGenderData($genderFields));
    }

    /**
     * Get fake data of Gender
     *
     * @param array $postFields
     * @return array
     */
    public function fakeGenderData($genderFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $genderFields);
    }
}
