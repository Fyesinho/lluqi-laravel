<?php

use Faker\Factory as Faker;
use App\Models\Prueba;
use App\Repositories\PruebaRepository;

trait MakePruebaTrait
{
    /**
     * Create fake instance of Prueba and save it in database
     *
     * @param array $pruebaFields
     * @return Prueba
     */
    public function makePrueba($pruebaFields = [])
    {
        /** @var PruebaRepository $pruebaRepo */
        $pruebaRepo = App::make(PruebaRepository::class);
        $theme = $this->fakePruebaData($pruebaFields);
        return $pruebaRepo->create($theme);
    }

    /**
     * Get fake instance of Prueba
     *
     * @param array $pruebaFields
     * @return Prueba
     */
    public function fakePrueba($pruebaFields = [])
    {
        return new Prueba($this->fakePruebaData($pruebaFields));
    }

    /**
     * Get fake data of Prueba
     *
     * @param array $postFields
     * @return array
     */
    public function fakePruebaData($pruebaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'edad' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $pruebaFields);
    }
}
