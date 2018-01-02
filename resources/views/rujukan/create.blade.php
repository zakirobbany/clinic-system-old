@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Rujuk Kunjungan</h2>
                        </div>
                        <div class="panel-body">
                            @role('dokter')
                                {!! Form::open(['url' => '/dokter/rujukan/'.$kunjungan->id, 'class'=>'form-horizontal']) !!}
                                @include('rujukan._form')
                                {!! Form::close() !!}
                            @endrole
                            @role('registrasi')
                                {!! Form::open(['url' => '/perawat/perawat-rujukan/'.$kunjungan->id, 'class'=>'form-horizontal']) !!}
                                @include('rujukan._form')
                                {!! Form::close() !!}
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection