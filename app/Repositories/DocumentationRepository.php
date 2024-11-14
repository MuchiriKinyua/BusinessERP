<?php

namespace App\Repositories;

use App\Models\Documentation;
use App\Repositories\BaseRepository;

class DocumentationRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'employee_id',
        'resume',
        'document_type',
        'document_name',
        'file_path'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Documentation::class;
    }
}
