<div class="form-group{{ $errors->has('dokter_id') ? 'has error' : '' }}">
    {!! Form::label('dokter_id', 'ID Dokter', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::select('dokter_id', App\Dokter::all('id', 'name')->keyBy('id')->map(function ($n){
        return $n->name;})->toArray(), null,
        ['placeholder'=>'Pilih Dokter', 'class'=>'form-control']) !!}
        {!! $errors->first('dokter_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-2 col-md-offset-2">
        {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
    </div>
</div>