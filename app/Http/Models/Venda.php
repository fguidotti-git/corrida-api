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
class Venda extends Model
{
    public $table = 'vendas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'curso_id','aluno', 'created_at', 'updated_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
		'user_id' => 'integer',
		'curso_id' => 'integer',
        'aluno' => 'string',
    ];

    private $rules = [
        'user_id' => 'required|max:100',
		'curso_id' => 'required|max:100',
		'aluno' => 'required|max:100',
    ];
    private $messages = [
		'user_id.required' => 'O campo Nome da venda é obrigatório',
		'curso_id.required' => 'O campo Nome da venda é obrigatório',
        'aluno.required' => 'O campo Nome da venda é obrigatório',
        'aluno.max' => 'O campo Nome suporta até 100 caracteres',
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

	public function updateVenda($data)
	{
        $ticket = $this->find($data['id']);
        $ticket->user_id = $data['user_id'];
		$ticket->curso_id = $data['curso_id'];
		$ticket->aluno = $data['aluno'];
        $ticket->save();
        return 1;
	}

	public function saveVenda($data)
	{
		$this->user_id = $data['user_id'];
		$this->curso_id = $data['curso_id'];
		$this->aluno = $data['aluno'];
		$this->save();
		return 1;
	}
}
