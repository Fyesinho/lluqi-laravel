<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCityAPIRequest;
use App\Http\Requests\API\UpdateCityAPIRequest;
use App\Models\City;
use App\Models\Hostel;
use App\Repositories\CityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CityController
 * @package App\Http\Controllers\API
 */

class CityAPIController extends AppBaseController
{
    /** @var  CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
    }

    /**
     * Display a listing of the City.
     * GET|HEAD /cities
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->cityRepository->pushCriteria(new RequestCriteria($request));
        $this->cityRepository->pushCriteria(new LimitOffsetCriteria($request));

        $cities = $this->cityRepository->all()->map(function ($city, $key){
            $length = Hostel::where('city_id',$city->id)->count();
            $city->length = $length;
            return $city;
        });

        return $this->sendResponse($cities->toArray(), 'Cities retrieved successfully');
    }

    /**
     * Store a newly created City in storage.
     * POST /cities
     *
     * @param CreateCityAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCityAPIRequest $request)
    {
        $input = $request->all();

        $cities = $this->cityRepository->create($input);

        return $this->sendResponse($cities->toArray(), 'City saved successfully');
    }

    /**
     * Display the specified City.
     * GET|HEAD /cities/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var City $city */
//        $city = $this->cityRepository->findWithoutFail($id);
        $city = City::with('country')->where('id', $id)->get();

        if (empty($city)) {
            return $this->sendError('City not found');
        }

        return $this->sendResponse($city->toArray(), 'City retrieved successfully');
    }

    /**
     * Update the specified City in storage.
     * PUT/PATCH /cities/{id}
     *
     * @param  int $id
     * @param UpdateCityAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCityAPIRequest $request)
    {
        $input = $request->all();

        /** @var City $city */
        $city = $this->cityRepository->findWithoutFail($id);

        if (empty($city)) {
            return $this->sendError('City not found');
        }

        $city = $this->cityRepository->update($input, $id);

        return $this->sendResponse($city->toArray(), 'City updated successfully');
    }

    /**
     * Remove the specified City from storage.
     * DELETE /cities/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var City $city */
        $city = $this->cityRepository->findWithoutFail($id);

        if (empty($city)) {
            return $this->sendError('City not found');
        }

        $city->delete();

        return $this->sendResponse($id, 'City deleted successfully');
    }
}
