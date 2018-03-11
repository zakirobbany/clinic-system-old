@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Rekam Medis</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            @role('admin')
                            <div class="col-sm-12 col-md-12 col-xs-12 text-right">
                                <p><a class="btn btn-primary" href="{{ route('rekammedis.bulanan.index') }}">Rekam Medis Bulan Ini</a></p>
                            </div>
                            @endrole
                            @role('dokter')
                            <div class="col-sm-12 col-md-12 col-xs-12 text-right">
                                <p><a class="btn btn-primary" href="{{ route('dokter.rekammedis.bulanan.index') }}">Rekam Medis Bulan Ini</a></p>
                            </div>
                            @endrole
                            @role('registrasi')
                            <div class="col-sm-12 col-md-12 col-xs-12 text-right">
                                <p><a class="btn btn-primary" href="{{ route('perawat.rekammedis.bulanan.index') }}">Rekam Medis Bulan Ini</a></p>
                            </div>
                            @endrole
                            <div class="clearfix"></div>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Tanggal Kunjungan</td>
                                    <td>Nama Pasien</td>
                                    <td>Nama Dokter</td>
                                    <td>Poli</td>
                                    <td>Diagnosa</td>
                                    <td>Terapi</td>
                                    <td>Obat</td>
                                    <td>Jumlah</td>
                                    @role('dokter')
                                    <td>Operasi</td>
                                    @endrole
                                    @role('registrasi')
                                    <td>Operasi</td>
                                    @endrole
                                </tr>
                                </thead>
                                <tbody>
                                @php($no = 1)
                                @foreach($rekams as $rekam)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $rekam->pasienPoli->created_at }}
                                        </td>
                                        <td>
                                            {{ $rekam->pasienPoli->pasien->nama }}
                                        </td>
                                        <td>
                                            {{ $rekam->pasienPoli->dokter->name }}
                                        </td>
                                        <td>
                                            {{ $rekam->pasienPoli->poli->nama_poli }}
                                        <td>
                                            @foreach($rekam->diagnoses_attribute as $diagnosis)
                                                {{ $diagnosis->name }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $rekam->terapi }}
                                        </td>
                                        <td>
                                            @foreach($rekam->medicine_attribute as $medicine)
                                                {{ $medicine->nama_obat }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($rekam->total_medicine_attribute as $total)
                                                {{ $total->jumlah }}<br>
                                            @endforeach
                                        </td>
                                        @role('dokter')
                                        <td>
                                            <a href="{{ route('dokter-rekammedis.edit', $rekam->id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            {!! Form::model($rekam, ['route'=>['dokter-rekammedis.destroy', $rekam], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                            {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}

                                        </td>
                                        @endrole
                                        @role('registrasi')
                                        <td>
                                            <a href="{{ route('perawat-rekammedis.edit', $rekam->id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            {!! Form::model($rekam, ['route'=>['perawat.rekammedis.destroy', $rekam], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                            {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}

                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-xs-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection