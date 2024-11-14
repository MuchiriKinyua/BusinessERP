<?php

namespace App\Repositories;

use App\Models\Promotion;
use App\Repositories\BaseRepository;

class PromotionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'employee_id',
        'previous_position',
        'new_position',
        'promotion_date',
        'previous_salary',
        'new_salary',
        'reason',
        'approved_by'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Promotion::class;
    }
}
