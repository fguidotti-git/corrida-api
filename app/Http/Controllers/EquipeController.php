<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEquipeRequest;
use App\Http\Requests\UpdateEquipeRequest;
use App\Repositories\EquipeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class EquipeController extends AppBaseController
{
    /** @var  EquipeRepository */
    private $equipeRepository;

    public function __construct(EquipeRepository $equipeRepo)
    {
        $this->equipeRepository = $equipeRepo;
    }

    /**
     * Display a listing of the Equipe.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->equipeRepository->pushCriteria(new RequestCriteria($request));
        $equipes = $this->equipeRepository->all();

        return view('equipes.index')
            ->with('equipes', $equipes);
    }

    /**
     * Show the form for creating a new Equipe.
     *
     * @return Response
     */
    public function create()
    {
        return view('equipes.create');
    }

    /**
     * Store a newly created Equipe in storage.
     *
     * @param CreateEquipeRequest $request
     *
     * @return Response
     */
    public function store(CreateEquipeRequest $request)
    {
        $input = $request->all();

        $equipe = $this->equipeRepository->create($input);

        Flash::success('Equipe saved successfully.');

        return redirect(route('equipes.index'));
    }

    /**
     * Display the specified Equipe.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $equipe = $this->equipeRepository->findWithoutFail($id);

        if (empty($equipe)) {
            Flash::error('Equipe not found');

            return redirect(route('equipes.index'));
        }

        return view('equipes.show')->with('equipe', $equipe);
    }

    /**
     * Show the form for editing the specified Equipe.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $equipe = $this->equipeRepository->findWithoutFail($id);

        if (empty($equipe)) {
            Flash::error('Equipe not found');

            return redirect(route('equipes.index'));
        }

        return view('equipes.edit')->with('equipe', $equipe);
    }

    /**
     * Update the specified Equipe in storage.
     *
     * @param  int              $id
     * @param UpdateEquipeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEquipeRequest $request)
    {
        $equipe = $this->equipeRepository->findWithoutFail($id);

        if (empty($equipe)) {
            Flash::error('Equipe not found');

            return redirect(route('equipes.index'));
        }

        $equipe = $this->equipeRepository->update($request->all(), $id);

        Flash::success('Equipe updated successfully.');

        return redirect(route('equipes.index'));
    }

    /**
     * Remove the specified Equipe from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $equipe = $this->equipeRepository->findWithoutFail($id);

        if (empty($equipe)) {
            Flash::error('Equipe not found');

            return redirect(route('equipes.index'));
        }

        $this->equipeRepository->delete($id);

        Flash::success('Equipe deleted successfully.');

        return redirect(route('equipes.index'));
    }
}
