<?php

namespace App\Repositories;

use App\Models\Payroll;
use App\Repositories\BaseRepository;

class PayrollRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'employee_id',
        'salary_id',
        'payment_period',
        'total_earnings',
        'total_deductions',
        'net_pay',
        'payrolls_status',
        'payslip'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Payroll::class;
    }
}
