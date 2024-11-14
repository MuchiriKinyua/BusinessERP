<!-- Employee Id Field -->
<div class="col-sm-12">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    <p>{{ $promotion->employee_id }}</p>
</div>

<!-- Previous Position Field -->
<div class="col-sm-12">
    {!! Form::label('previous_position', 'Previous Position:') !!}
    <p>{{ $promotion->previous_position }}</p>
</div>

<!-- New Position Field -->
<div class="col-sm-12">
    {!! Form::label('new_position', 'New Position:') !!}
    <p>{{ $promotion->new_position }}</p>
</div>

<!-- Promotion Date Field -->
<div class="col-sm-12">
    {!! Form::label('promotion_date', 'Promotion Date:') !!}
    <p>{{ $promotion->promotion_date }}</p>
</div>

<!-- Previous Salary Field -->
<div class="col-sm-12">
    {!! Form::label('previous_salary', 'Previous Salary:') !!}
    <p>{{ $promotion->previous_salary }}</p>
</div>

<!-- New Salary Field -->
<div class="col-sm-12">
    {!! Form::label('new_salary', 'New Salary:') !!}
    <p>{{ $promotion->new_salary }}</p>
</div>

<!-- Reason Field -->
<div class="col-sm-12">
    {!! Form::label('reason', 'Reason:') !!}
    <p>{{ $promotion->reason }}</p>
</div>

<!-- Approved By Field -->
<div class="col-sm-12">
    {!! Form::label('approved_by', 'Approved By:') !!}
    <p>{{ $promotion->approved_by }}</p>
</div>

