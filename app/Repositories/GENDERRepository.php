<?php

namespace App\Repositories;

use App\Models\Gender;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class GenderRepository
 * @package App\Repositories
 * @version October 23, 2018, 1:49 am UTC
 *
 * @method Gender findWithoutFail($id, $columns = ['*'])
 * @method Gender find($id, $columns = ['*'])
 * @method Gender first($columns = ['*'])
*/
class GenderRepository extends BaseRepository
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
        return Gender::class;
    }
}
