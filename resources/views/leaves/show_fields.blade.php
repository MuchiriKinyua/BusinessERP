<!-- Employee Id Field -->
<div class="col-sm-12">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    <p>{{ $leave->employee_id }}</p>
</div>

<!-- Leave Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('leave_type_id', 'Leave Type Id:') !!}
    <p>{{ $leave->leave_type_id }}</p>
</div>

<!-- Department Id Field -->
<div class="col-sm-12">
    {!! Form::label('department_id', 'Department Id:') !!}
    <p>{{ $leave->department_id }}</p>
</div>

<!-- Start Date Field -->
<div class="col-sm-12">
    {!! Form::label('start_date', 'Start Date:') !!}
    <p>{{ $leave->start_date }}</p>
</div>

<!-- End Date Field -->
<div class="col-sm-12">
    {!! Form::label('end_date', 'End Date:') !!}
    <p>{{ $leave->end_date }}</p>
</div>

<!-- Duration Field -->
<div class="col-sm-12">
    {!! Form::label('duration', 'Duration:') !!}
    <p>{{ $leave->duration }}</p>
</div>

<!-- Leave Status Field -->
<div class="col-sm-12">
    {!! Form::label('leave_status', 'Leave Status:') !!}
    <p>{{ $leave->leave_status }}</p>
</div>

