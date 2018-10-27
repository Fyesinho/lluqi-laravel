<?php

use Faker\Factory as Faker;
use App\Models\Offer;
use App\Repositories\OfferRepository;

trait MakeOfferTrait
{
    /**
     * Create fake instance of Offer and save it in database
     *
     * @param array $offerFields
     * @return Offer
     */
    public function makeOffer($offerFields = [])
    {
        /** @var OfferRepository $offerRepo */
        $offerRepo = App::make(OfferRepository::class);
        $theme = $this->fakeOfferData($offerFields);
        return $offerRepo->create($theme);
    }

    /**
     * Get fake instance of Offer
     *
     * @param array $offerFields
     * @return Offer
     */
    public function fakeOffer($offerFields = [])
    {
        return new Offer($this->fakeOfferData($offerFields));
    }

    /**
     * Get fake data of Offer
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOfferData($offerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'offer' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $offerFields);
    }
}
