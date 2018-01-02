<div class="form-group{{$errors->has('name') ? 'has error' : '' }}">
    {!! Form::label('name', 'Nama', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('alamat') ? 'has error' : '' }}">
    {!! Form::label('alamat', 'Alamat', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('alamat', null, ['class'=>'form-control']) !!}
        {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('tanggal_lahir', null, ['class' => 'form-control', 'data-mask' => '99-99-9999']) !!}
        {!! $errors->first('tanggal_lahir', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('no_telepon') ? 'has error' : '' }}">
    {!! Form::label('no_telepon', 'No Telepon', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('no_telepon', null, ['class'=>'form-control']) !!}
        {!! $errors->first('no_telepon', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', 'Alamat Email', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::email('email', null, ['class'=>'form-control']) !!}
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

<div class="form-group">
    <div class="col-md-2 col-md-offset-2">
        {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
    </div>
</div>