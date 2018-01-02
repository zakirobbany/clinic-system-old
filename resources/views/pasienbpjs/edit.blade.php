@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Data Pasien BPJS</h2>
                        </div>
                        @role('admin')
                        <div class="panel-body">
                            {!! Form::model($pasien, ['route' => ['pasienbpjs.update', $pasien], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                            @include('pasienbpjs._form', ['model' => $pasien])
                            {!! Form::close() !!}
                        </div>
                        @endrole
                        @role('registrasi')
                        <div class="panel-body">
                            {!! Form::model($pasien, ['route' => ['perawat.pasienbpjs.update', $pasien], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                            @include('pasienbpjs._form', ['model' => $pasien])
                            {!! Form::close() !!}
                        </div>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection