@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Diagnosis</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            @role('registrasi')
                            <div class="col-sm-12 col-md-12 col-xs-12 text-right">
                                <p><a class="btn btn-primary" href="{{ route('diagnosis.create') }}">Buat Diagnosa
                                        Baru</a></p>
                            </div>
                            @endrole
                            <div class="clearfix"></div>
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama Diagnosa</td>
                                    <td>Tipe Diagnosa</td>
                                    <td>Operasi</td>
                                </tr>
                                </thead>
                                <tbody>
                                @php($no = 1)
                                @foreach($diagnoses as $diagnosis)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $diagnosis->name }}
                                        </td>
                                        <td>
                                            {{ $diagnosis->diagnosisType->name }}
                                        </td>
                                        <td>
                                            @role('registrasi')
                                            <a href="{{ route('diagnosis.edit', $diagnosis->id) }}"
                                               class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            {!! Form::model($diagnosis, ['url'=>'/perawat/diagnosis/'. $diagnosis->id , 'method'=>'delete', 'class'=>'form-inline', 'style'=>'display:inline;']) !!}
                                            {!! Form::Button('<i class="fa fa-trash-o"></i>Delete', ['class'=>'btn btn-xs btn-danger', 'type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                            @endrole
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-xs-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection