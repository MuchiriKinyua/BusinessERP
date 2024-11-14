<!-- Employee Id Field -->
<div class="col-sm-12">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    <p>{{ $salary->employee_id }}</p>
</div>

<!-- Basic Salary Field -->
<div class="col-sm-12">
    {!! Form::label('basic_salary', 'Basic Salary:') !!}
    <p>{{ $salary->basic_salary }}</p>
</div>

<!-- Bonus Field -->
<div class="col-sm-12">
    {!! Form::label('bonus', 'Bonus:') !!}
    <p>{{ $salary->bonus }}</p>
</div>

<!-- Deductions Field -->
<div class="col-sm-12">
    {!! Form::label('deductions', 'Deductions:') !!}
    <p>{{ $salary->deductions }}</p>
</div>

<!-- Net Salary Field -->
<div class="col-sm-12">
    {!! Form::label('net_salary', 'Net Salary:') !!}
    <p>{{ $salary->net_salary }}</p>
</div>

<!-- Pay Date Field -->
<div class="col-sm-12">
    {!! Form::label('pay_date', 'Pay Date:') !!}
    <p>{{ $salary->pay_date }}</p>
</div>

