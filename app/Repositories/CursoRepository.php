<?php

namespace App\Repositories;

use App\Models\Curso;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CursoRepository
 * @package App\Repositories
 * @version July 3, 2018, 12:27 pm UTC
 *
 * @method Curso findWithoutFail($id, $columns = ['*'])
 * @method Curso find($id, $columns = ['*'])
 * @method Curso first($columns = ['*'])
*/
class CursoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Curso::class;
    }
}
