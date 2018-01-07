@if(!isset($model))
    <div class="form-group{{$errors->has('diagnosis') ? 'has error' : '' }}">
        {!! Form::label('diagnosis', 'Diagnosa', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('diagnosis', null, ['placeholder'=>'Nama Diagnosa', 'class'=>'form-control']) !!}
            {!! $errors->first('diagnosis', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{{$errors->has('diagnosisType') ? 'has error' : '' }}">
        {!! Form::label('diagnosisType', 'Tipe Diagnosa', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('diagnosisType', [''=>'']+App\DiagnosisType::pluck('name','id')->all(),
                        null, [
                        'class'=>'js-selectize form-control',
                        'placeholder'=>'Tipe Diagnosa']) !!}
            {!! $errors->first('diagnosisType', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
@endif



@if(isset($model))
    <div class="form-group{{$errors->has('diagnosis') ? 'has error' : '' }}">
        {!! Form::label('diagnosis', 'Diagnosa', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('diagnosis', $diagnosis->name, ['placeholder'=>'Nama Diagnosa', 'class'=>'form-control']) !!}
            {!! $errors->first('diagnosis', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group{{$errors->has('diagnosisType') ? 'has error' : '' }}">
        {!! Form::label('diagnosisType', 'Tipe Diagnosa', ['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::select('diagnosisType', [''=>'']+App\DiagnosisType::pluck('name','id')->all(),
                        null, [
                        'class'=>'js-selectize form-control',
                        'placeholder'=>'Tipe Diagnosa']) !!}
            {!! $errors->first('diagnosisType', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {!! Form::submit('simpan', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
@endif
