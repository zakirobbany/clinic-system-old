@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Data Pasien Prolanis</h2>
                        </div>
                        <div class="panel-body">
                            @role('admin')
                            {!! Form::model($pasien, ['route' => ['pasienprolanis.update', $pasien], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                            @include('pasienprolanis._form', ['model' => $pasien])
                            {!! Form::close() !!}
                            @endrole
                            @role('registrasi')
                            {!! Form::model($pasien, ['route' => ['perawat.pasienprolanis.update', $pasien], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                            @include('pasienprolanis._form', ['model' => $pasien])
                            {!! Form::close() !!}
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection