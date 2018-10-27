<?php

namespace App\Repositories;

use App\Models\Traveler;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TravelerRepository
 * @package App\Repositories
 * @version October 9, 2018, 1:55 am UTC
 *
 * @method Traveler findWithoutFail($id, $columns = ['*'])
 * @method Traveler find($id, $columns = ['*'])
 * @method Traveler first($columns = ['*'])
*/
class TravelerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'name',
        'gender',
        'birthday',
        'password',
        'phone',
        'country_id',
        'city',
        'language_id',
        'language_id',
        'language2_id',
        'language3_id',
        'language4_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Traveler::class;
    }
}
