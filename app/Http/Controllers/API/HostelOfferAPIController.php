<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHostelOfferAPIRequest;
use App\Http\Requests\API\UpdateHostelOfferAPIRequest;
use App\Models\HostelOffer;
use App\Repositories\HostelOfferRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class HostelOfferController
 * @package App\Http\Controllers\API
 */

class HostelOfferAPIController extends AppBaseController
{
    /** @var  HostelOfferRepository */
    private $hostelOfferRepository;

    public function __construct(HostelOfferRepository $hostelOfferRepo)
    {
        $this->hostelOfferRepository = $hostelOfferRepo;
    }

    /**
     * Display a listing of the HostelOffer.
     * GET|HEAD /hostelOffers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->hostelOfferRepository->pushCriteria(new RequestCriteria($request));
        $this->hostelOfferRepository->pushCriteria(new LimitOffsetCriteria($request));
        $hostelOffers = $this->hostelOfferRepository->all();

        return $this->sendResponse($hostelOffers->toArray(), 'Hostel Offers retrieved successfully');
    }

    /**
     * Store a newly created HostelOffer in storage.
     * POST /hostelOffers
     *
     * @param CreateHostelOfferAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHostelOfferAPIRequest $request)
    {
        $input = $request->all();

        $hostelOffers = $this->hostelOfferRepository->create($input);

        return $this->sendResponse($hostelOffers->toArray(), 'Hostel Offer saved successfully');
    }

    /**
     * Display the specified HostelOffer.
     * GET|HEAD /hostelOffers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var HostelOffer $hostelOffer */
        $hostelOffer = $this->hostelOfferRepository->findWithoutFail($id);

        if (empty($hostelOffer)) {
            return $this->sendError('Hostel Offer not found');
        }

        return $this->sendResponse($hostelOffer->toArray(), 'Hostel Offer retrieved successfully');
    }

    /**
     * Update the specified HostelOffer in storage.
     * PUT/PATCH /hostelOffers/{id}
     *
     * @param  int $id
     * @param UpdateHostelOfferAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHostelOfferAPIRequest $request)
    {
        $input = $request->all();

        /** @var HostelOffer $hostelOffer */
        $hostelOffer = $this->hostelOfferRepository->findWithoutFail($id);

        if (empty($hostelOffer)) {
            return $this->sendError('Hostel Offer not found');
        }

        $hostelOffer = $this->hostelOfferRepository->update($input, $id);

        return $this->sendResponse($hostelOffer->toArray(), 'HostelOffer updated successfully');
    }

    /**
     * Remove the specified HostelOffer from storage.
     * DELETE /hostelOffers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var HostelOffer $hostelOffer */
        $hostelOffer = $this->hostelOfferRepository->findWithoutFail($id);

        if (empty($hostelOffer)) {
            return $this->sendError('Hostel Offer not found');
        }

        $hostelOffer->delete();

        return $this->sendResponse($id, 'Hostel Offer deleted successfully');
    }
}
