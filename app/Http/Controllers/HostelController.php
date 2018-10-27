<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHostelRequest;
use App\Http\Requests\UpdateHostelRequest;
use App\Models\City;
use App\Models\Hostel;
use App\Repositories\HostelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class HostelController extends AppBaseController
{
    /** @var  HostelRepository */
    private $hostelRepository;

    public function __construct(HostelRepository $hostelRepo)
    {
        $this->hostelRepository = $hostelRepo;
    }

    /**
     * Display a listing of the Hostel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->hostelRepository->pushCriteria(new RequestCriteria($request));
        $hostels = $this->hostelRepository->all();
        return view('hostels.index')
            ->with('hostels', $hostels);
    }

    /**
     * Show the form for creating a new Hostel.
     *
     * @return Response
     */
    public function create()
    {
        $cities = City::pluck('city', 'id');
        return view('hostels.create', compact('cities'));
    }

    /**
     * Store a newly created Hostel in storage.
     *
     * @param CreateHostelRequest $request
     *
     * @return Response
     */
    public function store(CreateHostelRequest $request)
    {
        $input = $request->all();

        $hostel = $this->hostelRepository->create($input);

        Flash::success('Hostel saved successfully.');

        return redirect(route('hostels.index'));
    }

    /**
     * Display the specified Hostel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hostel = $this->hostelRepository->findWithoutFail($id);

        if (empty($hostel)) {
            Flash::error('Hostel not found');

            return redirect(route('hostels.index'));
        }

        return view('hostels.show')->with('hostel', $hostel);
    }

    /**
     * Show the form for editing the specified Hostel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hostel = $this->hostelRepository->findWithoutFail($id);
        $cities = City::pluck('city', 'id');
        if (empty($hostel)) {
            Flash::error('Hostel not found');

            return redirect(route('hostels.index'));
        }

        return view('hostels.edit', compact('cities'))->with('hostel', $hostel);
    }

    /**
     * Update the specified Hostel in storage.
     *
     * @param  int              $id
     * @param UpdateHostelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHostelRequest $request)
    {
        $hostel = $this->hostelRepository->findWithoutFail($id);

        if (empty($hostel)) {
            Flash::error('Hostel not found');

            return redirect(route('hostels.index'));
        }

        $hostel = $this->hostelRepository->update($request->all(), $id);

        Flash::success('Hostel updated successfully.');

        return redirect(route('hostels.index'));
    }

    /**
     * Remove the specified Hostel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hostel = $this->hostelRepository->findWithoutFail($id);

        if (empty($hostel)) {
            Flash::error('Hostel not found');

            return redirect(route('hostels.index'));
        }

        $this->hostelRepository->delete($id);

        Flash::success('Hostel deleted successfully.');

        return redirect(route('hostels.index'));
    }
}
