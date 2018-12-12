<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNeedActivityAPIRequest;
use App\Http\Requests\API\UpdateNeedActivityAPIRequest;
use App\Models\Hostel;
use App\Models\NeedActivity;
use App\Repositories\NeedActivityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class NeedActivityController
 * @package App\Http\Controllers\API
 */

class NeedActivityAPIController extends AppBaseController
{
    /** @var  NeedActivityRepository */
    private $needActivityRepository;

    public function __construct(NeedActivityRepository $needActivityRepo)
    {
        $this->needActivityRepository = $needActivityRepo;
    }

    /**
     * Display a listing of the NeedActivity.
     * GET|HEAD /needActivities
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->needActivityRepository->pushCriteria(new RequestCriteria($request));
        $this->needActivityRepository->pushCriteria(new LimitOffsetCriteria($request));

        $filter = request()->get('type');
        if(isset($filter) && $filter!=""){
            $needActivities = NeedActivity::whereType($filter)->get();
        }
        else{
            $needActivities = $this->needActivityRepository->all();
        }

        $needActivities = $needActivities->map(function ($needActivity, $key){
            $id = $needActivity->id;
            $length = Hostel::whereHas('activities', function ($query) use ($id) {
                $query->where('need_activities.id', $id);
            })->count();
            $needActivity->length = $length;
            return $needActivity;
        });

        return $this->sendResponse($needActivities->toArray(), 'Need Activities retrieved successfully');
    }

    /**
     * Store a newly created NeedActivity in storage.
     * POST /needActivities
     *
     * @param CreateNeedActivityAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateNeedActivityAPIRequest $request)
    {
        $input = $request->all();

        $needActivities = $this->needActivityRepository->create($input);

        return $this->sendResponse($needActivities->toArray(), 'Need Activity saved successfully');
    }

    /**
     * Display the specified NeedActivity.
     * GET|HEAD /needActivities/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var NeedActivity $needActivity */
        $needActivity = $this->needActivityRepository->findWithoutFail($id);

        if (empty($needActivity)) {
            return $this->sendError('Need Activity not found');
        }

        return $this->sendResponse($needActivity->toArray(), 'Need Activity retrieved successfully');
    }

    /**
     * Update the specified NeedActivity in storage.
     * PUT/PATCH /needActivities/{id}
     *
     * @param  int $id
     * @param UpdateNeedActivityAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNeedActivityAPIRequest $request)
    {
        $input = $request->all();

        /** @var NeedActivity $needActivity */
        $needActivity = $this->needActivityRepository->findWithoutFail($id);

        if (empty($needActivity)) {
            return $this->sendError('Need Activity not found');
        }

        $needActivity = $this->needActivityRepository->update($input, $id);

        return $this->sendResponse($needActivity->toArray(), 'NeedActivity updated successfully');
    }

    /**
     * Remove the specified NeedActivity from storage.
     * DELETE /needActivities/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var NeedActivity $needActivity */
        $needActivity = $this->needActivityRepository->findWithoutFail($id);

        if (empty($needActivity)) {
            return $this->sendError('Need Activity not found');
        }

        $needActivity->delete();

        return $this->sendResponse($id, 'Need Activity deleted successfully');
    }
}
