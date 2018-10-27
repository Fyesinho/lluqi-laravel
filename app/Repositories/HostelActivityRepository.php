<?php

namespace App\Repositories;

use App\Models\HostelActivity;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HostelActivityRepository
 * @package App\Repositories
 * @version October 20, 2018, 2:58 pm UTC
 *
 * @method HostelActivity findWithoutFail($id, $columns = ['*'])
 * @method HostelActivity find($id, $columns = ['*'])
 * @method HostelActivity first($columns = ['*'])
*/
class HostelActivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hostel_id',
        'activity_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return HostelActivity::class;
    }
}
