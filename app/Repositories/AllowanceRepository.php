<?php

namespace App\Repositories;

use App\Models\Allowance;
use App\Repositories\BaseRepository;

class AllowanceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'employee_id',
        'allowance_type',
        'amount',
        'date_granted',
        'allowance_priviledge'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Allowance::class;
    }
}
