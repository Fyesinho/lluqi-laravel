<?php

use Faker\Factory as Faker;
use App\Models\HostelOffer;
use App\Repositories\HostelOfferRepository;

trait MakeHostelOfferTrait
{
    /**
     * Create fake instance of HostelOffer and save it in database
     *
     * @param array $hostelOfferFields
     * @return HostelOffer
     */
    public function makeHostelOffer($hostelOfferFields = [])
    {
        /** @var HostelOfferRepository $hostelOfferRepo */
        $hostelOfferRepo = App::make(HostelOfferRepository::class);
        $theme = $this->fakeHostelOfferData($hostelOfferFields);
        return $hostelOfferRepo->create($theme);
    }

    /**
     * Get fake instance of HostelOffer
     *
     * @param array $hostelOfferFields
     * @return HostelOffer
     */
    public function fakeHostelOffer($hostelOfferFields = [])
    {
        return new HostelOffer($this->fakeHostelOfferData($hostelOfferFields));
    }

    /**
     * Get fake data of HostelOffer
     *
     * @param array $postFields
     * @return array
     */
    public function fakeHostelOfferData($hostelOfferFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'hostel_id' => $fake->randomDigitNotNull,
            'offer_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $hostelOfferFields);
    }
}
