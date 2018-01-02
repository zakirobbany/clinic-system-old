<div class="form-group{{$errors->has('nama_poli') ? 'has error' : '' }}">
    {!! Form::label('nama_poli', 'Nama Poli', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('nama_poli', null, ['class'=>'form-control']) !!}
        {!! $errors->first('nama_poli', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-2 col-md-offset-2">
        {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
    </div>
</div>