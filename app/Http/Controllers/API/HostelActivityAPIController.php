<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHostelActivityAPIRequest;
use App\Http\Requests\API\UpdateHostelActivityAPIRequest;
use App\Models\HostelActivity;
use App\Repositories\HostelActivityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class HostelActivityController
 * @package App\Http\Controllers\API
 */

class HostelActivityAPIController extends AppBaseController
{
    /** @var  HostelActivityRepository */
    private $hostelActivityRepository;

    public function __construct(HostelActivityRepository $hostelActivityRepo)
    {
        $this->hostelActivityRepository = $hostelActivityRepo;
    }

    /**
     * Display a listing of the HostelActivity.
     * GET|HEAD /hostelActivities
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->hostelActivityRepository->pushCriteria(new RequestCriteria($request));
        $this->hostelActivityRepository->pushCriteria(new LimitOffsetCriteria($request));
        $hostelActivities = $this->hostelActivityRepository->all();

        return $this->sendResponse($hostelActivities->toArray(), 'Hostel Activities retrieved successfully');
    }

    /**
     * Store a newly created HostelActivity in storage.
     * POST /hostelActivities
     *
     * @param CreateHostelActivityAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHostelActivityAPIRequest $request)
    {
        $input = $request->all();

        $hostelActivities = $this->hostelActivityRepository->create($input);

        return $this->sendResponse($hostelActivities->toArray(), 'Hostel Activity saved successfully');
    }

    /**
     * Display the specified HostelActivity.
     * GET|HEAD /hostelActivities/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var HostelActivity $hostelActivity */
        $hostelActivity = $this->hostelActivityRepository->findWithoutFail($id);

        if (empty($hostelActivity)) {
            return $this->sendError('Hostel Activity not found');
        }

        return $this->sendResponse($hostelActivity->toArray(), 'Hostel Activity retrieved successfully');
    }

    /**
     * Update the specified HostelActivity in storage.
     * PUT/PATCH /hostelActivities/{id}
     *
     * @param  int $id
     * @param UpdateHostelActivityAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHostelActivityAPIRequest $request)
    {
        $input = $request->all();

        /** @var HostelActivity $hostelActivity */
        $hostelActivity = $this->hostelActivityRepository->findWithoutFail($id);

        if (empty($hostelActivity)) {
            return $this->sendError('Hostel Activity not found');
        }

        $hostelActivity = $this->hostelActivityRepository->update($input, $id);

        return $this->sendResponse($hostelActivity->toArray(), 'HostelActivity updated successfully');
    }

    /**
     * Remove the specified HostelActivity from storage.
     * DELETE /hostelActivities/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var HostelActivity $hostelActivity */
        $hostelActivity = $this->hostelActivityRepository->findWithoutFail($id);

        if (empty($hostelActivity)) {
            return $this->sendError('Hostel Activity not found');
        }

        $hostelActivity->delete();

        return $this->sendResponse($id, 'Hostel Activity deleted successfully');
    }
}
