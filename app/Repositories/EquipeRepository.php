<?php

namespace App\Repositories;

use App\Models\Equipe;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EquipeRepository
 * @package App\Repositories
 * @version July 3, 2018, 12:34 pm UTC
 *
 * @method Equipe findWithoutFail($id, $columns = ['*'])
 * @method Equipe find($id, $columns = ['*'])
 * @method Equipe first($columns = ['*'])
*/
class EquipeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'imagem'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Equipe::class;
    }
}
