<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Prueba
 * @package App\Models
 * @version October 9, 2018, 1:28 am UTC
 *
 * @property string nombre
 * @property integer edad
 */
class Prueba extends Model
{
    use SoftDeletes;

    public $table = 'pruebas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'edad'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'edad' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
