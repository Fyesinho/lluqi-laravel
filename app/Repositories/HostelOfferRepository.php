<?php

namespace App\Repositories;

use App\Models\HostelOffer;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HostelOfferRepository
 * @package App\Repositories
 * @version October 20, 2018, 6:47 pm UTC
 *
 * @method HostelOffer findWithoutFail($id, $columns = ['*'])
 * @method HostelOffer find($id, $columns = ['*'])
 * @method HostelOffer first($columns = ['*'])
*/
class HostelOfferRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hostel_id',
        'offer_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return HostelOffer::class;
    }
}
