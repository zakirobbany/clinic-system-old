<div class="form-group{{$errors->has('id') ? 'has error' : '' }}">
    {!! Form::label('id', 'ID', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('id', null, ['class'=>'form-control', 'placeholder'=>'Masukkan ID BPJS']) !!}
        {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{$errors->has('nama') ? 'has error' : '' }}">
    {!! Form::label('nama', 'Nama', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('nama', null, ['class'=>'form-control', 'placeholder'=>'Masukkan Nama Pasien']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('alamat') ? 'has error' : '' }}">
    {!! Form::label('alamat', 'Alamat', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::textarea('alamat', null, ['class'=>'form-control', 'placeholder'=>'Masukkan Alamat Pasien']) !!}
        {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('no_telepon') ? 'has error' : '' }}">
    {!! Form::label('no_telepon', 'No Telepon', ['class' => 'col-md-2 control-label', 'placeholder'=>'Masukkan No Telepon Pasien']) !!}
    <div class="col-md-5">
        {!! Form::text('no_telepon', null, ['class'=>'form-control']) !!}
        {!! $errors->first('no_telepon', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('umur') ? ' has-error' : '' }}">
    {!! Form::label('umur', 'Umur', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('umur', null, ['class'=>'form-control', 'placeholder'=>'Masukkan Umur Pasien']) !!}
        {!! $errors->first('umur', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
    {!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class'=>'col-sm-2 control-label', 'style' => 'margin-top:-8px;']) !!}
    <div class="col-sm-5">
        <div class="inline">
            {!! Form::radio('jenis_kelamin', 'Pria') !!}
            {!! Form::label('jenis_kelamin', 'Pria') !!}
        </div>
        <div class="inline">
            {!! Form::radio('jenis_kelamin', 'Wanita') !!}
            {!! Form::label('jenis_kelamin', 'Wanita') !!}
        </div>

        {!! $errors->first('jenis_kelamin', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('riwayat_alergi') ? ' has-error' : '' }}">
    {!! Form::label('riwayat_alergi', 'Riwayat Alergi', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('riwayat_alergi', '-', ['class'=>'form-control', 'placeholder'=>'Masukkan Riwayat Alergi Pasien']) !!}
        {!! $errors->first('riwayat_alergi', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('id_kategori') ? ' has-error ' : '' }}">
    {!! Form::label('id_kategori', 'Kategori Pasien', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::select('id_kategori',  App\KategoriPasien::all('id_kategori', 'nama_kategori')
        ->keyBy('id_kategori')->map(function ($n){
        return $n->nama_kategori;})->toArray(), null,
         ['placeholder'=>'Pliih kategori pasien', 'class'=>'form-control']) !!}
        {!! $errors->first('id_kategori', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-2 col-md-offset-2">
        {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
    </div>
</div>