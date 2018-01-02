@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Detail Kunjungan</h3>
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
                            <div class="clearfix"></div>
                            <table id="dataTable" class="table table-striped table-bordered">
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
                                    <td>Operasi</td>
                                </tr>
                                </thead>
                                <tbody>
                                @php($no = 1)
                                    <tr>
                                        <td>
                                            {{ $no }}
                                        </td>
                                        <td>
                                            {{ $kunjungan->pasienPoli->created_at }}
                                        </td>
                                        <td>
                                            {{ $kunjungan->pasienPoli->pasien->nama }}
                                        </td>
                                        <td>
                                            {{ $kunjungan->pasienPoli->dokter->name }}
                                        </td>
                                        <td>
                                            {{ $kunjungan->pasienPoli->poli->nama_poli }}
                                        <td>
                                            {{ $kunjungan->diagnosa }}
                                        </td>
                                        <td>
                                            {{ $kunjungan->terapi }}
                                        </td>
                                        <td>
                                            {{ $kunjungan->obat }}
                                        </td>
                                        <td>
                                            @role('dokter')
                                                <a href="{{ route('dokter-pasien.show', $kunjungan->pasienPoli->pasien_id) }}"
                                                   class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                    Detail Pasien
                                                </a>
                                                <a href="{{ route('dokter-rekammedis.edit', $kunjungan->id) }}"
                                                   class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                    Edit
                                                </a>
                                                {!! Form::model($kunjungan, ['route'=>['dokter-rekammedis.destroy', $kunjungan], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                                {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                                {!! Form::close() !!}
                                            @endrole

                                            @role('registrasi')
                                            <a href="{{ route('perawat-pasien.show', $kunjungan->pasienPoli->pasien_id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Detail Pasien
                                            </a>
                                            <a href="{{ route('perawat-rekammedis.edit', $kunjungan->id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            {!! Form::model($kunjungan, ['route'=>['perawat-rekammedis.destroy', $kunjungan], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                            {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endrole

                                        </td>
                                    </tr>
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