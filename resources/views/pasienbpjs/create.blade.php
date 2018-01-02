@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Tambah Pasien BPJS</h2>
                        </div>
                        @role('admin')
                        <div class="panel-body">
                            {!! Form::open(['route' => 'pasienbpjs.store', 'class'=>'form-horizontal']) !!}
                            @include('pasienbpjs._form')
                            {!! Form::close() !!}
                        </div>
                        @endrole
                        @role('registrasi')
                        <div class="panel-body">
                            {!! Form::open(['route' => 'perawat.pasienbpjs.store', 'class'=>'form-horizontal']) !!}
                            @include('pasienbpjs._form')
                            {!! Form::close() !!}
                        </div>
                        @endrole
                        @role('admin')
                        <div class="panel-body">
                            {!! Form::open(['route' => 'dokter-pasienbpjs.store', 'class'=>'form-horizontal']) !!}
                            @include('pasienbpjs._form')
                            {!! Form::close() !!}
                        </div>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection