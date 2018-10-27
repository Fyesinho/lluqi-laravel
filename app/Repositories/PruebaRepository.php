<?php

namespace App\Repositories;

use App\Models\Prueba;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PruebaRepository
 * @package App\Repositories
 * @version October 9, 2018, 1:28 am UTC
 *
 * @method Prueba findWithoutFail($id, $columns = ['*'])
 * @method Prueba find($id, $columns = ['*'])
 * @method Prueba first($columns = ['*'])
*/
class PruebaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'edad'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Prueba::class;
    }
}
