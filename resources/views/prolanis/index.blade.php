@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Kehadiran Prolanis</h3>
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
                            <div class="col-sm-4 col-md-4 col-xs-4 text-left">
                                <p><a class="btn btn-primary" href="{{ route('perawat-prolanis.create') }}">Isi Absensi Prolanis</a></p>
                            </div>
                            <div class="col-sm-8 col-md-8 col-xs-8 text-right">
                                <p><a class="btn btn-primary" href="{{ route('perawat.export.prolanis') }}">Download</a></p>
                            </div>
                            <div class="clearfix"></div>
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>No</td>
                                    <td>ID Pasien</td>
                                    <td>Nama Pasien</td>
                                    <td>Petugas</td>
                                    <td>Waktu Kehadiran</td>
                                    <td>Operasi</td>
                                </tr>
                                </thead>
                                <tbody>
                                @php($no = 1)
                                @foreach($prolanis as $p)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $p->pasien_id }}
                                        </td>
                                        <td>
                                            {{ $p->pasien['nama'] }}
                                        </td>
                                        <td>
                                            {{ $p->registrasi['name'] }}
                                        </td>
                                        <td>
                                            {{ $p['created_at'] }}
                                        </td>
                                        <td>
                                            {!! Form::model($p, ['route'=>['perawat-prolanis.destroy', $p], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
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