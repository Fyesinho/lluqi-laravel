<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMonthRequest;
use App\Http\Requests\UpdateMonthRequest;
use App\Repositories\MonthRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MonthController extends AppBaseController
{
    /** @var  MonthRepository */
    private $monthRepository;

    public function __construct(MonthRepository $monthRepo)
    {
        $this->monthRepository = $monthRepo;
    }

    /**
     * Display a listing of the Month.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->monthRepository->pushCriteria(new RequestCriteria($request));
        $months = $this->monthRepository->all();

        return view('months.index')
            ->with('months', $months);
    }

    /**
     * Show the form for creating a new Month.
     *
     * @return Response
     */
    public function create()
    {
        return view('months.create');
    }

    /**
     * Store a newly created Month in storage.
     *
     * @param CreateMonthRequest $request
     *
     * @return Response
     */
    public function store(CreateMonthRequest $request)
    {
        $input = $request->all();

        $month = $this->monthRepository->create($input);

        Flash::success('Month saved successfully.');

        return redirect(route('months.index'));
    }

    /**
     * Display the specified Month.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $month = $this->monthRepository->findWithoutFail($id);

        if (empty($month)) {
            Flash::error('Month not found');

            return redirect(route('months.index'));
        }

        return view('months.show')->with('month', $month);
    }

    /**
     * Show the form for editing the specified Month.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $month = $this->monthRepository->findWithoutFail($id);

        if (empty($month)) {
            Flash::error('Month not found');

            return redirect(route('months.index'));
        }

        return view('months.edit')->with('month', $month);
    }

    /**
     * Update the specified Month in storage.
     *
     * @param  int              $id
     * @param UpdateMonthRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMonthRequest $request)
    {
        $month = $this->monthRepository->findWithoutFail($id);

        if (empty($month)) {
            Flash::error('Month not found');

            return redirect(route('months.index'));
        }

        $month = $this->monthRepository->update($request->all(), $id);

        Flash::success('Month updated successfully.');

        return redirect(route('months.index'));
    }

    /**
     * Remove the specified Month from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $month = $this->monthRepository->findWithoutFail($id);

        if (empty($month)) {
            Flash::error('Month not found');

            return redirect(route('months.index'));
        }

        $this->monthRepository->delete($id);

        Flash::success('Month deleted successfully.');

        return redirect(route('months.index'));
    }
}
