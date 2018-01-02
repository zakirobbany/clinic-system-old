@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Spesialis</h2>
                        </div>
                        <div class="panel-body">
                            {!! Form::model($spesialis, ['route' => ['spesialis.update', $spesialis], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                            @include('admin.spesialis._form', ['model' => $spesialis])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection