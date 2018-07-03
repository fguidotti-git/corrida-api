<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            
            $vendas = Venda::get();
            
            $data['result'] = $vendas;
            $data['error'] = false;
            $data['message'] = null;
            $data['http'] = 200;
        } catch( Exception $e ){
            $data['result'] = null;
            $data['error'] = true;
            $data['message'] = $e->getMessage();
            $data['http'] = 403;
        }
        return response()->json($data, $data['http']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $venda = new Venda();
            if ( !$venda->validate($input)["error"] ) {

                $venda = Venda::create($input);

                $data['result'] = $venda;
                $data['error'] = false;
                $data['message'] = null;
                $data['http'] = 200;
            } else {
                $data['result'] = null;
                $data['error'] = true;
                $data['message'] = $venda->validate($request)["message"]->first('aluno');
                $data['http'] = 403;
            }
        } catch( Exception $e ){
            $data['result'] = null;
            $data['error'] = true;
            $data['message'] = $e->getMessage();
            $data['http'] = 403;
        }
        return response()->json($data, $data['http']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $venda = Venda::all;
            if ( !empty($venda) ) {
                $data['result'] = $venda;
                $data['error'] = false;
                $data['message'] = null;
                $data['http'] = 200;    
            } else {
                $data['result'] = null;
                $data['error'] = true;
                $data['message'] = 'Venda não encontrada';
                $data['http'] = 403;
            }
        } catch( Exception $e ){
            $data['result'] = null;
            $data['error'] = true;
            $data['message'] = $e->getMessage();
            $data['http'] = 403;
        }
        return response()->json($data, $data['http']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $input = $request->all();
            $venda = Venda::find($id);

            if ( !empty($venda) ) {
                if ( !$venda->validate($input)["error"] ) {
                
                    $venda->nome = $input['user_id'];
					$venda->nome = $input['curso_id'];
					$venda->nome = $input['aluno'];
                    $venda->save();
    
                    $data['result'] = $venda;
                    $data['error'] = false;
                    $data['message'] = null;
                    $data['http'] = 200;
                } else {
                    $data['result'] = null;
                    $data['error'] = true;
                    $data['message'] = $venda->validate($request)["message"]->first('nome');
                    $data['http'] = 403;
                }
            } else {
                $data['result'] = null;
                $data['error'] = true;
                $data['message'] = 'Venda não encontrado';
                $data['http'] = 403;
            }
        } catch( Exception $e ){
            $data['result'] = null;
            $data['error'] = true;
            $data['message'] = $e->getMessage();
            $data['http'] = 403;
        }
        return response()->json($data, $data['http']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $venda = Venda::find($id);
            if ( !empty($venda) ) {

                $venda->delete();
                $data['result'] = null;
                $data['error'] = false;
                $data['message'] = 'Venda removida com sucesso';
                $data['http'] = 200;
            } else {
                $data['result'] = null;
                $data['error'] = true;
                $data['message'] = 'Venda não encontrada';
                $data['http'] = 403;
            }
        } catch( Exception $e ){
            $data['result'] = null;
            $data['error'] = true;
            $data['message'] = $e->getMessage();
            $data['http'] = 403;
        }
        return response()->json($data, $data['http']);
    }
}
