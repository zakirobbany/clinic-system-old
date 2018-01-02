@extends('layouts.layout')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>KPI</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="clearfix"></div>
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td>No</td>
                                    <td>KPI</td>
                                    <td>Bobot</td>
                                    <td>Operasi</td>
                                </tr>
                                </thead>
                                <tbody>
                                @php($no = 1)
                                @foreach($kpis as $kpi)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $kpi->kpi }}
                                        </td>
                                        <td>
                                            {{ $kpi->bobot }}
                                        </td>
                                        <td>
                                            <a href="{{ route('kpi.edit', $kpi->id) }}"
                                               class="btn btn-xs btn-success"><i class="fa fa-file-text-o"></i>
                                                Edit
                                            </a>
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