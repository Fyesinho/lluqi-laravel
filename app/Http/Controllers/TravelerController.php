<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTravelerRequest;
use App\Http\Requests\UpdateTravelerRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Language;
use App\Repositories\TravelerRepository;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TravelerController extends Controller
{

    /**
     * Display a listing of the Traveler.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        $travelers = User::traveler()->get();

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
        $cities = City::pluck('city', 'id');
        $genders = Gender::pluck('name','id');

        return view('travelers.create', compact('countries', 'languages', 'cities', 'genders'));
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
        $input['role'] = User::ROLE_TRAVELER;
        $traveler = User::create($input);

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
        $traveler = User::findOrFail($id);

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
        $traveler = User::findOrFail($id);

        if (empty($traveler)) {
            Flash::error('Traveler not found');

            return redirect(route('travelers.index'));
        }

        $countries = Country::pluck('name', 'id');
        $languages = Language::pluck('title', 'id');
        $cities = City::pluck('city', 'id');
        $genders = Gender::pluck('name','id');

        return view('travelers.edit', compact('traveler', 'countries', 'languages', 'cities', 'genders'));
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
        $traveler = User::findOrFail($id);

        if (empty($traveler)) {
            Flash::error('Traveler not found');

            return redirect(route('travelers.index'));
        }

        $traveler = $traveler->update($request->all());

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
