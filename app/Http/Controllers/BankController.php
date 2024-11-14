<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBankRequest;
use App\Http\Requests\UpdateBankRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BankRepository;
use Illuminate\Http\Request;
use Flash;

class BankController extends AppBaseController
{
    /** @var BankRepository $bankRepository*/
    private $bankRepository;

    public function __construct(BankRepository $bankRepo)
    {
        $this->bankRepository = $bankRepo;
    }

    /**
     * Display a listing of the Bank.
     */
    public function index(Request $request)
    {
        $banks = $this->bankRepository->paginate(10);

        return view('banks.index')
            ->with('banks', $banks);
    }

    /**
     * Show the form for creating a new Bank.
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created Bank in storage.
     */
    public function store(CreateBankRequest $request)
    {
        $input = $request->all();

        $bank = $this->bankRepository->create($input);

        Flash::success('Bank saved successfully.');

        return redirect(route('banks.index'));
    }

    /**
     * Display the specified Bank.
     */
    public function show($id)
    {
        $bank = $this->bankRepository->find($id);

        if (empty($bank)) {
            Flash::error('Bank not found');

            return redirect(route('banks.index'));
        }

        return view('banks.show')->with('bank', $bank);
    }

    /**
     * Show the form for editing the specified Bank.
     */
    public function edit($id)
    {
        $bank = $this->bankRepository->find($id);

        if (empty($bank)) {
            Flash::error('Bank not found');

            return redirect(route('banks.index'));
        }

        return view('banks.edit')->with('bank', $bank);
    }

    /**
     * Update the specified Bank in storage.
     */
    public function update($id, UpdateBankRequest $request)
    {
        $bank = $this->bankRepository->find($id);

        if (empty($bank)) {
            Flash::error('Bank not found');

            return redirect(route('banks.index'));
        }

        $bank = $this->bankRepository->update($request->all(), $id);

        Flash::success('Bank updated successfully.');

        return redirect(route('banks.index'));
    }

    /**
     * Remove the specified Bank from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bank = $this->bankRepository->find($id);

        if (empty($bank)) {
            Flash::error('Bank not found');

            return redirect(route('banks.index'));
        }

        $this->bankRepository->delete($id);

        Flash::success('Bank deleted successfully.');

        return redirect(route('banks.index'));
    }
}
