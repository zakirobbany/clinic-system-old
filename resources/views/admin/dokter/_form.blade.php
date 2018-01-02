<div class="form-group{{$errors->has('name') ? 'has error' : '' }}">
    {!! Form::label('name', 'Nama Lengkap', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Hasan Badri']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{$errors->has('display_name') ? 'has error' : '' }}">
    {!! Form::label('display_name', 'Nama Pengguna', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('display_name', null, ['class'=>'form-control', 'placeholder'=>'Hasan']) !!}
        {!! $errors->first('display_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('alamat') ? 'has error' : '' }}">
    {!! Form::label('alamat', 'Alamat', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('alamat', null, ['class'=>'form-control', 'placeholder'=>'Rt6 Rw 12 Karangasem Condongcatur Depok Sleman']) !!}
        {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('tanggal_lahir') ? 'has error' : '' }}">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('tanggal_lahir', null, ['class' => 'form-control', 'placeholder'=>'03-05-1970']) !!}
        {!! $errors->first('tanggal_lahir', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('no_telepon') ? 'has error' : '' }}">
    {!! Form::label('no_telepon', 'No Telepon', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('no_telepon', null, ['class'=>'form-control', 'placeholder'=>'088789456123 (12 digit)']) !!}
        {!! $errors->first('no_telepon', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('spesialis_id') ? 'has-error' : '' }}">
    {!! Form::label('spesialis_id', 'Spesialis', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::select('spesialis_id', \App\Spesialis::all('nama_spesialis', 'id')
        ->keyBy('id')
        ->map(function ($s){
        return $s->nama_spesialis;})->toArray(), null, ['class'=>'form-control', 'placholder'=>'Pilih Spesialis'] ) !!}
        {!! $errors->first('spesialis_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@role('admin')
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', 'Alamat Email', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'hasan@gmail.com']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {!! Form::label('password', 'Password', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::password('password', ['class'=>'form-control']) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{$errors->has('password_confirmation') ? 'has-error' : ''}}">
    {!! Form::label('password_confirmation', 'Konfirmasi Password', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@endrole

<div class="form-group">
    <div class="col-md-2 col-md-offset-2">
        {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
    </div>
</div>