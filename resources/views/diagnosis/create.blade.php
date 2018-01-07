@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Buat Diagnosa Baru</h2>
                        </div>
                        <div class="panel-body">
                            @role('registrasi')
                            {!! Form::open(['url' => '/perawat/diagnosis', 'class'=>'form-horizontal']) !!}
                            @include('diagnosis._form')
                            {!! Form::close() !!}
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection