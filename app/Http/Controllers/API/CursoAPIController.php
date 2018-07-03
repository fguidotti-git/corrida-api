<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCursoAPIRequest;
use App\Http\Requests\API\UpdateCursoAPIRequest;
use App\Models\Curso;
use App\Repositories\CursoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CursoController
 * @package App\Http\Controllers\API
 */

class CursoAPIController extends AppBaseController
{
    /** @var  CursoRepository */
    private $cursoRepository;

    public function __construct(CursoRepository $cursoRepo)
    {
        $this->cursoRepository = $cursoRepo;
    }

    /**
     * Display a listing of the Curso.
     * GET|HEAD /cursos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->cursoRepository->pushCriteria(new RequestCriteria($request));
        $this->cursoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $cursos = $this->cursoRepository->all();

        return $this->sendResponse($cursos->toArray(), 'Cursos retrieved successfully');
    }

    /**
     * Store a newly created Curso in storage.
     * POST /cursos
     *
     * @param CreateCursoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCursoAPIRequest $request)
    {
        $input = $request->all();

        $cursos = $this->cursoRepository->create($input);

        return $this->sendResponse($cursos->toArray(), 'Curso saved successfully');
    }

    /**
     * Display the specified Curso.
     * GET|HEAD /cursos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Curso $curso */
        $curso = $this->cursoRepository->findWithoutFail($id);

        if (empty($curso)) {
            return $this->sendError('Curso not found');
        }

        return $this->sendResponse($curso->toArray(), 'Curso retrieved successfully');
    }

    /**
     * Update the specified Curso in storage.
     * PUT/PATCH /cursos/{id}
     *
     * @param  int $id
     * @param UpdateCursoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCursoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Curso $curso */
        $curso = $this->cursoRepository->findWithoutFail($id);

        if (empty($curso)) {
            return $this->sendError('Curso not found');
        }

        $curso = $this->cursoRepository->update($input, $id);

        return $this->sendResponse($curso->toArray(), 'Curso updated successfully');
    }

    /**
     * Remove the specified Curso from storage.
     * DELETE /cursos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Curso $curso */
        $curso = $this->cursoRepository->findWithoutFail($id);

        if (empty($curso)) {
            return $this->sendError('Curso not found');
        }

        $curso->delete();

        return $this->sendResponse($id, 'Curso deleted successfully');
    }
}
