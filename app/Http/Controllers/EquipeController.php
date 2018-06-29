<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ( isset($request->search) ) {
                $equipes = Equipe::where(
                    'nome','like','%' . $request->search . '%'
                )->get();
            } else {
                $equipes = Equipe::get();
            }
            $data['result'] = $equipes;
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
            $equipe = new Equipe();
            if ( !$equipe->validate($input)["error"] ) {

                $input['imagem'] = isset($input['imagem']) ? $input['imagem']->store('imagens') : null;
                $equipe = Equipe::create($input);

                $data['result'] = $equipe;
                $data['error'] = false;
                $data['message'] = null;
                $data['http'] = 200;
            } else {
                $data['result'] = null;
                $data['error'] = true;
                $data['message'] = $equipe->validate($request)["message"]->first('nome');
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
            $equipe = Equipe::all;
            if ( !empty($equipe) ) {
                $data['result'] = $equipe;
                $data['error'] = false;
                $data['message'] = null;
                $data['http'] = 200;    
            } else {
                $data['result'] = null;
                $data['error'] = true;
                $data['message'] = 'Equipe não encontrada';
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
            $equipe = Equipe::find($id);

            if ( !empty($equipe) ) {
                if ( !$equipe->validate($input)["error"] ) {
                
                    $equipe->nome = $input['nome'];
                    $equipe->imagem = isset($input['imagem']) ? $input['imagem']->store('imagens') : $equipe['imagem'];
                    $equipe->save();
    
                    $data['result'] = $equipe;
                    $data['error'] = false;
                    $data['message'] = null;
                    $data['http'] = 200;
                } else {
                    $data['result'] = null;
                    $data['error'] = true;
                    $data['message'] = $equipe->validate($request)["message"]->first('nome');
                    $data['http'] = 403;
                }
            } else {
                $data['result'] = null;
                $data['error'] = true;
                $data['message'] = 'Equipe não encontrado';
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
            $equipe = Equipe::find($id);
            if ( !empty($equipe) ) {
                \Storage::delete($equipe['imagem']);
                $equipe->delete();
                $data['result'] = null;
                $data['error'] = false;
                $data['message'] = 'Equipe removida com sucesso';
                $data['http'] = 200;
            } else {
                $data['result'] = null;
                $data['error'] = true;
                $data['message'] = 'Equipe não encontrada';
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
