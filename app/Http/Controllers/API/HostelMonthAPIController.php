<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHostelMonthAPIRequest;
use App\Http\Requests\API\UpdateHostelMonthAPIRequest;
use App\Models\HostelMonth;
use App\Repositories\HostelMonthRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class HostelMonthController
 * @package App\Http\Controllers\API
 */

class HostelMonthAPIController extends AppBaseController
{
    /** @var  HostelMonthRepository */
    private $hostelMonthRepository;

    public function __construct(HostelMonthRepository $hostelMonthRepo)
    {
        $this->hostelMonthRepository = $hostelMonthRepo;
    }

    /**
     * Display a listing of the HostelMonth.
     * GET|HEAD /hostelMonths
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->hostelMonthRepository->pushCriteria(new RequestCriteria($request));
        $this->hostelMonthRepository->pushCriteria(new LimitOffsetCriteria($request));
        $hostelMonths = $this->hostelMonthRepository->all();

        return $this->sendResponse($hostelMonths->toArray(), 'Hostel Months retrieved successfully');
    }

    /**
     * Store a newly created HostelMonth in storage.
     * POST /hostelMonths
     *
     * @param CreateHostelMonthAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHostelMonthAPIRequest $request)
    {
        $input = $request->all();

        $hostelMonths = $this->hostelMonthRepository->create($input);

        return $this->sendResponse($hostelMonths->toArray(), 'Hostel Month saved successfully');
    }

    /**
     * Display the specified HostelMonth.
     * GET|HEAD /hostelMonths/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var HostelMonth $hostelMonth */
        $hostelMonth = $this->hostelMonthRepository->findWithoutFail($id);

        if (empty($hostelMonth)) {
            return $this->sendError('Hostel Month not found');
        }

        return $this->sendResponse($hostelMonth->toArray(), 'Hostel Month retrieved successfully');
    }

    /**
     * Update the specified HostelMonth in storage.
     * PUT/PATCH /hostelMonths/{id}
     *
     * @param  int $id
     * @param UpdateHostelMonthAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHostelMonthAPIRequest $request)
    {
        $input = $request->all();

        /** @var HostelMonth $hostelMonth */
        $hostelMonth = $this->hostelMonthRepository->findWithoutFail($id);

        if (empty($hostelMonth)) {
            return $this->sendError('Hostel Month not found');
        }

        $hostelMonth = $this->hostelMonthRepository->update($input, $id);

        return $this->sendResponse($hostelMonth->toArray(), 'HostelMonth updated successfully');
    }

    /**
     * Remove the specified HostelMonth from storage.
     * DELETE /hostelMonths/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var HostelMonth $hostelMonth */
        $hostelMonth = $this->hostelMonthRepository->findWithoutFail($id);

        if (empty($hostelMonth)) {
            return $this->sendError('Hostel Month not found');
        }

        $hostelMonth->delete();

        return $this->sendResponse($id, 'Hostel Month deleted successfully');
    }
}
