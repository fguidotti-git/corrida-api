<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Equipe
 * @package App\Models
 * @version July 3, 2018, 12:34 pm UTC
 *
 * @property string nome
 * @property file imagem
 */
class Equipe extends Model
{
    use SoftDeletes;

    public $table = 'equipes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nome',
        'imagem'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nome' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'required',
        'imagem' => 'required'
    ];

    
}
