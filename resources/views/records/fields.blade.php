<!-- Employee Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    {!! Form::number('employee_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Record Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('record_type', 'Record Type:') !!}
    {!! Form::text('record_type', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Record Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('record_date', 'Record Date:') !!}
    {!! Form::text('record_date', null, ['class' => 'form-control','id'=>'record_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#record_date').datepicker()
    </script>
@endpush

<!-- Record Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('record_description', 'Record Description:') !!}
    {!! Form::text('record_description', null, ['class' => 'form-control', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Outcome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('outcome', 'Outcome:') !!}
    {!! Form::text('outcome', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Comments Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comments', 'Comments:') !!}
    {!! Form::text('comments', null, ['class' => 'form-control', 'maxlength' => 200, 'maxlength' => 200]) !!}
</div>

<!-- Handled By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('handled_by', 'Handled By:') !!}
    {!! Form::text('handled_by', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>