<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHostelOfferRequest;
use App\Http\Requests\UpdateHostelOfferRequest;
use App\Models\Hostel;
use App\Models\Offer;
use App\Repositories\HostelOfferRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class HostelOfferController extends AppBaseController
{
    /** @var  HostelOfferRepository */
    private $hostelOfferRepository;

    public function __construct(HostelOfferRepository $hostelOfferRepo)
    {
        $this->hostelOfferRepository = $hostelOfferRepo;
    }

    /**
     * Display a listing of the HostelOffer.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->hostelOfferRepository->pushCriteria(new RequestCriteria($request));
        $hostelOffers = $this->hostelOfferRepository->all();

        return view('hostel_offers.index')
            ->with('hostelOffers', $hostelOffers);
    }

    /**
     * Show the form for creating a new HostelOffer.
     *
     * @return Response
     */
    public function create()
    {
        $hostels = Hostel::pluck('name_hostel', 'id');
        $offers = Offer::pluck('offer', 'id');
        return view('hostel_offers.create', compact('hostels', 'offers'));
    }

    /**
     * Store a newly created HostelOffer in storage.
     *
     * @param CreateHostelOfferRequest $request
     *
     * @return Response
     */
    public function store(CreateHostelOfferRequest $request)
    {
        $input = $request->all();

        $hostelOffer = $this->hostelOfferRepository->create($input);

        Flash::success('Hostel Offer saved successfully.');

        return redirect(route('hostelOffers.index'));
    }

    /**
     * Display the specified HostelOffer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hostelOffer = $this->hostelOfferRepository->findWithoutFail($id);

        if (empty($hostelOffer)) {
            Flash::error('Hostel Offer not found');

            return redirect(route('hostelOffers.index'));
        }

        return view('hostel_offers.show')->with('hostelOffer', $hostelOffer);
    }

    /**
     * Show the form for editing the specified HostelOffer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hostelOffer = $this->hostelOfferRepository->findWithoutFail($id);

        if (empty($hostelOffer)) {
            Flash::error('Hostel Offer not found');

            return redirect(route('hostelOffers.index'));
        }

        return view('hostel_offers.edit')->with('hostelOffer', $hostelOffer);
    }

    /**
     * Update the specified HostelOffer in storage.
     *
     * @param  int              $id
     * @param UpdateHostelOfferRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHostelOfferRequest $request)
    {
        $hostelOffer = $this->hostelOfferRepository->findWithoutFail($id);

        if (empty($hostelOffer)) {
            Flash::error('Hostel Offer not found');

            return redirect(route('hostelOffers.index'));
        }

        $hostelOffer = $this->hostelOfferRepository->update($request->all(), $id);

        Flash::success('Hostel Offer updated successfully.');

        return redirect(route('hostelOffers.index'));
    }

    /**
     * Remove the specified HostelOffer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hostelOffer = $this->hostelOfferRepository->findWithoutFail($id);

        if (empty($hostelOffer)) {
            Flash::error('Hostel Offer not found');

            return redirect(route('hostelOffers.index'));
        }

        $this->hostelOfferRepository->delete($id);

        Flash::success('Hostel Offer deleted successfully.');

        return redirect(route('hostelOffers.index'));
    }
}
