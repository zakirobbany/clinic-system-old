@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Perawat</h2>
                        </div>
                        <div class="panel-body">
                            @role('admin')
                            {!! Form::model($registrasi, ['route' => ['registrasi.update', $registrasi], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                            @include('layouts._formEditUser', ['model' => $registrasi])
                            {!! Form::close() !!}
                            @endrole
                            @role('registrasi')
                            {!! Form::model($registrasi, ['route' => ['absensi-perawat.update', $registrasi], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                            @include('layouts._formEditUser', ['model' => $registrasi])
                            {!! Form::close() !!}
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection