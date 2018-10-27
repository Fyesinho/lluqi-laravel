<?php

namespace App\Repositories;

use App\Models\Offer;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class OfferRepository
 * @package App\Repositories
 * @version October 19, 2018, 1:34 am UTC
 *
 * @method Offer findWithoutFail($id, $columns = ['*'])
 * @method Offer find($id, $columns = ['*'])
 * @method Offer first($columns = ['*'])
*/
class OfferRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'offer'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Offer::class;
    }
}
