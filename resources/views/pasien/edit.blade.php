@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Data Pasien</h2>
                        </div>
                        <div class="panel-body">
                            @role('admin')
                                {!! Form::model($pasien, ['route' => ['pasien.update', $pasien], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                                @include('pasien._form', ['model' => $pasien])
                                {!! Form::close() !!}
                            @endrole
                            @role('registrasi')
                                {!! Form::model($pasien, ['route' => ['perawat.pasien.update', $pasien], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                                @include('pasien._form', ['model' => $pasien])
                                {!! Form::close() !!}
                            @endrole
                            @role('dokter')
                                {!! Form::model($pasien, ['route' => ['dokter-pasien.update', $pasien], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                                @include('pasien._form', ['model' => $pasien])
                                {!! Form::close() !!}
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection