<?php

namespace App\Repositories;

use App\Models\NeedActivity;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class NeedActivityRepository
 * @package App\Repositories
 * @version October 19, 2018, 1:17 am UTC
 *
 * @method NeedActivity findWithoutFail($id, $columns = ['*'])
 * @method NeedActivity find($id, $columns = ['*'])
 * @method NeedActivity first($columns = ['*'])
*/
class NeedActivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'activity'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return NeedActivity::class;
    }
}
