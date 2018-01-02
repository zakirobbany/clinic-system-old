<div class="form-group{{$errors->has('nama_spesialis') ? 'has error' : '' }}">
    {!! Form::label('nama_spesialis', 'Nama Spesialis', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('nama_spesialis', null, ['class'=>'form-control']) !!}
        {!! $errors->first('nama_spesialis', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-2 col-md-offset-2">
        {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
    </div>
</div>