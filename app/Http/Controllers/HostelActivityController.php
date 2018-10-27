<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHostelActivityRequest;
use App\Http\Requests\UpdateHostelActivityRequest;
use App\Models\Hostel;
use App\Models\NeedActivity;
use App\Repositories\HostelActivityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class HostelActivityController extends AppBaseController
{
    /** @var  HostelActivityRepository */
    private $hostelActivityRepository;

    public function __construct(HostelActivityRepository $hostelActivityRepo)
    {
        $this->hostelActivityRepository = $hostelActivityRepo;
    }

    /**
     * Display a listing of the HostelActivity.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->hostelActivityRepository->pushCriteria(new RequestCriteria($request));
        $hostelActivities = $this->hostelActivityRepository->all();

        return view('hostel_activities.index')
            ->with('hostelActivities', $hostelActivities);
    }

    /**
     * Show the form for creating a new HostelActivity.
     *
     * @return Response
     */
    public function create()
    {
        $hostels = Hostel::pluck('name_hostel', 'id');
        $activities = NeedActivity::pluck('activity', 'id');
        return view('hostel_activities.create', compact('hostels', 'activities'));
    }

    /**
     * Store a newly created HostelActivity in storage.
     *
     * @param CreateHostelActivityRequest $request
     *
     * @return Response
     */
    public function store(CreateHostelActivityRequest $request)
    {
        $input = $request->all();

        $hostelActivity = $this->hostelActivityRepository->create($input);

        Flash::success('Hostel Activity saved successfully.');

        return redirect(route('hostelActivities.index'));
    }

    /**
     * Display the specified HostelActivity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hostelActivity = $this->hostelActivityRepository->findWithoutFail($id);

        if (empty($hostelActivity)) {
            Flash::error('Hostel Activity not found');

            return redirect(route('hostelActivities.index'));
        }

        return view('hostel_activities.show')->with('hostelActivity', $hostelActivity);
    }

    /**
     * Show the form for editing the specified HostelActivity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hostelActivity = $this->hostelActivityRepository->findWithoutFail($id);

        if (empty($hostelActivity)) {
            Flash::error('Hostel Activity not found');

            return redirect(route('hostelActivities.index'));
        }

        return view('hostel_activities.edit')->with('hostelActivity', $hostelActivity);
    }

    /**
     * Update the specified HostelActivity in storage.
     *
     * @param  int              $id
     * @param UpdateHostelActivityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHostelActivityRequest $request)
    {
        $hostelActivity = $this->hostelActivityRepository->findWithoutFail($id);

        if (empty($hostelActivity)) {
            Flash::error('Hostel Activity not found');

            return redirect(route('hostelActivities.index'));
        }

        $hostelActivity = $this->hostelActivityRepository->update($request->all(), $id);

        Flash::success('Hostel Activity updated successfully.');

        return redirect(route('hostelActivities.index'));
    }

    /**
     * Remove the specified HostelActivity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hostelActivity = $this->hostelActivityRepository->findWithoutFail($id);

        if (empty($hostelActivity)) {
            Flash::error('Hostel Activity not found');

            return redirect(route('hostelActivities.index'));
        }

        $this->hostelActivityRepository->delete($id);

        Flash::success('Hostel Activity deleted successfully.');

        return redirect(route('hostelActivities.index'));
    }
}
