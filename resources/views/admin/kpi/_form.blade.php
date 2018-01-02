<div class="form-group{{$errors->has('kpi') ? 'has-error' : ''}}">
    {!! Form::label('kpi', 'KPI', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('kpi', null, ['class'=>'form-control', 'readonly'=>'readonly']) !!}
        {!! $errors->first('kpi', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{$errors->has('bobot') ? 'has-error' : ''}}">
    {!! Form::label('bobot', 'Bobot', ['class'=>'col-md-2 control-label']) !!}
    <div class="col-md-5">
        {!! Form::text('bobot', null, ['class'=>'form-control']) !!}
        {!! $errors->first('kpi', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-2 col-md-offset-2">
        {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
    </div>
</div>