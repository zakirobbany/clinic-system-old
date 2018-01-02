@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Absensi Perawat</h3>
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
                                <p><a class="btn btn-primary" href="{{ route('absensi-perawat.create') }}">Isi Absensi</a></p>
                            </div>
                            <div class="clearfix"></div>
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama Perawat</td>
                                    <td>Waktu Absensi</td>
                                    <td>Operasi</td>
                                </tr>
                                </thead>
                                <tbody>
                                @php($no = 1)
                                @foreach($absensis as $absensi)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $absensi->registrasi['name'] }}
                                        </td>
                                        <td>
                                            {{ $absensi['created_at'] }}
                                        </td>
                                        <td>
                                            {!! Form::model($absensi, ['route'=>['absensi-perawat.destroy', $absensi], 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
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