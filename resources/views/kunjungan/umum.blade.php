@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Kunjungan Umum</h3>
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
                                <p><a class="btn btn-primary" href="{{ route('kunjungan.bulanan.umum.index') }}">Kunjungan Bulan Ini</a></p>
                            </div>
                            @endrole
                            @role('dokter')
                            <div class="col-sm-12 col-md-12 col-xs-12 text-right">
                                <p><a class="btn btn-primary" href="{{ route('dokter.kunjungan.bulanan.umum.index') }}">Kunjungan Bulan Ini</a></p>
                            </div>
                            @endrole
                            @role('registrasi')
                            <div class="col-sm-12 col-md-12 col-xs-12 text-right">
                                <p><a class="btn btn-primary" href="{{ route('perawat.kunjungan.bulanan.umum.index') }}">Kunjungan Bulan Ini</a></p>
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
                                            {{ $k->keluhan }}
                                        </td>
                                        <td>
                                            {{ $k->pasien->kategoriPasien->nama_kategori }}
                                        </td>
                                        <td>
                                            {{ $k->created_at }}
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