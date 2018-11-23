<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTravelerRequest;
use App\Http\Requests\UpdateTravelerRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Language;
use App\Models\NeedActivity;
use App\Repositories\TravelerRepository;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Maatwebsite\Excel\Facades\Excel;
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

        $basic = NeedActivity::basic()->pluck('activity', 'id');
        $advanced = NeedActivity::advanced()->pluck('activity', 'id');

        $roles = [
            User::ROLE_ADMIN    => User::ROLE_ADMIN_TEXT,
            User::ROLE_TRAVELER => User::ROLE_TRAVELER_TEXT,
            User::ROLE_HOSTEL   => User::ROLE_HOSTEL_TEXT
        ];

        $is_premium = [
            'false'                     => '------',
            User::TRAVELER_TYPE_PRO     => User::TRAVELER_TYPE_PRO_TEXT,
            User::TRAVELER_TYPE_PROPLUS => User::TRAVELER_TYPE_PROPLUS_TEXT,
            User::TRAVELER_TYPE_GOLD    => User::TRAVELER_TYPE_GOLD_TEXT,
        ];

        return view('travelers.create', compact('countries', 'languages', 'cities', 'genders', 'roles', 'is_premium', 'basic', 'advanced'));
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

        $basic_help = request()->get('basic_help', []);
        $advanced_help = request()->get('advanced_help', []);
        $avatar = request()->file('avatar', '');
        unset($input['basic_help']);
        unset($input['advanced_help']);
        unset($input['avatar']);

        if(empty($input['password'])){
            unset($input['password']);
        }else {
            $input['password'] = bcrypt($input['password']);
        }

        $traveler = User::create($input);
        $traveler->userBasicHelp()->sync($basic_help);
        $traveler->userAdvancedHelp()->sync($advanced_help);

        if(isset($avatar) && $avatar!=''){
            $traveler->addMedia($avatar)->toMediaCollection('avatar');
        }

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

        $basic = NeedActivity::basic()->pluck('activity', 'id');
        $advanced = NeedActivity::advanced()->pluck('activity', 'id');

        $countries = Country::pluck('name', 'id');
        $languages = Language::pluck('title', 'id');
        $cities = City::pluck('city', 'id');
        $genders = Gender::pluck('name','id');
        $roles = [
            User::ROLE_ADMIN    => User::ROLE_ADMIN_TEXT,
            User::ROLE_TRAVELER => User::ROLE_TRAVELER_TEXT,
            User::ROLE_HOSTEL   => User::ROLE_HOSTEL_TEXT
        ];

        $is_premium = [
            'false'                     => '------',
            User::TRAVELER_TYPE_PRO     => User::TRAVELER_TYPE_PRO_TEXT,
            User::TRAVELER_TYPE_PROPLUS => User::TRAVELER_TYPE_PROPLUS_TEXT,
            User::TRAVELER_TYPE_GOLD    => User::TRAVELER_TYPE_GOLD_TEXT,
        ];

        return view('travelers.edit', compact('traveler', 'countries', 'languages', 'cities', 'genders', 'roles', 'is_premium', 'basic', 'advanced'));
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

        $data = $request->all();

        $basic_help = request()->get('basic_help', []);
        $advanced_help = request()->get('advanced_help', []);
        $avatar = request()->file('avatar', '');
        unset($data['basic_help']);
        unset($data['advanced_help']);
        unset($data['avatar']);

        if(empty($data['password'])){
            unset($data['password']);
        }else {
            $data['password'] = bcrypt($data['password']);
        }

        $traveler->update($data);
        $traveler->userBasicHelp()->sync($basic_help);
        $traveler->userAdvancedHelp()->sync($advanced_help);

        if(isset($avatar) && $avatar!=''){
            if($traveler->getMedia('avatar')->count()>0){
                $traveler->clearMediaCollection('avatar');
            }
            $traveler->addMedia($avatar)->toMediaCollection('avatar');
        }

        if($traveler->role == User::ROLE_ADMIN){
            return redirect()->route('user.edit', $traveler->id);
        }

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
        $traveler = User::findOrFail($id);

        if (empty($traveler)) {
            Flash::error('Traveler not found');

            return redirect(route('travelers.index'));
        }

        $traveler->delete();

        Flash::success('Traveler deleted successfully.');

        return redirect(route('travelers.index'));
    }

    public function exportToExcel(){
        $traverlers = User::select('name', 'email', 'birthday', 'phone', 'country_id', 'city')
            ->traveler()->get()
            ->map(function ($traveler){
                $traveler->nombre = $traveler->name;
                $traveler->correo = $traveler->email;
                $traveler->telefono = $traveler->phone;
                $traveler->pais = isset($traveler->country) ? $traveler->country->name : '';
                $traveler->ciudad = $traveler->city;
                $traveler->fecha_nacimiento = $traveler->birthday;

                unset($traveler->name);
                unset($traveler->phone);
                unset($traveler->email);
                unset($traveler->birthday);
                unset($traveler->country);
                unset($traveler->country_id);
                unset($traveler->city);
                return $traveler;
            })->toArray();

        return Excel::create('Viajeros-' .time(), function($excel) use ($traverlers) {
            $excel->sheet('Viajeros', function ($sheet) use ($traverlers) {
                $sheet->fromArray(
                    $traverlers
                );

            });
        })->download('xlsx');
    }
}
