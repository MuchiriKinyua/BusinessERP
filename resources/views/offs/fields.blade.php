<!-- Off Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('off_name', 'Off Name:') !!}
    {!! Form::text('off_name', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duration:') !!}
    {!! Form::text('duration', null, ['class' => 'form-control', 'maxlength' => 20, 'maxlength' => 20]) !!}
</div>

<!-- Paid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('paid', 'Paid:') !!}
    {!! Form::text('paid', null, ['class' => 'form-control', 'maxlength' => 20, 'maxlength' => 20]) !!}
</div>

<!-- Off Condition Field -->
<div class="form-group col-sm-6">
    {!! Form::label('off_condition', 'Off Condition:') !!}
    {!! Form::text('off_condition', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>