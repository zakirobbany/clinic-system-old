<div class="form-group{{$errors->has('nama_obat') ? 'has error' : '' }}">
    {!! Form::label('nama_obat', 'Nama Obat', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('nama_obat', null, ['class'=>'form-control']) !!}
        {!! $errors->first('nama_obat', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{$errors->has('harga') ? 'has error' : '' }}">
    {!! Form::label('harga', 'Harga Obat', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('harga', null, ['class'=>'form-control']) !!}
        {!! $errors->first('harga', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-2 col-md-offset-2">
        {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
    </div>
</div>