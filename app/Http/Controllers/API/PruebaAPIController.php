<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePruebaAPIRequest;
use App\Http\Requests\API\UpdatePruebaAPIRequest;
use App\Models\Prueba;
use App\Repositories\PruebaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PruebaController
 * @package App\Http\Controllers\API
 */

class PruebaAPIController extends AppBaseController
{
    /** @var  PruebaRepository */
    private $pruebaRepository;

    public function __construct(PruebaRepository $pruebaRepo)
    {
        $this->pruebaRepository = $pruebaRepo;
    }

    /**
     * Display a listing of the Prueba.
     * GET|HEAD /pruebas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pruebaRepository->pushCriteria(new RequestCriteria($request));
        $this->pruebaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pruebas = $this->pruebaRepository->all();

        return $this->sendResponse($pruebas->toArray(), 'Pruebas retrieved successfully');
    }

    /**
     * Store a newly created Prueba in storage.
     * POST /pruebas
     *
     * @param CreatePruebaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePruebaAPIRequest $request)
    {
        $input = $request->all();

        $pruebas = $this->pruebaRepository->create($input);

        return $this->sendResponse($pruebas->toArray(), 'Prueba saved successfully');
    }

    /**
     * Display the specified Prueba.
     * GET|HEAD /pruebas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Prueba $prueba */
        $prueba = $this->pruebaRepository->findWithoutFail($id);

        if (empty($prueba)) {
            return $this->sendError('Prueba not found');
        }

        return $this->sendResponse($prueba->toArray(), 'Prueba retrieved successfully');
    }

    /**
     * Update the specified Prueba in storage.
     * PUT/PATCH /pruebas/{id}
     *
     * @param  int $id
     * @param UpdatePruebaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePruebaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Prueba $prueba */
        $prueba = $this->pruebaRepository->findWithoutFail($id);

        if (empty($prueba)) {
            return $this->sendError('Prueba not found');
        }

        $prueba = $this->pruebaRepository->update($input, $id);

        return $this->sendResponse($prueba->toArray(), 'Prueba updated successfully');
    }

    /**
     * Remove the specified Prueba from storage.
     * DELETE /pruebas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Prueba $prueba */
        $prueba = $this->pruebaRepository->findWithoutFail($id);

        if (empty($prueba)) {
            return $this->sendError('Prueba not found');
        }

        $prueba->delete();

        return $this->sendResponse($id, 'Prueba deleted successfully');
    }
}
