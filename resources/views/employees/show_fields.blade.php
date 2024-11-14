<!-- First Name Field -->
<div class="col-sm-12">
    {!! Form::label('first_name', 'First Name:') !!}
    <p>{{ $employee->first_name }}</p>
</div>

<!-- Last Name Field -->
<div class="col-sm-12">
    {!! Form::label('last_name', 'Last Name:') !!}
    <p>{{ $employee->last_name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $employee->email }}</p>
</div>

<!-- Phone Number Field -->
<div class="col-sm-12">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    <p>{{ $employee->phone_number }}</p>
</div>

<!-- Physical Address Field -->
<div class="col-sm-12">
    {!! Form::label('physical_address', 'Physical Address:') !!}
    <p>{{ $employee->physical_address }}</p>
</div>

<!-- Department Field -->
<div class="col-sm-12">
    {!! Form::label('department', 'Department:') !!}
    <p>{{ $employee->department }}</p>
</div>

<!-- Hire Date Field -->
<div class="col-sm-12">
    {!! Form::label('hire_date', 'Hire Date:') !!}
    <p>{{ $employee->hire_date }}</p>
</div>

<!-- Salary Field -->
<div class="col-sm-12">
    {!! Form::label('salary', 'Salary:') !!}
    <p>{{ $employee->salary }}</p>
</div>

<!-- Disability Status Field -->
<div class="col-sm-12">
    {!! Form::label('disability_status', 'Disability Status:') !!}
    <p>{{ $employee->disability_status }}</p>
</div>

<!-- Job Basis Field -->
<div class="col-sm-12">
    {!! Form::label('job_basis', 'Job Basis:') !!}
    <p>{{ $employee->job_basis }}</p>
</div>

<!-- Emergency Contact Field -->
<div class="col-sm-12">
    {!! Form::label('emergency_contact', 'Emergency Contact:') !!}
    <p>{{ $employee->emergency_contact }}</p>
</div>

