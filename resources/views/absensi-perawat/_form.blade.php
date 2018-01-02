<div class="form-group{{ $errors->has('registrasi_id') ? 'has error' : '' }}">
    {!! Form::label('registrasi_id', 'Perawat', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::select('registrasi_id', App\Registrasi::all('id', 'name')->keyBy('id')->map(function ($n){
        return $n->name;})->toArray(), null,
        ['placeholder'=>'Pilih Perawat', 'class'=>'form-control']) !!}
        {!! $errors->first('registrasi_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-2 col-md-offset-2">
        {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
    </div>
</div>