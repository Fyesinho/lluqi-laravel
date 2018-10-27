<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMonthAPIRequest;
use App\Http\Requests\API\UpdateMonthAPIRequest;
use App\Models\Month;
use App\Repositories\MonthRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MonthController
 * @package App\Http\Controllers\API
 */

class MonthAPIController extends AppBaseController
{
    /** @var  MonthRepository */
    private $monthRepository;

    public function __construct(MonthRepository $monthRepo)
    {
        $this->monthRepository = $monthRepo;
    }

    /**
     * Display a listing of the Month.
     * GET|HEAD /months
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->monthRepository->pushCriteria(new RequestCriteria($request));
        $this->monthRepository->pushCriteria(new LimitOffsetCriteria($request));
        $months = $this->monthRepository->all();

        return $this->sendResponse($months->toArray(), 'Months retrieved successfully');
    }

    /**
     * Store a newly created Month in storage.
     * POST /months
     *
     * @param CreateMonthAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMonthAPIRequest $request)
    {
        $input = $request->all();

        $months = $this->monthRepository->create($input);

        return $this->sendResponse($months->toArray(), 'Month saved successfully');
    }

    /**
     * Display the specified Month.
     * GET|HEAD /months/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Month $month */
        $month = $this->monthRepository->findWithoutFail($id);

        if (empty($month)) {
            return $this->sendError('Month not found');
        }

        return $this->sendResponse($month->toArray(), 'Month retrieved successfully');
    }

    /**
     * Update the specified Month in storage.
     * PUT/PATCH /months/{id}
     *
     * @param  int $id
     * @param UpdateMonthAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMonthAPIRequest $request)
    {
        $input = $request->all();

        /** @var Month $month */
        $month = $this->monthRepository->findWithoutFail($id);

        if (empty($month)) {
            return $this->sendError('Month not found');
        }

        $month = $this->monthRepository->update($input, $id);

        return $this->sendResponse($month->toArray(), 'Month updated successfully');
    }

    /**
     * Remove the specified Month from storage.
     * DELETE /months/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Month $month */
        $month = $this->monthRepository->findWithoutFail($id);

        if (empty($month)) {
            return $this->sendError('Month not found');
        }

        $month->delete();

        return $this->sendResponse($id, 'Month deleted successfully');
    }
}
