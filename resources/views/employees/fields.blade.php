<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    {!! Form::number('phone_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Physical Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('physical_address', 'Physical Address:') !!}
    {!! Form::text('physical_address', null, ['class' => 'form-control', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Department Field -->
<div class="form-group col-sm-6">
    {!! Form::label('department', 'Department:') !!}
    {!! Form::text('department', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Hire Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hire_date', 'Hire Date:') !!}
    {!! Form::text('hire_date', null, ['class' => 'form-control','id'=>'hire_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#hire_date').datepicker()
    </script>
@endpush

<!-- Salary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salary', 'Salary:') !!}
    {!! Form::text('salary', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Disability Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('disability_status', 'Disability Status:') !!}
    {!! Form::text('disability_status', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Job Basis Field -->
<div class="form-group col-sm-6">
    {!! Form::label('job_basis', 'Job Basis:') !!}
    {!! Form::text('job_basis', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Emergency Contact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('emergency_contact', 'Emergency Contact:') !!}
    {!! Form::text('emergency_contact', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Stored Face Image Path Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stored_face_image_path', 'Stored Face Image Path:') !!}
    {!! Form::text('stored_face_image_path', null, ['class' => 'form-control', 'required', 'maxlength' => 250, 'maxlength' => 250]) !!}
</div>