@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Kunjungan Prolanis</h3>
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
                            @role('registrasi')
                            <div class="col-sm-4 col-md-4 col-xs-4 text-left">
                                <p><a class="btn btn-primary" href="{{ route('perawat-kunjunganPoli.create') }}">Tambah Kunjungan</a></p>
                            </div>
                            @endrole
                            @role('admin')
                            <div class="col-sm-12 col-md-12 col-xs-12 text-right">
                                <p><a class="btn btn-primary" href="{{ route('kunjungan.bulanan.prolanis.index') }}">Kunjungan Bulan Ini</a></p>
                            </div>
                            @endrole
                            @role('dokter')
                            <div class="col-sm-12 col-md-12 col-xs-12 text-right">
                                <p><a class="btn btn-primary" href="{{ route('dokter.kunjungan.bulanan.prolanis.index') }}">Kunjungan Bulan Ini</a></p>
                            </div>
                            @endrole
                            @role('registrasi')
                            <div class="col-sm-8 col-md-8 col-xs-8 text-right">
                                <p><a class="btn btn-primary" href="{{ route('perawat.kunjungan.bulanan.prolanis.index') }}">Kunjungan Bulan Ini</a></p>
                            </div>
                            @endrole
                            <div class="clearfix"></div>
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>No</td>
                                    <td>ID Pasien</td>
                                    <td>Nama Pasien</td>
                                    <td>Poli</td>
                                    <td>Umur</td>
                                    <td>Dokter</td>
                                    <td>Keluhan</td>
                                    <td>Kategori Pasien</td>
                                    <td>Tanggal Kunjungan</td>
                                    <td>Detail</td>
                                    <td>Operasi</td>
                                </tr>
                                </thead>
                                <tbody>
                                @php($no = 1)
                                @foreach($kunjungan as $k)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $k->pasien_id }}
                                        </td>
                                        <td>
                                            {{ $k->pasien->nama }}
                                        </td>
                                        <td>
                                            {{ $k->poli->nama_poli }}
                                        </td>
                                        <td>
                                            {{ $k->pasien->umur }}
                                        </td>
                                        <td>
                                            {{ $k->dokter->name }}
                                        </td>
                                        <td>
                                            {{ $k->pasien->kategoriPasien->nama_kategori }}
                                        </td>
                                        <td>
                                            {{ $k->created_at }}
                                        </td>
                                        <td>
                                            @if(isset($k->rekamMedis->pasien_poli_id))
                                                <a href="{{ route('kunjunganPoli.show', $k->id ) }}"
                                                   class="btn btn-xs btn-success"><i class="fa fa-file-text-o"></i>
                                                    Rekam Medis
                                                </a>
                                            @endif
                                            @if(isset($k->rujukan->pasien_poli_id))
                                                <a href="{{ route('kunjungan.kunjunganRujukan', $k->id ) }}"
                                                   class="btn btn-xs btn-success"><i class="fa fa-file-text-o"></i>
                                                    Rujukan
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('kunjunganPoli.show', $k->id ) }}"
                                               class="btn btn-xs btn-success"><i class="fa fa-file-text-o"></i>
                                                Detail
                                            </a>
                                            <a href="{{ route('kunjunganPoli.edit', $k->id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            @role('dokter')
                                            @if(!$k->rekamMedis['pasien_poli_id'] == $k->id)
                                                <a href="{{ route('rekammedis.create', $k->id) }}"
                                                   class="btn btn-xs btn-warning"><i class="fa fa-file-text-o"></i>
                                                    Rekam Medis
                                                </a>
                                            @endif
                                            <a href="{{ route('rujukan.create', $k->id) }}"
                                               class="btn btn-xs btn-warning"><i class="fa fa-building-o"></i>
                                                Rujuk
                                            </a>
                                            @endrole
                                            @role('admin')
                                            @if(!$k->rekamMedis['pasien_poli_id'] == $k->id)
                                                <a href="{{ route('rekammedis.create', $k->id) }}"
                                                   class="btn btn-xs btn-warning"><i class="fa fa-file-text-o"></i>
                                                    Rekam Medis
                                                </a>
                                            @endif
                                            <a href="{{ route('rujukan.create', $k->id) }}"
                                               class="btn btn-xs btn-warning"><i class="fa fa-building-o"></i>
                                                Rujuk
                                            </a>
                                            @endrole
                                            {!! Form::model($k, ['route'=>['kunjunganPoli.destroy', $k], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                            {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
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