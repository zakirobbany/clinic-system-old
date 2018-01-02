@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Registrasi</h3>
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
                                <p><a class="btn btn-primary" href="{{ route('registrasi.create') }}">Tambah Perawat</a></p>
                            </div>
                            <div class="clearfix"></div>
                            @include('admin.registrasi._profiles')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection