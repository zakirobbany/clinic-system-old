@if(!isset($model))

    <div class="form-group{{$errors->has('pasien_poli_id') ? 'has error' : '' }}">
        {!! Form::label('pasien_poli_id', 'ID Kunjungan', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('pasien_poli_id', $kunjungan->id, ['class'=>'form-control', 'readonly'=>'readonly']) !!}
            {!! $errors->first('pasien_poli_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{{ $errors->has('diagnoses') ? 'has eroor' : '' }}">
        {!! Form::label('diagnoses', 'Diagnosa', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('diagnoses[]', [
            'Non Spesialistik' => \App\Diagnosis::where('diagnosis_type_id', '=', 1)->pluck('name', 'id')->toArray(),
            'Spesialistik' => \App\Diagnosis::where('diagnosis_type_id', '=', 2)->pluck('name', 'id')->toArray(),
            ],
            null, ['class'=>'select2 form-control', 'multiple' => 'multiple', 'name' => 'diagnoses[]']) !!}
            {!! $errors->first('diagnoses', '<p class="help-block">:message</p>') !!}
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

    <div class="form-group{{ $errors->has('terapi') ? 'has error' : '' }}">
        {!! Form::label('terapi', 'Terapi', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('terapi', null, ['class'=>'form-control']) !!}
            {!! $errors->first('terapi', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{!! $errors->has('obat_id') ? 'has error' : ''  !!}">
        {!! Form::label('obat_id', 'Obat', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('array[0][obat_id]', [''=>'']+App\Obat::pluck('nama_obat','id')->all(),
                null, [
                'class'=>'js-selectize',
                'placeholder'=>'Pilih Obat']) !!}
            {{--{!! Form::text('obat', null, ['class'=>'form-control']) !!}--}}
            {!! $errors->first('obat_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{{$errors->has('jumlah') ? 'has error' : '' }}">
        {!! Form::label('jumlah', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-1">
            {!! Form::text('array[0][jumlah]', null, ['class'=>'form-control']) !!}
            {!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{!! $errors->has('obat_id') ? 'has error' : ''  !!}">
        {!! Form::label('obat_id', 'Obat', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('array[1][obat_id]', [''=>'']+App\Obat::pluck('nama_obat','id')->all(),
                null, [
                'class'=>'js-selectize',
                'placeholder'=>'Pilih Obat']) !!}
            {{--{!! Form::text('obat', null, ['class'=>'form-control']) !!}--}}
            {!! $errors->first('obat_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{{$errors->has('jumlah') ? 'has error' : '' }}">
        {!! Form::label('jumlah', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-1">
            {!! Form::text('array[1][jumlah]', null, ['class'=>'form-control']) !!}
            {!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{!! $errors->has('obat_id') ? 'has error' : ''  !!}">
        {!! Form::label('obat_id', 'Obat', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('array[2][obat_id]', [''=>'']+App\Obat::pluck('nama_obat','id')->all(),
                null, [
                'class'=>'js-selectize',
                'placeholder'=>'Pilih Obat']) !!}
            {{--{!! Form::text('obat', null, ['class'=>'form-control']) !!}--}}
            {!! $errors->first('obat_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{{$errors->has('jumlah') ? 'has error' : '' }}">
        {!! Form::label('jumlah', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-1">
            {!! Form::text('array[2][jumlah]', null, ['class'=>'form-control']) !!}
            {!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{!! $errors->has('obat_id') ? 'has error' : ''  !!}">
        {!! Form::label('obat_id', 'Obat', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('array[3][obat_id]', [''=>'']+App\Obat::pluck('nama_obat','id')->all(),
                null, [
                'class'=>'js-selectize',
                'placeholder'=>'Pilih Obat']) !!}
            {{--{!! Form::text('obat', null, ['class'=>'form-control']) !!}--}}
            {!! $errors->first('obat_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{{$errors->has('jumlah') ? 'has error' : '' }}">
        {!! Form::label('jumlah', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-1">
            {!! Form::text('array[3][jumlah]', null, ['class'=>'form-control']) !!}
            {!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{!! $errors->has('obat_id') ? 'has error' : ''  !!}">
        {!! Form::label('obat_id', 'Obat', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('array[4][obat_id]', [''=>'']+App\Obat::pluck('nama_obat','id')->all(),
                null, [
                'class'=>'js-selectize',
                'placeholder'=>'Pilih Obat']) !!}
            {{--{!! Form::text('obat', null, ['class'=>'form-control']) !!}--}}
            {!! $errors->first('obat_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{{$errors->has('jumlah') ? 'has error' : '' }}">
        {!! Form::label('jumlah', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-1">
            {!! Form::text('array[4][jumlah]', null, ['class'=>'form-control']) !!}
            {!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{!! $errors->has('obat_id') ? 'has error' : ''  !!}">
        {!! Form::label('obat_id', 'Obat', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('array[5][obat_id]', [''=>'']+App\Obat::pluck('nama_obat','id')->all(),
                null, [
                'class'=>'js-selectize',
                'placeholder'=>'Pilih Obat']) !!}
            {{--{!! Form::text('obat', null, ['class'=>'form-control']) !!}--}}
            {!! $errors->first('obat_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{{$errors->has('jumlah') ? 'has error' : '' }}">
        {!! Form::label('jumlah', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-1">
            {!! Form::text('array[5][jumlah]', null, ['class'=>'form-control']) !!}
            {!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{!! $errors->has('obat_id') ? 'has error' : ''  !!}">
        {!! Form::label('obat_id', 'Obat', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('array[6][obat_id]', [''=>'']+App\Obat::pluck('nama_obat','id')->all(),
                null, [
                'class'=>'js-selectize',
                'placeholder'=>'Pilih Obat']) !!}
            {{--{!! Form::text('obat', null, ['class'=>'form-control']) !!}--}}
            {!! $errors->first('obat_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{{$errors->has('jumlah') ? 'has error' : '' }}">
        {!! Form::label('jumlah', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-1">
            {!! Form::text('array[6][jumlah]', null, ['class'=>'form-control']) !!}
            {!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
@endif

@if(isset($model))

    <div class="form-group{{$errors->has('rekam_medis_id') ? 'has error' : '' }}">
        {!! Form::label('rekam_medis_id', 'ID Rekam Medis', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('rekam_medis_id', $rekam->rekam_medis_id, ['class'=>'form-control', 'readonly'=>'readonly']) !!}
            {!! $errors->first('rekam_medis_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div class="form-group{{$errors->has('diagnosa') ? 'has error' : '' }}">
        {!! Form::label('diagnosa', 'Diagnosa', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('diagnosa', null, ['class'=>'form-control']) !!}
            {!! $errors->first('diagnosa', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{{ $errors->has('terapi') ? 'has error' : '' }}">
        {!! Form::label('terapi', 'Terapi', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('terapi', null, ['class'=>'form-control']) !!}
            {!! $errors->first('terapi', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div class="form-group{!! $errors->has('obat_id') ? 'has error' : ''  !!}">
        {!! Form::label('obat_id', 'Obat', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('obat_id', [''=>'']+App\Obat::pluck('nama_obat','id')->all(),
                null, [
                'class'=>'js-selectize',
                'placeholder'=>'Pilih Obat']) !!}
            {{--{!! Form::text('obat', null, ['class'=>'form-control']) !!}--}}
            {!! $errors->first('obat_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group{{$errors->has('jumlah') ? 'has error' : '' }}">
        {!! Form::label('jumlah', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-1">
            {!! Form::text('jumlah', null, ['class'=>'form-control']) !!}
            {!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

@endif