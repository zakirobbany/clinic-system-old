@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Detail Pasien</h3>
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
                                    <td>Alamat Pasien</td>
                                    <td>No Telepon</td>
                                    <td>Umur</td>
                                    <td>Jenis Kelamin</td>
                                    <td>Riwayat Alergi</td>
                                    <td>Kategori Pasien</td>
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
                                        {{ $pasien->id }}
                                    </td>
                                    <td>
                                        {{ $pasien->nama }}
                                    </td>
                                    <td>
                                        {{ $pasien->alamat }}
                                    </td>
                                    <td>
                                        {{ $pasien->no_telepon }}
                                    <td>
                                        {{ $pasien->umur }}
                                    </td>
                                    <td>
                                        {{ $pasien->jenis_kelamin }}
                                    </td>
                                    <td>
                                        {{ $pasien->riwayat_alergi }}
                                    </td>
                                    <td>
                                        {{ $pasien->kategoriPasien->nama_kategori }}
                                    </td>
                                    <td>
                                        @role('admin')
                                            <a href="{{ route('pasien.edit', $pasien->id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            {!! Form::model($pasien, ['route'=>['pasien.destroy', $pasien], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                            {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                        @endrole
                                        @role('registrasi')
                                            <a href="{{ route('perawat-pasien.edit', $pasien->id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            {!! Form::model($pasien, ['route'=>['perawat-pasien.destroy', $pasien], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
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
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>History Rekam Medis Pasien</h3>
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
                                    @role('dokter')
                                    <td>Operasi</td>
                                    @endrole
                                </tr>
                                </thead>
                                <tbody>
                                @php($no = 1)
                                @foreach($rmHistorys as $rmHistory)
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
                                        @role('dokter')
                                        <td>
                                            <a href="{{ route('dokter-rekammedis.edit', $rmHistory->rekamMedis->id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            {!! Form::model($rmHistory, ['route'=>['dokter-rekammedis.destroy', $rmHistory->rekamMedis->id], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
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
    </div><div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>History Rujukan Pasien</h3>
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
                                    <td>Rujukan</td>
                                    <td>Keterangan</td>
                                    <td>Tanggal Rujukan</td>
                                    <td>Tanggal Kunjungan</td>
                                    <td>Operasi</td>
                                </tr>
                                </thead>
                                <tbody>
                                @php($no = 1)
                                @foreach($rHistorys as $rHistory)
                                    <tr>
                                        <td>
                                            {{ $no }}
                                        </td>
                                        <td>
                                            {{ $rHistory->pasien->id }}
                                        </td>
                                        <td>
                                            {{ $rHistory->pasien->nama }}
                                        </td>
                                        <td>
                                            {{ $rHistory->poli->nama_poli }}
                                        </td>
                                        <td>
                                        {{ $rHistory->dokter->name }}
                                        <td>
                                            {{ $rHistory->rujukan->rujukan }}
                                        </td>
                                        <td>
                                            {{ $rHistory->rujukan->keterangan }}
                                        </td>
                                        <td>
                                            {{ $rHistory->rujukan->created_at }}
                                        </td>
                                        <td>
                                            {{ $rHistory->created_at }}
                                        </td>
                                        <td>
                                            @role('registrasi')
                                            <a href="{{ route('perawat-rujukan.edit', $rmHistory->rujukan->id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            {!! Form::model($rmHistory, ['url'=>'/rujukan/'. $rmHistory->rujukan['id'] .'/delete', 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                            {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endrole
                                            @role('dokter')
                                            <a href="{{ route('dokter-rujukan.edit', $rmHistory->rujukan->id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            {!! Form::model($rmHistory, ['route'=>['dokter-rujukan.destroy', $rmHistory->rujukan->id], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                            {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endrole
                                        </td>
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