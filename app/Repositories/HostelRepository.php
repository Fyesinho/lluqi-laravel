<?php

namespace App\Repositories;

use App\Models\Hostel;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HostelRepository
 * @package App\Repositories
 * @version October 20, 2018, 1:13 am UTC
 *
 * @method Hostel findWithoutFail($id, $columns = ['*'])
 * @method Hostel find($id, $columns = ['*'])
 * @method Hostel first($columns = ['*'])
*/
class HostelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name_hostel',
        'name_host',
        'city_id',
        'main_picture',
        'verified',
        'start_stay',
        'end_stay',
        'travelers_reciebed',
        'calification',
        'web',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Hostel::class;
    }
}
