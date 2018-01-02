@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Tambah Pasien</h2>
                        </div>
                        <div class="panel-body">
                            @role('admin')
                                {!! Form::open(['route' => 'pasien.store', 'class'=>'form-horizontal']) !!}
                                @include('pasien._form')
                                {!! Form::close() !!}
                            @endrole
                            @role('registrasi')
                                {!! Form::open(['route' => 'perawat.pasien.store', 'class'=>'form-horizontal']) !!}
                                @include('pasien._form')
                                {!! Form::close() !!}
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection