<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTravelerRequest;
use App\Http\Requests\UpdateTravelerRequest;
use App\Models\Country;
use App\Models\Language;
use App\Repositories\TravelerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TravelerController extends AppBaseController
{
    /** @var  TravelerRepository */
    private $travelerRepository;

    public function __construct(TravelerRepository $travelerRepo)
    {
        $this->travelerRepository = $travelerRepo;
    }

    /**
     * Display a listing of the Traveler.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->travelerRepository->pushCriteria(new RequestCriteria($request));
        $travelers = $this->travelerRepository->all();

        return view('travelers.index')
            ->with('travelers', $travelers);
    }

    /**
     * Show the form for creating a new Traveler.
     *
     * @return Response
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id');
        $languages = Language::pluck('title', 'id');

        return view('travelers.create', compact('countries', 'languages'));
    }

    /**
     * Store a newly created Traveler in storage.
     *
     * @param CreateTravelerRequest $request
     *
     * @return Response
     */
    public function store(CreateTravelerRequest $request)
    {
        $input = $request->all();
        var_dump($input);
        $traveler = $this->travelerRepository->create($input);

        Flash::success('Traveler saved successfully.');

        return redirect(route('travelers.index'));
    }

    /**
     * Display the specified Traveler.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $traveler = $this->travelerRepository->findWithoutFail($id);

        if (empty($traveler)) {
            Flash::error('Traveler not found');

            return redirect(route('travelers.index'));
        }

        return view('travelers.show')->with('traveler', $traveler);
    }

    /**
     * Show the form for editing the specified Traveler.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $traveler = $this->travelerRepository->findWithoutFail($id);

        if (empty($traveler)) {
            Flash::error('Traveler not found');

            return redirect(route('travelers.index'));
        }

        return view('travelers.edit')->with('traveler', $traveler);
    }

    /**
     * Update the specified Traveler in storage.
     *
     * @param  int              $id
     * @param UpdateTravelerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTravelerRequest $request)
    {
        $traveler = $this->travelerRepository->findWithoutFail($id);

        if (empty($traveler)) {
            Flash::error('Traveler not found');

            return redirect(route('travelers.index'));
        }

        $traveler = $this->travelerRepository->update($request->all(), $id);

        Flash::success('Traveler updated successfully.');

        return redirect(route('travelers.index'));
    }

    /**
     * Remove the specified Traveler from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $traveler = $this->travelerRepository->findWithoutFail($id);

        if (empty($traveler)) {
            Flash::error('Traveler not found');

            return redirect(route('travelers.index'));
        }

        $this->travelerRepository->delete($id);

        Flash::success('Traveler deleted successfully.');

        return redirect(route('travelers.index'));
    }
}
