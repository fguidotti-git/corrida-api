<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if ( isset($request->search) ) {
                $cursos = Curso::where(
                    'nome','like','%' . $request->search . '%'
                )->get();
            } else {
                $cursos = Curso::get();
            }
            $data['result'] = $cursos;
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
            $curso = new Curso();
            if ( !$curso->validate($input)["error"] ) {

                $curso = Curso::create($input);

                $data['result'] = $curso;
                $data['error'] = false;
                $data['message'] = null;
                $data['http'] = 200;
            } else {
                $data['result'] = null;
                $data['error'] = true;
                $data['message'] = $curso->validate($request)["message"]->first('nome');
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
            $curso = Curso::all;
            if ( !empty($curso) ) {
                $data['result'] = $curso;
                $data['error'] = false;
                $data['message'] = null;
                $data['http'] = 200;    
            } else {
                $data['result'] = null;
                $data['error'] = true;
                $data['message'] = 'Curso não encontrado';
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
            $curso = Curso::find($id);

            if ( !empty($curso) ) {
                if ( !$curso->validate($input)["error"] ) {
                
                    $curso->nome = $input['nome'];
                    $curso->save();
    
                    $data['result'] = $curso;
                    $data['error'] = false;
                    $data['message'] = null;
                    $data['http'] = 200;
                } else {
                    $data['result'] = null;
                    $data['error'] = true;
                    $data['message'] = $curso->validate($request)["message"]->first('nome');
                    $data['http'] = 403;
                }
            } else {
                $data['result'] = null;
                $data['error'] = true;
                $data['message'] = 'Curso não encontrado';
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
            $curso = Curso::find($id);
            if ( !empty($curso) ) {
                \Storage::delete($curso['imagem']);
                $curso->delete();
                $data['result'] = null;
                $data['error'] = false;
                $data['message'] = 'Curso removido com sucesso';
                $data['http'] = 200;
            } else {
                $data['result'] = null;
                $data['error'] = true;
                $data['message'] = 'Curso não encontrado';
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
