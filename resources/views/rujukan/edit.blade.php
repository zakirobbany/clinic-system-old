@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Rujukan</h2>
                        </div>
                        <div class="panel-body">
                            @role('dokter')
                                {!! Form::model($rujukan, ['route' => ['dokter-rujukan.update', $rujukan], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                                @include('rujukan._form', ['model' => $rujukan])
                                {!! Form::close() !!}
                            @endrole
                            @role('registrasi')
                                {!! Form::model($rujukan, ['url' => '/perawat/rujukan/'.$rujukan->id, 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                                @include('rujukan._form', ['model' => $rujukan])
                                {!! Form::close() !!}
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection