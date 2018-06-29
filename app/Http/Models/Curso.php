<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

/**
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property float $valor_compra
 * @property float $valor_venda
 * @property boolean $ativo
 * @property string $imagem
 * @property string $created_at
 * @property string $updated_at
 */
class Curso extends Model
{
    public $table = 'cursos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * @var array
     */
    protected $fillable = ['nome', 'created_at', 'updated_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
    ];

    private $rules = [
        'nome' => 'required|max:100'
    ];
    private $messages = [
        'nome.required' => 'O campo Nome da curso é obrigatório',
        'nome.max' => 'O campo Nome suporta até 100 caracteres',
    ];

    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make((array)$data, $this->rules, $this->messages);
        // return the result
        $ret = [
            "error" => $v->passes() == false ? true : false,
            "message" => $v->messages()
        ];
        return $ret;
    }
	public function vendas()
    {
      return $this->hasMany(Venda::class);
    }

}
