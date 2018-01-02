@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Rekam Medis Bulan Ini</h3>
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
                                <p><a class="btn btn-primary" href="{{ route('rekammedis.index') }}">Rekam Medis Hari Ini</a></p>
                            </div>
                            @endrole
                            @role('dokter')
                            <div class="col-sm-12 col-md-12 col-xs-12 text-right">
                                <p><a class="btn btn-primary" href="{{ route('dokter-rekammedis.index') }}">Rekam Medis Hari Ini</a></p>
                            </div>
                            @endrole
                            @role('registrasi')
                            <div class="col-sm-12 col-md-12 col-xs-12 text-right">
                                <p><a class="btn btn-primary" href="{{ route('perawat-rekammedis.index') }}">Rekam Medis Hari Ini</a></p>
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
                                            {{ $rekam->rekamMedis->pasienPoli->created_at }}
                                        </td>
                                        <td>
                                            {{ $rekam->rekamMedis->pasienPoli->pasien->nama }}
                                        </td>
                                        <td>
                                            {{ $rekam->rekamMedis->pasienPoli->dokter->name }}
                                        </td>
                                        <td>
                                            {{ $rekam->rekamMedis->pasienPoli->poli->nama_poli }}
                                        <td>
                                            {{ $rekam->rekamMedis->diagnosa }}
                                        </td>
                                        <td>
                                            {{ $rekam->rekamMedis->terapi }}
                                        </td>
                                        <td>
                                            {{ $rekam->obat->nama_obat }}
                                        </td>
                                        <td>
                                            {{ $rekam->jumlah }}
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