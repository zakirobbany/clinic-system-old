@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Obat</h2>
                        </div>
                        <div class="panel-body">
                            {!! Form::model($obats, ['route' => ['perawat-obat.update', $obats], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                            @include('obat._form', ['model' => $obats])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection