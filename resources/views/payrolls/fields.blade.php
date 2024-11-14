<!-- Employee Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    {!! Form::number('employee_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Salary Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salary_id', 'Salary Id:') !!}
    {!! Form::number('salary_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Payment Period Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_period', 'Payment Period:') !!}
    {!! Form::text('payment_period', null, ['class' => 'form-control','id'=>'payment_period']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#payment_period').datepicker()
    </script>
@endpush

<!-- Total Earnings Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_earnings', 'Total Earnings:') !!}
    {!! Form::text('total_earnings', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Total Deductions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_deductions', 'Total Deductions:') !!}
    {!! Form::text('total_deductions', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Net Pay Field -->
<div class="form-group col-sm-6">
    {!! Form::label('net_pay', 'Net Pay:') !!}
    {!! Form::text('net_pay', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Payrolls Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payrolls_status', 'Payrolls Status:') !!}
    {!! Form::text('payrolls_status', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Payslip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payslip', 'Payslip:') !!}
    {!! Form::text('payslip', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>