<?php

use Faker\Factory as Faker;
use App\Models\NeedActivity;
use App\Repositories\NeedActivityRepository;

trait MakeNeedActivityTrait
{
    /**
     * Create fake instance of NeedActivity and save it in database
     *
     * @param array $needActivityFields
     * @return NeedActivity
     */
    public function makeNeedActivity($needActivityFields = [])
    {
        /** @var NeedActivityRepository $needActivityRepo */
        $needActivityRepo = App::make(NeedActivityRepository::class);
        $theme = $this->fakeNeedActivityData($needActivityFields);
        return $needActivityRepo->create($theme);
    }

    /**
     * Get fake instance of NeedActivity
     *
     * @param array $needActivityFields
     * @return NeedActivity
     */
    public function fakeNeedActivity($needActivityFields = [])
    {
        return new NeedActivity($this->fakeNeedActivityData($needActivityFields));
    }

    /**
     * Get fake data of NeedActivity
     *
     * @param array $postFields
     * @return array
     */
    public function fakeNeedActivityData($needActivityFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'activity' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $needActivityFields);
    }
}
