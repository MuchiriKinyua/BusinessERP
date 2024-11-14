<?php

namespace App\Repositories;

use App\Models\Deduction;
use App\Repositories\BaseRepository;

class DeductionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'employee_id',
        'deduction_type',
        'amount',
        'date_applied'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Deduction::class;
    }
}
