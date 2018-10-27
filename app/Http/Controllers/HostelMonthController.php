<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHostelMonthRequest;
use App\Http\Requests\UpdateHostelMonthRequest;
use App\Models\Hostel;
use App\Models\Month;
use App\Repositories\HostelMonthRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class HostelMonthController extends AppBaseController
{
    /** @var  HostelMonthRepository */
    private $hostelMonthRepository;

    public function __construct(HostelMonthRepository $hostelMonthRepo)
    {
        $this->hostelMonthRepository = $hostelMonthRepo;
    }

    /**
     * Display a listing of the HostelMonth.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->hostelMonthRepository->pushCriteria(new RequestCriteria($request));
        $hostelMonths = $this->hostelMonthRepository->all();

        return view('hostel_months.index')
            ->with('hostelMonths', $hostelMonths);
    }

    /**
     * Show the form for creating a new HostelMonth.
     *
     * @return Response
     */
    public function create()
    {
        $hostels = Hostel::pluck('name_hostel', 'id');
        $months = Month::pluck('name', 'id');
        return view('hostel_months.create', compact('hostels', 'months'));
    }

    /**
     * Store a newly created HostelMonth in storage.
     *
     * @param CreateHostelMonthRequest $request
     *
     * @return Response
     */
    public function store(CreateHostelMonthRequest $request)
    {
        $input = $request->all();

        $hostelMonth = $this->hostelMonthRepository->create($input);

        Flash::success('Hostel Month saved successfully.');

        return redirect(route('hostelMonths.index'));
    }

    /**
     * Display the specified HostelMonth.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hostelMonth = $this->hostelMonthRepository->findWithoutFail($id);

        if (empty($hostelMonth)) {
            Flash::error('Hostel Month not found');

            return redirect(route('hostelMonths.index'));
        }

        return view('hostel_months.show')->with('hostelMonth', $hostelMonth);
    }

    /**
     * Show the form for editing the specified HostelMonth.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hostelMonth = $this->hostelMonthRepository->findWithoutFail($id);

        if (empty($hostelMonth)) {
            Flash::error('Hostel Month not found');

            return redirect(route('hostelMonths.index'));
        }

        return view('hostel_months.edit')->with('hostelMonth', $hostelMonth);
    }

    /**
     * Update the specified HostelMonth in storage.
     *
     * @param  int              $id
     * @param UpdateHostelMonthRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHostelMonthRequest $request)
    {
        $hostelMonth = $this->hostelMonthRepository->findWithoutFail($id);

        if (empty($hostelMonth)) {
            Flash::error('Hostel Month not found');

            return redirect(route('hostelMonths.index'));
        }

        $hostelMonth = $this->hostelMonthRepository->update($request->all(), $id);

        Flash::success('Hostel Month updated successfully.');

        return redirect(route('hostelMonths.index'));
    }

    /**
     * Remove the specified HostelMonth from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hostelMonth = $this->hostelMonthRepository->findWithoutFail($id);

        if (empty($hostelMonth)) {
            Flash::error('Hostel Month not found');

            return redirect(route('hostelMonths.index'));
        }

        $this->hostelMonthRepository->delete($id);

        Flash::success('Hostel Month deleted successfully.');

        return redirect(route('hostelMonths.index'));
    }
}
