<?php

namespace App\Repositories;

use App\Models\HostelMonth;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HostelMonthRepository
 * @package App\Repositories
 * @version October 21, 2018, 9:01 pm UTC
 *
 * @method HostelMonth findWithoutFail($id, $columns = ['*'])
 * @method HostelMonth find($id, $columns = ['*'])
 * @method HostelMonth first($columns = ['*'])
*/
class HostelMonthRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hostel_id',
        'month_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return HostelMonth::class;
    }
}
