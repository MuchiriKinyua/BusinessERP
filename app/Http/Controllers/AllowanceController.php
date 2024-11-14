<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAllowanceRequest;
use App\Http\Requests\UpdateAllowanceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AllowanceRepository;
use Illuminate\Http\Request;
use Flash;

class AllowanceController extends AppBaseController
{
    /** @var AllowanceRepository $allowanceRepository*/
    private $allowanceRepository;

    public function __construct(AllowanceRepository $allowanceRepo)
    {
        $this->allowanceRepository = $allowanceRepo;
    }

    /**
     * Display a listing of the Allowance.
     */
    public function index(Request $request)
    {
        $allowances = $this->allowanceRepository->paginate(10);

        return view('allowances.index')
            ->with('allowances', $allowances);
    }

    /**
     * Show the form for creating a new Allowance.
     */
    public function create()
    {
        return view('allowances.create');
    }

    /**
     * Store a newly created Allowance in storage.
     */
    public function store(CreateAllowanceRequest $request)
    {
        $input = $request->all();

        $allowance = $this->allowanceRepository->create($input);

        Flash::success('Allowance saved successfully.');

        return redirect(route('allowances.index'));
    }

    /**
     * Display the specified Allowance.
     */
    public function show($id)
    {
        $allowance = $this->allowanceRepository->find($id);

        if (empty($allowance)) {
            Flash::error('Allowance not found');

            return redirect(route('allowances.index'));
        }

        return view('allowances.show')->with('allowance', $allowance);
    }

    /**
     * Show the form for editing the specified Allowance.
     */
    public function edit($id)
    {
        $allowance = $this->allowanceRepository->find($id);

        if (empty($allowance)) {
            Flash::error('Allowance not found');

            return redirect(route('allowances.index'));
        }

        return view('allowances.edit')->with('allowance', $allowance);
    }

    /**
     * Update the specified Allowance in storage.
     */
    public function update($id, UpdateAllowanceRequest $request)
    {
        $allowance = $this->allowanceRepository->find($id);

        if (empty($allowance)) {
            Flash::error('Allowance not found');

            return redirect(route('allowances.index'));
        }

        $allowance = $this->allowanceRepository->update($request->all(), $id);

        Flash::success('Allowance updated successfully.');

        return redirect(route('allowances.index'));
    }

    /**
     * Remove the specified Allowance from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $allowance = $this->allowanceRepository->find($id);

        if (empty($allowance)) {
            Flash::error('Allowance not found');

            return redirect(route('allowances.index'));
        }

        $this->allowanceRepository->delete($id);

        Flash::success('Allowance deleted successfully.');

        return redirect(route('allowances.index'));
    }
}
