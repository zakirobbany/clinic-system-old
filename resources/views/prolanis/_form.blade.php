<div class="form-group{{ $errors->has('pasien_id') ? 'has error' : '' }}">
    {!! Form::label('pasien_id', 'ID Pasien', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('pasien_id', null, ['class'=>'form-control']) !!}
        {!! $errors->first('pasien_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-2 col-md-offset-2">
        {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
    </div>
</div>