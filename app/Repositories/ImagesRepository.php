<?php

namespace App\Repositories;

use App\Models\Images;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ImagesRepository
 * @package App\Repositories
 * @version October 21, 2018, 8:39 pm UTC
 *
 * @method Images findWithoutFail($id, $columns = ['*'])
 * @method Images find($id, $columns = ['*'])
 * @method Images first($columns = ['*'])
*/
class ImagesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'url',
        'hostel_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Images::class;
    }
}
