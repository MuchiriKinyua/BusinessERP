<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeductionRequest;
use App\Http\Requests\UpdateDeductionRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DeductionRepository;
use Illuminate\Http\Request;
use Flash;

class DeductionController extends AppBaseController
{
    /** @var DeductionRepository $deductionRepository*/
    private $deductionRepository;

    public function __construct(DeductionRepository $deductionRepo)
    {
        $this->deductionRepository = $deductionRepo;
    }

    /**
     * Display a listing of the Deduction.
     */
    public function index(Request $request)
    {
        $deductions = $this->deductionRepository->paginate(10);

        return view('deductions.index')
            ->with('deductions', $deductions);
    }

    /**
     * Show the form for creating a new Deduction.
     */
    public function create()
    {
        return view('deductions.create');
    }

    /**
     * Store a newly created Deduction in storage.
     */
    public function store(CreateDeductionRequest $request)
    {
        $input = $request->all();

        $deduction = $this->deductionRepository->create($input);

        Flash::success('Deduction saved successfully.');

        return redirect(route('deductions.index'));
    }

    /**
     * Display the specified Deduction.
     */
    public function show($id)
    {
        $deduction = $this->deductionRepository->find($id);

        if (empty($deduction)) {
            Flash::error('Deduction not found');

            return redirect(route('deductions.index'));
        }

        return view('deductions.show')->with('deduction', $deduction);
    }

    /**
     * Show the form for editing the specified Deduction.
     */
    public function edit($id)
    {
        $deduction = $this->deductionRepository->find($id);

        if (empty($deduction)) {
            Flash::error('Deduction not found');

            return redirect(route('deductions.index'));
        }

        return view('deductions.edit')->with('deduction', $deduction);
    }

    /**
     * Update the specified Deduction in storage.
     */
    public function update($id, UpdateDeductionRequest $request)
    {
        $deduction = $this->deductionRepository->find($id);

        if (empty($deduction)) {
            Flash::error('Deduction not found');

            return redirect(route('deductions.index'));
        }

        $deduction = $this->deductionRepository->update($request->all(), $id);

        Flash::success('Deduction updated successfully.');

        return redirect(route('deductions.index'));
    }

    /**
     * Remove the specified Deduction from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $deduction = $this->deductionRepository->find($id);

        if (empty($deduction)) {
            Flash::error('Deduction not found');

            return redirect(route('deductions.index'));
        }

        $this->deductionRepository->delete($id);

        Flash::success('Deduction deleted successfully.');

        return redirect(route('deductions.index'));
    }
}
