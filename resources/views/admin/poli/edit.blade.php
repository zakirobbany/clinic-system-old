@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Edit Poli</h2>
                        </div>
                        <div class="panel-body">
                            {!! Form::model($poli, ['route' => ['poli.update', $poli], 'method' => 'patch', 'class'=>'form-horizontal']) !!}
                            @include('admin.poli._form', ['model' => $poli])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection