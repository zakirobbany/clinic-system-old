@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Kunjungan</h2>
                        </div>
                        <div class="panel-body">
                            {!! Form::model($kunjungan, ['route' => ['perawat-kunjunganPoli.update', $kunjungan], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                            @include('kunjungan._form', ['model' => $kunjungan])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection