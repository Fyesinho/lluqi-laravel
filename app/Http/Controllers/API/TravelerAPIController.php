<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTravelerAPIRequest;
use App\Http\Requests\API\UpdateTravelerAPIRequest;
use App\Models\Traveler;
use App\Repositories\TravelerRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TravelerController
 * @package App\Http\Controllers\API
 */

class TravelerAPIController extends AppBaseController
{

    /**
     * Display a listing of the Traveler.
     * GET|HEAD /travelers
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        $travelers = User::traveler()->get();
        return $this->sendResponse($travelers->toArray(), 'Travelers retrieved successfully');
    }

    /**
     * Store a newly created Traveler in storage.
     * POST /travelers
     *
     * @param CreateTravelerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTravelerAPIRequest $request)
    {
        $input = $request->all();
        $input['role'] = User::ROLE_TRAVELER;
        $travelers = User::create($input);

        return $this->sendResponse($travelers->toArray(), 'Traveler saved successfully');
    }

    /**
     * Display the specified Traveler.
     * GET|HEAD /travelers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $traveler = User::findOrFail($id);

        if (empty($traveler)) {
            return $this->sendError('Traveler not found');
        }

        return $this->sendResponse($traveler->toArray(), 'Traveler retrieved successfully');
    }

    /**
     * Update the specified Traveler in storage.
     * PUT/PATCH /travelers/{id}
     *
     * @param  int $id
     * @param UpdateTravelerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTravelerAPIRequest $request)
    {
        $input = $request->all();
        $traveler = User::findOrFail($id);

        if (empty($traveler)) {
            return $this->sendError('Traveler not found');
        }

        $traveler = $traveler->update($request->all());

        return $this->sendResponse($traveler->toArray(), 'Traveler updated successfully');
    }

    /**
     * Remove the specified Traveler from storage.
     * DELETE /travelers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $traveler = User::findOrFail($id);

        if (empty($traveler)) {
            return $this->sendError('Traveler not found');
        }

        $traveler->delete();
        return $this->sendResponse($id, 'Traveler deleted successfully');
    }
}
