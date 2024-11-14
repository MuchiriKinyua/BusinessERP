<!-- Employee Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    {!! Form::number('employee_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Deduction Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deduction_type', 'Deduction Type:') !!}
    {!! Form::text('deduction_type', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Applied Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_applied', 'Date Applied:') !!}
    {!! Form::text('date_applied', null, ['class' => 'form-control','id'=>'date_applied']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_applied').datepicker()
    </script>
@endpush