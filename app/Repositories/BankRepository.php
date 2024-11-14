<?php

namespace App\Repositories;

use App\Models\Bank;
use App\Repositories\BaseRepository;

class BankRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'employee_id',
        'bank_name',
        'branch_name',
        'account_number',
        'account_name',
        'account_type',
        'bank_code',
        'currency'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Bank::class;
    }
}
