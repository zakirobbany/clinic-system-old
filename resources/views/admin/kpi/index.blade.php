@extends('layouts.layout')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Capaian KPI</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-xs-12 bg-white progress_summary">

        <div class="row kpiWrapper">
            <div class="kpiTitleBar">
                <div class="progress_title">
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-2">
                    <span>Kunjungan Pasien Umum</span>
                </div>
                <div class="col-xs-8">
                    <div class="progress progress_sm">
                        <div class="progress-bar {{ $umumStatus }}" role="progressbar" data-transitiongoal="{{ $umumPercentage }}"></div>
                    </div>
                </div>
                <div class="col-xs-2 more_info">
                    <span>{{ $umumPercentage }}%</span>
                </div>
            </div>
        </div>
        <div class="row kpiWrapper">
            <div class="kpiTitleBar">
                <div class="progress_title">
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-2">
                    <span>Kunjungan Pasien Kartu Hijau</span>
                </div>
                <div class="col-xs-8">
                    <div class="progress progress_sm">
                        <div class="progress-bar {{ $hijauStatus }}" role="progressbar" data-transitiongoal="{{ $hijauPercentage }}"></div>
                    </div>
                </div>
                <div class="col-xs-2 more_info">
                    <span>{{ $hijauPercentage }}%</span>
                </div>
            </div>
        </div>
        <div class="row kpiWrapper">
            <div class="kpiTitleBar">
                <div class="progress_title">
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-2">
                    <span>Kunjungan Kontak BPJS</span>
                </div>
                <div class="col-xs-8">
                    <div class="progress progress_sm">
                        <div class="progress-bar {{ $bpjsStatus }}" role="progressbar" data-transitiongoal="{{ $bpjsPercentage }}"></div>
                    </div>
                </div>
                <div class="col-xs-2 more_info">
                    <span>{{ number_format($bpjsPercentage, 2) }}%</span>
                </div>
            </div>
        </div>
        <div class="row kpiWrapper">
            <div class="kpiTitleBar">
                <div class="progress_title">
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-2">
                    <span>Kunjungan Pasien Prolanis</span>
                </div>
                <div class="col-xs-8">
                    <div class="progress progress_sm">
                        <div class="progress-bar {{ $prolanisStatus }}" role="progressbar" data-transitiongoal="{{ $prolanisPercentage }}"></div>
                    </div>
                </div>
                <div class="col-xs-2 more_info">
                    <span>{{ $prolanisPercentage }}%</span>
                </div>
            </div>
        </div>
        <div class="row kpiWrapper">
            <div class="kpiTitleBar">
                <div class="progress_title">
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-2">
                    <span>Maksimal Rujukan</span>
                </div>
                <div class="col-xs-8">
                    <div class="progress progress_sm">
                        <div class="progress-bar {{ $rujukanStatus }}" role="progressbar" data-transitiongoal="{{ $rujukan }}"></div>
                    </div>
                </div>
                <div class="col-xs-2 more_info">
                    <span>{{ $rujukan }}%</span>
                </div>
            </div>
        </div>
        <div class="row kpiWrapper">
            <div class="kpiTitleBar">
                <div class="progress_title">
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-2">
                    <span>Absensi Dokter</span>
                </div>
                <div class="col-xs-8">
                    <div class="progress progress_sm">
                        <div class="progress-bar {{ $absensiDokterStatus }}" role="progressbar" data-transitiongoal="{{ $absensiDokterPercentage }}"></div>
                    </div>
                </div>
                <div class="col-xs-2 more_info">
                    <span>{{ number_format($absensiDokterPercentage, 2) }}%</span>
                </div>
            </div>
        </div>
        <div class="row kpiWrapper">
            <div class="kpiTitleBar">
                <div class="progress_title">
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-2">
                    <span>Absensi Perawat</span>
                </div>
                <div class="col-xs-8">
                    <div class="progress progress_sm">
                        <div class="progress-bar {{ $absensiPerawatStatus }}" role="progressbar" data-transitiongoal="{{ $absensiPerawatPercentage }}"></div>
                    </div>
                </div>
                <div class="col-xs-2 more_info">
                    <span>{{ number_format($absensiPerawatPercentage, 2) }}%</span>
                </div>
            </div>
        </div>
    </div>
@endsection