<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHostelAPIRequest;
use App\Http\Requests\API\UpdateHostelAPIRequest;
use App\Models\Hostel;
use App\Repositories\HostelRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class HostelController
 * @package App\Http\Controllers\API
 */

class HostelAPIController extends AppBaseController
{
    /** @var  HostelRepository */
    private $hostelRepository;

    public function __construct(HostelRepository $hostelRepo)
    {
        $this->hostelRepository = $hostelRepo;
    }

    /**
     * Display a listing of the Hostel.
     * GET|HEAD /hostels
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->hostelRepository->pushCriteria(new RequestCriteria($request));
        $this->hostelRepository->pushCriteria(new LimitOffsetCriteria($request));
//        $hostels = $this->hostelRepository->all();
        $hostels = Hostel::search()->paginate(10);
        return $this->sendResponse($hostels->toArray(), 'Hostels retrieved successfully');
    }

    /**
     * Store a newly created Hostel in storage.
     * POST /hostels
     *
     * @param CreateHostelAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHostelAPIRequest $request)
    {
        $input = $request->all();

        $hostels = $this->hostelRepository->create($input);

        return $this->sendResponse($hostels->toArray(), 'Hostel saved successfully');
    }

    /**
     * Display the specified Hostel.
     * GET|HEAD /hostels/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Hostel $hostel */
//        $hostel = $this->hostelRepository->findWithoutFail($id);
        $hostel = Hostel::with('months')->with('activities')->with('images')->with('offers')->with('city:id,city')->where('id', $id)->get();

        if (empty($hostel)) {
            return $this->sendError('Hostel not found');
        }

        return $this->sendResponse($hostel->toArray(), 'Hostel retrieved successfully');
    }

    /**
     * Update the specified Hostel in storage.
     * PUT/PATCH /hostels/{id}
     *
     * @param  int $id
     * @param UpdateHostelAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHostelAPIRequest $request)
    {
        $input = $request->all();

        /** @var Hostel $hostel */
        $hostel = $this->hostelRepository->findWithoutFail($id);

        if (empty($hostel)) {
            return $this->sendError('Hostel not found');
        }

        $hostel = $this->hostelRepository->update($input, $id);

        return $this->sendResponse($hostel->toArray(), 'Hostel updated successfully');
    }

    /**
     * Remove the specified Hostel from storage.
     * DELETE /hostels/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Hostel $hostel */
        $hostel = $this->hostelRepository->findWithoutFail($id);

        if (empty($hostel)) {
            return $this->sendError('Hostel not found');
        }

        $hostel->delete();

        return $this->sendResponse($id, 'Hostel deleted successfully');
    }
}
