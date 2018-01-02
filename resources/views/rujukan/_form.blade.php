@if(!isset($model))
    <div class="form-group{{$errors->has('id') ? 'has error' : '' }}">
        {!! Form::label('id', 'ID Kunjungan', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('id', $kunjungan->id, ['class'=>'form-control', 'readonly'=>'readonly']) !!}
            {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endif

<div class="form-group{{$errors->has('rujukan') ? 'has error' : '' }}">
    {!! Form::label('rujukan', 'Rujukan', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('rujukan', null, ['placeholder'=>'Rumah saki tujuan', 'class'=>'form-control']) !!}
        {!! $errors->first('rujukan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-2 col-md-offset-2">
        {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
    </div>
</div>