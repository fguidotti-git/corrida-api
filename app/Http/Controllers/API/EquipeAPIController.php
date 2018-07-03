<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEquipeAPIRequest;
use App\Http\Requests\API\UpdateEquipeAPIRequest;
use App\Models\Equipe;
use App\Repositories\EquipeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EquipeController
 * @package App\Http\Controllers\API
 */

class EquipeAPIController extends AppBaseController
{
    /** @var  EquipeRepository */
    private $equipeRepository;

    public function __construct(EquipeRepository $equipeRepo)
    {
        $this->equipeRepository = $equipeRepo;
    }

    /**
     * Display a listing of the Equipe.
     * GET|HEAD /equipes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->equipeRepository->pushCriteria(new RequestCriteria($request));
        $this->equipeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $equipes = $this->equipeRepository->all();

        return $this->sendResponse($equipes->toArray(), 'Equipes retrieved successfully');
    }

    /**
     * Store a newly created Equipe in storage.
     * POST /equipes
     *
     * @param CreateEquipeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEquipeAPIRequest $request)
    {
        $input = $request->all();

        $equipes = $this->equipeRepository->create($input);

        return $this->sendResponse($equipes->toArray(), 'Equipe saved successfully');
    }

    /**
     * Display the specified Equipe.
     * GET|HEAD /equipes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Equipe $equipe */
        $equipe = $this->equipeRepository->findWithoutFail($id);

        if (empty($equipe)) {
            return $this->sendError('Equipe not found');
        }

        return $this->sendResponse($equipe->toArray(), 'Equipe retrieved successfully');
    }

    /**
     * Update the specified Equipe in storage.
     * PUT/PATCH /equipes/{id}
     *
     * @param  int $id
     * @param UpdateEquipeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEquipeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Equipe $equipe */
        $equipe = $this->equipeRepository->findWithoutFail($id);

        if (empty($equipe)) {
            return $this->sendError('Equipe not found');
        }

        $equipe = $this->equipeRepository->update($input, $id);

        return $this->sendResponse($equipe->toArray(), 'Equipe updated successfully');
    }

    /**
     * Remove the specified Equipe from storage.
     * DELETE /equipes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Equipe $equipe */
        $equipe = $this->equipeRepository->findWithoutFail($id);

        if (empty($equipe)) {
            return $this->sendError('Equipe not found');
        }

        $equipe->delete();

        return $this->sendResponse($id, 'Equipe deleted successfully');
    }
}
