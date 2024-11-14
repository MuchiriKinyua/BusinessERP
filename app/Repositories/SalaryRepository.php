<?php

namespace App\Repositories;

use App\Models\Salary;
use App\Repositories\BaseRepository;

class SalaryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'employee_id',
        'basic_salary',
        'bonus',
        'deductions',
        'net_salary',
        'pay_date'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Salary::class;
    }
}
