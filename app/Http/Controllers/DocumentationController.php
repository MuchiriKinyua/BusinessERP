<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDocumentationRequest;
use App\Http\Requests\UpdateDocumentationRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DocumentationRepository;
use Illuminate\Http\Request;
use Flash;

class DocumentationController extends AppBaseController
{
    /** @var DocumentationRepository $documentationRepository*/
    private $documentationRepository;

    public function __construct(DocumentationRepository $documentationRepo)
    {
        $this->documentationRepository = $documentationRepo;
    }

    /**
     * Display a listing of the Documentation.
     */
    public function index(Request $request)
    {
        $documentations = $this->documentationRepository->paginate(10);

        return view('documentations.index')
            ->with('documentations', $documentations);
    }

    /**
     * Show the form for creating a new Documentation.
     */
    public function create()
    {
        return view('documentations.create');
    }

    /**
     * Store a newly created Documentation in storage.
     */
    public function store(CreateDocumentationRequest $request)
    {
        $input = $request->all();

        $documentation = $this->documentationRepository->create($input);

        Flash::success('Documentation saved successfully.');

        return redirect(route('documentations.index'));
    }

    /**
     * Display the specified Documentation.
     */
    public function show($id)
    {
        $documentation = $this->documentationRepository->find($id);

        if (empty($documentation)) {
            Flash::error('Documentation not found');

            return redirect(route('documentations.index'));
        }

        return view('documentations.show')->with('documentation', $documentation);
    }

    /**
     * Show the form for editing the specified Documentation.
     */
    public function edit($id)
    {
        $documentation = $this->documentationRepository->find($id);

        if (empty($documentation)) {
            Flash::error('Documentation not found');

            return redirect(route('documentations.index'));
        }

        return view('documentations.edit')->with('documentation', $documentation);
    }

    /**
     * Update the specified Documentation in storage.
     */
    public function update($id, UpdateDocumentationRequest $request)
    {
        $documentation = $this->documentationRepository->find($id);

        if (empty($documentation)) {
            Flash::error('Documentation not found');

            return redirect(route('documentations.index'));
        }

        $documentation = $this->documentationRepository->update($request->all(), $id);

        Flash::success('Documentation updated successfully.');

        return redirect(route('documentations.index'));
    }

    /**
     * Remove the specified Documentation from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $documentation = $this->documentationRepository->find($id);

        if (empty($documentation)) {
            Flash::error('Documentation not found');

            return redirect(route('documentations.index'));
        }

        $this->documentationRepository->delete($id);

        Flash::success('Documentation deleted successfully.');

        return redirect(route('documentations.index'));
    }
}
