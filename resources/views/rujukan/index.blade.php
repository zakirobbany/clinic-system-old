@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Rujukan</h3>
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
                                <p><a class="btn btn-primary" href="{{ route('rujukan.bulanan.index') }}">Rujukan Bulan Ini</a></p>
                            </div>
                            @endrole
                            @role('dokter')
                            <div class="col-sm-12 col-md-12 col-xs-12 text-right">
                                <p><a class="btn btn-primary" href="{{ route('dokter.rujukan.bulanan.index') }}">Rujukan Bulan Ini</a></p>
                            </div>
                            @endrole
                            @role('registrasi')
                            <div class="col-sm-12 col-md-12 col-xs-12 text-right">
                                <p><a class="btn btn-primary" href="{{ route('perawat.rujukan.bulanan.index') }}">Rujukan Bulan Ini</a></p>
                            </div>
                            @endrole
                            <div class="clearfix"></div>
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama Pasien</td>
                                    <td>Nama Dokter</td>
                                    <td>Poli</td>
                                    <td>Tujuan</td>
                                    <td>Diagnosa</td>
                                    <td>Tanggal</td>
                                    <td>Operasi</td>
                                </tr>
                                </thead>
                                <tbody>
                                @php($no = 1)
                                @foreach($rujukans as $rujukan)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $rujukan->pasienPoli->pasien->nama }}
                                        </td>
                                        <td>
                                            {{ $rujukan->pasienPoli->dokter->name }}
                                        </td>
                                        <td>
                                            {{ $rujukan->pasienPoli->poli->nama_poli }}
                                        <td>
                                            {{ $rujukan->rujukan }}
                                        </td>
                                        <td>
                                            {{ $rujukan->rekamMedis->diagnosa }}
                                        </td>
                                        <td>
                                            {{ $rujukan->created_at }}
                                        </td>
                                        <td>
                                            @role('registrasi')
                                                <a href="{{ route('perawat-rujukan.edit', $rujukan->id) }}"
                                                   class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                    Edit
                                                </a>
                                                {!! Form::model($rujukan, ['url'=>'/perawat/rujukan/'.$rujukan->id.'/delete', 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                                {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                                {!! Form::close() !!}
                                            @endrole
                                            @role('dokter')
                                                <a href="{{ route('dokter-rujukan.edit', $rujukan->id) }}"
                                                   class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                    Edit
                                                </a>
                                                {!! Form::model($rujukan, ['route'=>['dokter-rujukan.destroy', $rujukan], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
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