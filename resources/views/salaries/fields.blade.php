<!-- Employee Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    {!! Form::number('employee_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Basic Salary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('basic_salary', 'Basic Salary:') !!}
    {!! Form::text('basic_salary', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Bonus Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bonus', 'Bonus:') !!}
    {!! Form::text('bonus', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Deductions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deductions', 'Deductions:') !!}
    {!! Form::text('deductions', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Net Salary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('net_salary', 'Net Salary:') !!}
    {!! Form::text('net_salary', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Pay Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pay_date', 'Pay Date:') !!}
    {!! Form::text('pay_date', null, ['class' => 'form-control','id'=>'pay_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#pay_date').datepicker()
    </script>
@endpush