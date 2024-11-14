<!-- Employee Id Field -->
<div class="col-sm-12">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    <p>{{ $documentation->employee_id }}</p>
</div>

<!-- Resume Field -->
<div class="col-sm-12">
    {!! Form::label('resume', 'Resume:') !!}
    <p>{{ $documentation->resume }}</p>
</div>

<!-- Document Type Field -->
<div class="col-sm-12">
    {!! Form::label('document_type', 'Document Type:') !!}
    <p>{{ $documentation->document_type }}</p>
</div>

<!-- Document Name Field -->
<div class="col-sm-12">
    {!! Form::label('document_name', 'Document Name:') !!}
    <p>{{ $documentation->document_name }}</p>
</div>

<!-- File Path Field -->
<div class="col-sm-12">
    {!! Form::label('file_path', 'File Path:') !!}
    <p>{{ $documentation->file_path }}</p>
</div>

