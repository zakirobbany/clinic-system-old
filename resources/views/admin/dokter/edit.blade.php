@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Dokter</h2>
                        </div>
                        <div class="panel-body">
                            @role('admin')
                                {!! Form::model($dokter, ['route' => ['dokter.update', $dokter], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                                @include('admin.dokter._form', ['model' => $dokter])
                                {!! Form::close() !!}
                            @endrole
                            @role('dokter')
                                {!! Form::model($dokter, ['url' => '/dokter/edit-dokter/'.$dokter->id, 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                                @include('admin.dokter._form', ['model' => $dokter])
                                {!! Form::close() !!}
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection