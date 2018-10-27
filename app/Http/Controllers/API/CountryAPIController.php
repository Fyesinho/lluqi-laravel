<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLanguageAPIRequest;
use App\Http\Requests\API\UpdateCountryAPIRequest;
use App\Http\Requests\API\UpdateLanguageAPIRequest;
use App\Models\Language;
use App\Repositories\CountryRepository;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class LanguageController
 * @package App\Http\Controllers\API
 */

class CountryAPIController extends AppBaseController
{
    /** @var  LanguageRepository */
    private $countryRepository;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;
    }

    /**
     * Display a listing of the Language.
     * GET|HEAD /languages
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->countryRepository->pushCriteria(new RequestCriteria($request));
        $this->countryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $countries = $this->countryRepository->all();

        return $this->sendResponse($countries->toArray(), 'Countries retrieved successfully');
    }

    /**
     * Store a newly created Language in storage.
     * POST /languages
     *
     * @param CreateLanguageAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLanguageAPIRequest $request)
    {
        $input = $request->all();

        $countries = $this->countryRepository->create($input);

        return $this->sendResponse($countries->toArray(), 'Country saved successfully');
    }

    /**
     * Display the specified Language.
     * GET|HEAD /languages/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Language $language */
        $country = $this->countryRepository->findWithoutFail($id);

        if (empty($country)) {
            return $this->sendError('Country not found');
        }

        return $this->sendResponse($country->toArray(), 'Country retrieved successfully');
    }

    /**
     * Update the specified Language in storage.
     * PUT/PATCH /languages/{id}
     *
     * @param  int $id
     * @param UpdateLanguageAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Language $language */
        $country = $this->countryRepository->findWithoutFail($id);

        if (empty($country)) {
            return $this->sendError('Language not found');
        }

        $country = $this->countryRepository->update($input, $id);

        return $this->sendResponse($country->toArray(), 'Country updated successfully');
    }

    /**
     * Remove the specified Language from storage.
     * DELETE /languages/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Language $language */
        $country = $this->countryRepository->findWithoutFail($id);

        if (empty($country)) {
            return $this->sendError('Country not found');
        }

        $country->delete();

        return $this->sendResponse($id, 'Country deleted successfully');
    }
}
