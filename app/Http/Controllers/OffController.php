<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOffRequest;
use App\Http\Requests\UpdateOffRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\OffRepository;
use Illuminate\Http\Request;
use Flash;

class OffController extends AppBaseController
{
    /** @var OffRepository $offRepository*/
    private $offRepository;

    public function __construct(OffRepository $offRepo)
    {
        $this->offRepository = $offRepo;
    }

    /**
     * Display a listing of the Off.
     */
    public function index(Request $request)
    {
        $offs = $this->offRepository->paginate(10);

        return view('offs.index')
            ->with('offs', $offs);
    }

    /**
     * Show the form for creating a new Off.
     */
    public function create()
    {
        return view('offs.create');
    }

    /**
     * Store a newly created Off in storage.
     */
    public function store(CreateOffRequest $request)
    {
        $input = $request->all();

        $off = $this->offRepository->create($input);

        Flash::success('Off saved successfully.');

        return redirect(route('offs.index'));
    }

    /**
     * Display the specified Off.
     */
    public function show($id)
    {
        $off = $this->offRepository->find($id);

        if (empty($off)) {
            Flash::error('Off not found');

            return redirect(route('offs.index'));
        }

        return view('offs.show')->with('off', $off);
    }

    /**
     * Show the form for editing the specified Off.
     */
    public function edit($id)
    {
        $off = $this->offRepository->find($id);

        if (empty($off)) {
            Flash::error('Off not found');

            return redirect(route('offs.index'));
        }

        return view('offs.edit')->with('off', $off);
    }

    /**
     * Update the specified Off in storage.
     */
    public function update($id, UpdateOffRequest $request)
    {
        $off = $this->offRepository->find($id);

        if (empty($off)) {
            Flash::error('Off not found');

            return redirect(route('offs.index'));
        }

        $off = $this->offRepository->update($request->all(), $id);

        Flash::success('Off updated successfully.');

        return redirect(route('offs.index'));
    }

    /**
     * Remove the specified Off from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $off = $this->offRepository->find($id);

        if (empty($off)) {
            Flash::error('Off not found');

            return redirect(route('offs.index'));
        }

        $this->offRepository->delete($id);

        Flash::success('Off deleted successfully.');

        return redirect(route('offs.index'));
    }
}
