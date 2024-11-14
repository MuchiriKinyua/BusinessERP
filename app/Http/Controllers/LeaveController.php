<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\LeaveRepository;
use Illuminate\Http\Request;
use Flash;

class LeaveController extends AppBaseController
{
    /** @var LeaveRepository $leaveRepository*/
    private $leaveRepository;

    public function __construct(LeaveRepository $leaveRepo)
    {
        $this->leaveRepository = $leaveRepo;
    }

    /**
     * Display a listing of the Leave.
     */
    public function index(Request $request)
    {
        $leaves = $this->leaveRepository->paginate(10);

        return view('leaves.index')
            ->with('leaves', $leaves);
    }

    /**
     * Show the form for creating a new Leave.
     */
    public function create()
    {
        return view('leaves.create');
    }

    /**
     * Store a newly created Leave in storage.
     */
    public function store(CreateLeaveRequest $request)
    {
        $input = $request->all();

        $leave = $this->leaveRepository->create($input);

        Flash::success('Leave saved successfully.');

        return redirect(route('leaves.index'));
    }

    /**
     * Display the specified Leave.
     */
    public function show($id)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(route('leaves.index'));
        }

        return view('leaves.show')->with('leave', $leave);
    }

    /**
     * Show the form for editing the specified Leave.
     */
    public function edit($id)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(route('leaves.index'));
        }

        return view('leaves.edit')->with('leave', $leave);
    }

    /**
     * Update the specified Leave in storage.
     */
    public function update($id, UpdateLeaveRequest $request)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(route('leaves.index'));
        }

        $leave = $this->leaveRepository->update($request->all(), $id);

        Flash::success('Leave updated successfully.');

        return redirect(route('leaves.index'));
    }

    /**
     * Remove the specified Leave from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(route('leaves.index'));
        }

        $this->leaveRepository->delete($id);

        Flash::success('Leave deleted successfully.');

        return redirect(route('leaves.index'));
    }
}
