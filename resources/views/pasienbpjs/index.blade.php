@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Pasien BPJS</h3>
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
                            <div class="col-sm-4 col-md-4 col-xs-4 text-left">
                                <p><a class="btn btn-primary" href="{{ route('pasienbpjs.create') }}">Tambah Pasien</a></p>
                            </div>
                            <div class="col-sm-8 col-md-8 col-xs-8 text-right">
                                <p><a class="btn btn-primary" href="{{ route('admin.export.pasienbpjs') }}">Download</a></p>
                            </div>
                            @endrole
                            @role('registrasi')
                            <div class="col-sm-4 col-md-4 col-xs-4 text-left">
                                <p><a class="btn btn-primary" href="{{ route('perawat-pasienbpjs.create') }}">Tambah Pasien</a></p>
                            </div><div class="col-sm-8 col-md-8 col-xs-8 text-right">
                                <p><a class="btn btn-primary" href="{{ route('perawat.export.pasienbpjs') }}">Download</a></p>
                            </div>
                            @endrole
                            <form action="">
                                <div class="row">
                                    <div class="col-sm-4" style="margin-left: 10px">
                                        <div class="input-group">
                                            <div class="input-group-addon">Nama</div>
                                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama"
                                                   value="{{ request('nama') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4" style="margin-left: 10px">
                                        <div class="input-group">
                                            <div class="input-group-addon">Nama</div>
                                            <input type="text" name="id" id="id" class="form-control" placeholder="ID"
                                                   value="{{ request('id') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3" style="float: right">
                                        <button class="btn btn-primary btn-block">Search</button>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Nama Pasien</td>
                                    <td>Alamat</td>
                                    <td>No Telepon</td>
                                    <td>Umur</td>
                                    <td>Jenis Kelamin</td>
                                    <td>Riwayat Alergi</td>
                                    <td>Kategori Pasien</td>
                                    @role('admin')
                                    <td>Operasi</td>
                                    @endrole
                                    @role('registrasi')
                                    <td>Operasi</td>
                                    @endrole
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pasiens as $pasien)
                                    <tr>
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
                                        </td>
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
                                        @role('admin')
                                        <td>
                                            <a href="{{ route('pasienbpjs.show', $pasien->id) }}"
                                               class="btn btn-xs btn-success"><i class="fa fa-file-text-o"></i>
                                                Detail
                                            </a>
                                            <a href="{{ route('pasienbpjs.edit', $pasien->id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            {!! Form::model($pasien, ['route'=>['pasienbpjs.destroy', $pasien], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                            {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endrole
                                        @role('registrasi')
                                        <td>
                                            <a href="{{ route('perawat-pasienbpjs.show', $pasien->id) }}"
                                               class="btn btn-xs btn-success"><i class="fa fa-file-text-o"></i>
                                                Detail
                                            </a>
                                            <a href="{{ route('perawat-pasienbpjs.edit', $pasien->id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            {!! Form::model($pasien, ['route'=>['perawat.pasienbpjs.destroy', $pasien], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                            {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="paginator text-center">
                                {{ $pasiens->links() }}
                            </div>
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