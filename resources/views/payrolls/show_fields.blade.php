<!-- Employee Id Field -->
<div class="col-sm-12">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    <p>{{ $payroll->employee_id }}</p>
</div>

<!-- Salary Id Field -->
<div class="col-sm-12">
    {!! Form::label('salary_id', 'Salary Id:') !!}
    <p>{{ $payroll->salary_id }}</p>
</div>

<!-- Payment Period Field -->
<div class="col-sm-12">
    {!! Form::label('payment_period', 'Payment Period:') !!}
    <p>{{ $payroll->payment_period }}</p>
</div>

<!-- Total Earnings Field -->
<div class="col-sm-12">
    {!! Form::label('total_earnings', 'Total Earnings:') !!}
    <p>{{ $payroll->total_earnings }}</p>
</div>

<!-- Total Deductions Field -->
<div class="col-sm-12">
    {!! Form::label('total_deductions', 'Total Deductions:') !!}
    <p>{{ $payroll->total_deductions }}</p>
</div>

<!-- Net Pay Field -->
<div class="col-sm-12">
    {!! Form::label('net_pay', 'Net Pay:') !!}
    <p>{{ $payroll->net_pay }}</p>
</div>

<!-- Payrolls Status Field -->
<div class="col-sm-12">
    {!! Form::label('payrolls_status', 'Payrolls Status:') !!}
    <p>{{ $payroll->payrolls_status }}</p>
</div>

<!-- Payslip Field -->
<div class="col-sm-12">
    {!! Form::label('payslip', 'Payslip:') !!}
    <p>{{ $payroll->payslip }}</p>
</div>

