<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $attendance->id }}</p>
</div>

<!-- Employee Id Field -->
<div class="col-sm-12">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    <p>{{ $attendance->employee_id }}</p>
</div>

<!-- Check In Time Field -->
<div class="col-sm-12">
    {!! Form::label('check_in_time', 'Check In Time:') !!}
    <p>{{ $attendance->check_in_time }}</p>
</div>

<!-- Check Out Time Field -->
<div class="col-sm-12">
    {!! Form::label('check_out_time', 'Check Out Time:') !!}
    <p>{{ $attendance->check_out_time }}</p>
</div>

<!-- Attendance Date Field -->
<div class="col-sm-12">
    {!! Form::label('attendance_date', 'Attendance Date:') !!}
    <p>{{ $attendance->attendance_date }}</p>
</div>

<!-- Over Time Field -->
<div class="col-sm-12">
    {!! Form::label('over_time', 'Over Time:') !!}
    <p>{{ $attendance->over_time }}</p>
</div>

<!-- Under Time Field -->
<div class="col-sm-12">
    {!! Form::label('under_time', 'Under Time:') !!}
    <p>{{ $attendance->under_time }}</p>
</div>