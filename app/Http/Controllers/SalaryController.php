<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalaryRequest;
use App\Http\Requests\UpdateSalaryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SalaryRepository;
use Illuminate\Http\Request;
use Flash;

class SalaryController extends AppBaseController
{
    /** @var SalaryRepository $salaryRepository*/
    private $salaryRepository;

    public function __construct(SalaryRepository $salaryRepo)
    {
        $this->salaryRepository = $salaryRepo;
    }

    /**
     * Display a listing of the Salary.
     */
    public function index(Request $request)
    {
        $salaries = $this->salaryRepository->paginate(10);

        return view('salaries.index')
            ->with('salaries', $salaries);
    }

    /**
     * Show the form for creating a new Salary.
     */
    public function create()
    {
        return view('salaries.create');
    }

    /**
     * Store a newly created Salary in storage.
     */
    public function store(CreateSalaryRequest $request)
    {
        $input = $request->all();

        $salary = $this->salaryRepository->create($input);

        Flash::success('Salary saved successfully.');

        return redirect(route('salaries.index'));
    }

    /**
     * Display the specified Salary.
     */
    public function show($id)
    {
        $salary = $this->salaryRepository->find($id);

        if (empty($salary)) {
            Flash::error('Salary not found');

            return redirect(route('salaries.index'));
        }

        return view('salaries.show')->with('salary', $salary);
    }

    /**
     * Show the form for editing the specified Salary.
     */
    public function edit($id)
    {
        $salary = $this->salaryRepository->find($id);

        if (empty($salary)) {
            Flash::error('Salary not found');

            return redirect(route('salaries.index'));
        }

        return view('salaries.edit')->with('salary', $salary);
    }

    /**
     * Update the specified Salary in storage.
     */
    public function update($id, UpdateSalaryRequest $request)
    {
        $salary = $this->salaryRepository->find($id);

        if (empty($salary)) {
            Flash::error('Salary not found');

            return redirect(route('salaries.index'));
        }

        $salary = $this->salaryRepository->update($request->all(), $id);

        Flash::success('Salary updated successfully.');

        return redirect(route('salaries.index'));
    }

    /**
     * Remove the specified Salary from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $salary = $this->salaryRepository->find($id);

        if (empty($salary)) {
            Flash::error('Salary not found');

            return redirect(route('salaries.index'));
        }

        $this->salaryRepository->delete($id);

        Flash::success('Salary deleted successfully.');

        return redirect(route('salaries.index'));
    }
}
