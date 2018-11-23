<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNeedActivityRequest;
use App\Http\Requests\UpdateNeedActivityRequest;
use App\Models\NeedActivity;
use App\Repositories\NeedActivityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class NeedActivityController extends AppBaseController
{
    /** @var  NeedActivityRepository */
    private $needActivityRepository;

    public function __construct(NeedActivityRepository $needActivityRepo)
    {
        $this->needActivityRepository = $needActivityRepo;
    }

    /**
     * Display a listing of the NeedActivity.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->needActivityRepository->pushCriteria(new RequestCriteria($request));
        $needActivities = $this->needActivityRepository->all();

        return view('need_activities.index')
            ->with('needActivities', $needActivities);
    }

    /**
     * Show the form for creating a new NeedActivity.
     *
     * @return Response
     */
    public function create()
    {
        $types = NeedActivity::getTypes();
        return view('need_activities.create', compact('types'));
    }

    /**
     * Store a newly created NeedActivity in storage.
     *
     * @param CreateNeedActivityRequest $request
     *
     * @return Response
     */
    public function store(CreateNeedActivityRequest $request)
    {
        $input = $request->all();

        $needActivity = $this->needActivityRepository->create($input);

        Flash::success('Need Activity saved successfully.');

        return redirect(route('needActivities.index'));
    }

    /**
     * Display the specified NeedActivity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $needActivity = $this->needActivityRepository->findWithoutFail($id);

        if (empty($needActivity)) {
            Flash::error('Need Activity not found');

            return redirect(route('needActivities.index'));
        }

        return view('need_activities.show')->with('needActivity', $needActivity);
    }

    /**
     * Show the form for editing the specified NeedActivity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $needActivity = $this->needActivityRepository->findWithoutFail($id);
        $types = NeedActivity::getTypes();

        if (empty($needActivity)) {
            Flash::error('Need Activity not found');

            return redirect(route('needActivities.index'));
        }

        return view('need_activities.edit', compact('types'))->with('needActivity', $needActivity);
    }

    /**
     * Update the specified NeedActivity in storage.
     *
     * @param  int              $id
     * @param UpdateNeedActivityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNeedActivityRequest $request)
    {
        $needActivity = $this->needActivityRepository->findWithoutFail($id);

        if (empty($needActivity)) {
            Flash::error('Need Activity not found');

            return redirect(route('needActivities.index'));
        }

        $needActivity = $this->needActivityRepository->update($request->all(), $id);

        Flash::success('Need Activity updated successfully.');

        return redirect(route('needActivities.index'));
    }

    /**
     * Remove the specified NeedActivity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $needActivity = $this->needActivityRepository->findWithoutFail($id);

        if (empty($needActivity)) {
            Flash::error('Need Activity not found');

            return redirect(route('needActivities.index'));
        }

        $this->needActivityRepository->delete($id);

        Flash::success('Need Activity deleted successfully.');

        return redirect(route('needActivities.index'));
    }
}
