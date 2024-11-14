<!-- Employee Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    {!! Form::number('employee_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Allowance Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('allowance_type', 'Allowance Type:') !!}
    {!! Form::text('allowance_type', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::text('amount', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Date Granted Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_granted', 'Date Granted:') !!}
    {!! Form::text('date_granted', null, ['class' => 'form-control','id'=>'date_granted']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_granted').datepicker()
    </script>
@endpush

<!-- Allowance Priviledge Field -->
<div class="form-group col-sm-6">
    {!! Form::label('allowance_priviledge', 'Allowance Priviledge:') !!}
    {!! Form::text('allowance_priviledge', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>