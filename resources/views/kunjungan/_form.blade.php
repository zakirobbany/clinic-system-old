<div class="form-group{{$errors->has('pasien_id') ? 'has-error' : '' }}">
    {!! Form::label('pasien_id', 'ID Pasien', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::select('pasien_id', [''=>'']+App\Pasien::pluck('nama','id')->all(),
            null, [
            'class'=>'js-selectize form-control',
            'placeholder'=>'Pilih Pasien']) !!}
        {!! $errors->first('pasien_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{$errors->has('poli_id') ? 'has-error' : '' }}">
    {!! Form::label('poli_id', 'Poli', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::select('poli_id', App\Poli::all('id', 'nama_poli')->keyBy('id')->map(function ($n){
        return $n->nama_poli;})->toArray() , null,
         ['placeholder'=>'Pilih Poli Tujuan', 'class'=>'form-control']) !!}
        {!! $errors->first('poli_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('dokter_id') ? 'has-error' : '' }}">
    {!! Form::label('dokter_id', 'Dokter', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::select('dokter_id',[
            'Umum' => App\Dokter::where('spesialis_id', '=', 1)->pluck('name', 'id')->toArray(),
            'Gigi' => App\Dokter::where('spesialis_id', '=', 2)->pluck('name', 'id')->toArray()],
        null, ['class'=>'select2_single form-control', 'placeholder'=>'Pilih Dokter']) !!}
        {!! $errors->first('dokter_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('keluhan') ? 'has-error' : '' }}">
    {!! Form::label('keluhan', 'Keluhan', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::textArea('keluhan', null, ['class'=>'form-control']) !!}
        {!! $errors->first('keluhan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-2 col-md-offset-2">
        {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
    </div>
</div>