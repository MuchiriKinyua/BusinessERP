<!-- Employee Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    {!! Form::number('employee_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Previous Position Field -->
<div class="form-group col-sm-6">
    {!! Form::label('previous_position', 'Previous Position:') !!}
    {!! Form::text('previous_position', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- New Position Field -->
<div class="form-group col-sm-6">
    {!! Form::label('new_position', 'New Position:') !!}
    {!! Form::text('new_position', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Promotion Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('promotion_date', 'Promotion Date:') !!}
    {!! Form::text('promotion_date', null, ['class' => 'form-control','id'=>'promotion_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#promotion_date').datepicker()
    </script>
@endpush

<!-- Previous Salary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('previous_salary', 'Previous Salary:') !!}
    {!! Form::text('previous_salary', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- New Salary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('new_salary', 'New Salary:') !!}
    {!! Form::text('new_salary', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Reason Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reason', 'Reason:') !!}
    {!! Form::text('reason', null, ['class' => 'form-control', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Approved By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('approved_by', 'Approved By:') !!}
    {!! Form::text('approved_by', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>