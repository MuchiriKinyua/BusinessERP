<?php

namespace App\Repositories;

use App\Models\Off;
use App\Repositories\BaseRepository;

class OffRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'off_name',
        'duration',
        'paid',
        'off_condition'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Off::class;
    }
}
