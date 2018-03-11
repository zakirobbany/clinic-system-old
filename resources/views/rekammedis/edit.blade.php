@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Ubah Rekam Medis</h2>
                        </div>
                        @role('registrasi')
                        <div class="panel-body">
                            <form action="{{ route('perawat-rekammedis.update', $medicalRecord->id) }}" class="form-horizontal" method="post">
                                {{ csrf_field() }}

                                <div class="form-group {{ $errors->has('pasien_poli_id') ? 'has error' : '' }}">
                                    <label for="pasien_poli_id" class="col-md-2 control-label">ID Kunjungan</label>
                                    <div class="col-md-5">
                                        <input type="text" name="pasien_poli_id" value="{{ $visit->id }}"
                                               class="form-control" readonly>
                                        @if ($errors->has('pasien_poli_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pasien_poli_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('dokter_id') ? 'has-error' : '' }}" >
                                    <label for="dokter_id" class="control-label col-md-2">Dokter</label>
                                    <div class="col-md-5">
                                        <select name="dokter_id" class="form-control select2_group">
                                            <optgroup label="Umum">
                                                @foreach($dokters as $dokter)
                                                    <option class="form-control" value="{{ $dokter->id }}"
                                                            @if($visit->dokter_id == $dokter->id) selected @endif>{{ $dokter->name }}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Gigi">
                                                @foreach($dentists as $dentist)
                                                    <option class="form-control" value="{{ $dentist->id }}
                                                    @if($visit->dokter_id == $dokter->id) selected @endif">{{ $dentist->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('terapi') ? 'has-error' : '' }}">
                                    <label for="terapi" class="col-md-2 control-label">Terapi</label>
                                    <div class="col-md-5">
                                        <input type="text" name="terapi" class="form-control" value="{{ $medicalRecord->terapi }}"/>
                                    </div>
                                </div>

                                @foreach($medicalRecord->diagnoses as $d)
                                    <div class="form-group {{ $errors->has('diagnoses') ? 'has-error' : '' }}">
                                        <label for="diagnoses" class="col-md-2 control-label">Diagnosa</label>
                                        <div class="col-md-5">
                                            <select name="diagnoses[]" class="form-control js-selectize">
                                                @foreach($diagnoses as $diagnosis)
                                                    <option value="{{ $diagnosis->id }}" @if ($d->diagnosis->id == $diagnosis->id) selected @endif>
                                                        {{ $diagnosis->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endforeach

                                <div id="additional-diagnosis"></div>
                                <div class="col-md-2"></div>
                                <div class="action-buttons col-md-3">
                                    <button id="add-diagnosis" type="button" class="btn btn-block btn-default"><i class="fa fa-plus"></i> Tambah
                                        Diagnosis
                                    </button>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach($medicalRecord->obat as $m)
                                            <div class="form-group {{ $errors->has('obat_id') ? 'has-error' : '' }}">
                                                <label for="obat_id" class="control-label col-md-2">Obat</label>
                                                <div class="col-md-5">
                                                    <select name="obat_id[]" class="form-control js-selectize">
                                                        @foreach($medicines as $medicine)
                                                            <option class="form-control" value="{{ $medicine->id }}"
                                                            @if($m->obat->id == $medicine->id) selected @endif>{{ $medicine->nama_obat }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('jumlah') ? 'has-error' : '' }}">
                                                <label for="jumlah" class="control-label col-md-2">Jumlah</label>
                                                <div class="col-md-1">
                                                    <input type="text" name="jumlah[]" value="{{ $m->jumlah }}" class="form-control">
                                                </div>
                                            </div>
                                        @endforeach
                                        <div id="additional-medicine"></div>
                                        <div class="col-md-2"></div>
                                        <div class="action-buttons col-md-3">
                                            <button id="add-medicine" type="button" class="btn btn-block btn-default"><i class="fa fa-plus"></i> Tambah
                                                Obat
                                            </button>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-action col-md-12">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </div>
                            </form>
                            {{--@role('dokter')
                                {!! Form::open(['url' => '/dokter/rekammedis/'.$visit->id, 'method' => 'post', 'class'=>'form-horizontal']) !!}
                                @include('rekammedis._form')
                                {!! Form::close() !!}
                            @endrole--}}
                            {{--@role('registrasi')
                            {!! Form::open(['url' => '/perawat/perawat-rekammedis/'.$visit->id, 'method' => 'post', 'class'=>'form-horizontal']) !!}
                            @include('rekammedis._form')
                            {!! Form::close() !!}
                            @endrole--}}
                        </div>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var i = 0;
        $('#add-medicine').click(function () {
            i++;
            // var description = $("#description").val();
            $('#additional-medicine').append(
                '<div class="form-group">' +
                '<label for="obat_id" class="control-label col-md-2">Obat</label>' +
                '<div class="col-md-5">' +
                '<select name="obat_id[]" class="form-control js-selectize">' +
                '@foreach($medicines as $obat)' +
                '<option value="{{ $obat->id }}" @if (old('obat_id') == $obat->id) selected @endif>{{ $obat->nama_obat }}</option>' +
                '@endforeach' +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="jumlah" class="control-label col-md-2">Jumlah</label>' +
                '<div class="col-md-1">' +
                '<input type="text" name="jumlah[]" class="form-control" value=""/>' +
                '</div>' +
                '</div>'
            );
        });
        $('#add-diagnosis').click(function () {
            i++;
            $('#additional-diagnosis').append(
                '<div class="form-group">' +
                '<label for="diagnoses" class="col-md-2 control-label">Diagnosa</label>' +
                '<div class="col-md-5">' +
                '<select name="diagnoses[]" class="form-control js-selectize">' +
                '@foreach($diagnoses as $diagnosis)' +
                '<option value="{{ $diagnosis->id }}" @if (old('diagnoses[]') == $diagnosis->id) selected @endif>{{ $diagnosis->name }}</option>' +
                '@endforeach' +
                '</div>' +
                '</div>'
            );
        })
    </script>
@endsection