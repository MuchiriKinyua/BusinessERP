<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    {!! Form::number('id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('employee_id', 'Employee:') !!}
    {!! Form::select('employee_id', $employees, null, ['class' => 'form-control', 'id' => 'employee_id']) !!}
</div>

<!-- Check In Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('check_in_time', 'Check In Time:') !!}
    {!! Form::text('check_in_time', null, ['class' => 'form-control','id'=>'check_in_time']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#check_in_time').datepicker()
    </script>
@endpush

<!-- Check Out Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('check_out_time', 'Check Out Time:') !!}
    {!! Form::text('check_out_time', null, ['class' => 'form-control','id'=>'check_out_time']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#check_out_time').datepicker()
    </script>
@endpush

<!-- Attendance Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attendance_date', 'Attendance Date:') !!}
    {!! Form::text('attendance_date', null, ['class' => 'form-control','id'=>'attendance_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#attendance_date').datepicker()
    </script>
@endpush

<!-- Over Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('over_time', 'Over Time:') !!}
    {!! Form::text('over_time', null, ['class' => 'form-control','id'=>'over_time']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#over_time').datepicker()
    </script>
@endpush

<!-- Under Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('under_time', 'Under Time:') !!}
    {!! Form::text('under_time', null, ['class' => 'form-control','id'=>'under_time']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#under_time').datepicker()
    </script>
@endpush