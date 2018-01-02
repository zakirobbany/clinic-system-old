@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Rekam Medis Pasien</h3>
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
                                    <td>ID Pasien</td>
                                    <td>Nama Pasien</td>
                                    <td>Poli</td>
                                    <td>Dokter</td>
                                    <td>Diagnosa</td>
                                    <td>Terapi</td>
                                    <td>Obat</td>
                                    <td>Tanggal Kunjungan</td>
                                </tr>
                                </thead>
                                <tbody>
                                @php($no = 1)
                                <tr>
                                    <td>
                                        {{ $no }}
                                    </td>
                                    <td>
                                        {{ $rmHistory->pasien->id }}
                                    </td>
                                    <td>
                                        {{ $rmHistory->pasien->nama }}
                                    </td>
                                    <td>
                                        {{ $rmHistory->poli->nama_poli }}
                                    </td>
                                    <td>
                                        {{ $rmHistory->dokter->name }}
                                    <td>
                                        {{ $rmHistory->rekamMedis->diagnosa }}
                                    </td>
                                    <td>
                                        {{ $rmHistory->rekamMedis->terapi }}
                                    </td>
                                    <td>
                                        {{ $rmHistory->rekamMedis->obat }}
                                    </td>
                                    <td>
                                        {{ $rmHistory->created_at }}
                                    </td>
                                    <td>
                                        @role('admin')
                                        <a href="{{ route('pasien.edit', $rmHistory->id) }}"
                                           class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                            Edit
                                        </a>
                                        {!! Form::model($rmHistory, ['route'=>['pasien.destroy', $rmHistory], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                        {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                        @endrole
                                        @role('registrasi')
                                        <a href="{{ route('perawat-pasien.edit', $rmHistory->id) }}"
                                           class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                            Edit
                                        </a>
                                        {!! Form::model($rmHistory, ['route'=>['perawat-pasien.destroy', $rmHistory], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                        {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                        {!! Form::close() !!}
                                        @endrole
                                        @role('dokter')
                                        <a href="{{ route('dokter-pasien.edit', $rmHistory->id) }}"
                                           class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                            Edit
                                        </a>
                                        {!! Form::model($rmHistory, ['route'=>['dokter-pasien.destroy', $rmHistory], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
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