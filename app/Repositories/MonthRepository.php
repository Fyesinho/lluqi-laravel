<?php

namespace App\Repositories;

use App\Models\Month;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MonthRepository
 * @package App\Repositories
 * @version October 21, 2018, 8:58 pm UTC
 *
 * @method Month findWithoutFail($id, $columns = ['*'])
 * @method Month find($id, $columns = ['*'])
 * @method Month first($columns = ['*'])
*/
class MonthRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Month::class;
    }
}
