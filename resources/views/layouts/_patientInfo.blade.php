<div class="row tile_count">
    <h2>JUMLAH PASIEN</h2>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-user"></i> Pasien</span>
        <div class="count">{{ $totalPatients }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-user"></i> Pasien Umum</span>
        <div class="count">{{ $totalGeneralPatients }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-user"></i> Pasien BPJS</span>
        <div class="count">{{ $totalBPJSPatients }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-user"></i> Pasien Kartu Hijau</span>
        <div class="count">{{ $totalGreenPatients }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-user"></i> Pasien Prolanis</span>
        <div class="count">{{ $totalProlanisPatients }}</div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row tile_count">
    <H2>JUMLAH KUNJUNGAN HARI INI</H2>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i> Total Kunjungan</span>
        <div class="count">{{ $todayVisitors }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i> Total Kunjungan Umum</span>
        <div class="count">{{ $todayGeneralVisitors }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i> Kunjungan Kontak BPJS</span>
        <div class="count">{{ $todayBPJSVisitors }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i> Total Kunjungan Kartu Hijau</span>
        <div class="count">{{ $todayGreenVisitors }}</div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row tile_count">
    <h2>JUMLAH KUNJUNGAN BULAN INI</h2>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i> Total Kunjungan</span>
        <div class="count {{ $totalStatus }}">{{ $monthVisitors }}</div>
        <span class="count_bottom"><i class="{{ $totalStatus }}">{{ number_format($totalPercentage, 2) }}% </i> Dari Seluruh Pasien</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i>  Kunjungan Umum</span>
        <div class="count {{ $generalStatus }}">{{ $monthGeneralVisitors }}</div>
        <span class="count_bottom"><i class="{{ $generalStatus }}">{{ number_format($generalPercentage, 2) }}% </i> Dari Pasien Umum</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i>  Kontak BPJS</span>
        <div class="count {{ $BPJSStatus }}">{{ $monthBPJSVisitors }}</div>
        <span class="count_bottom"><i class="{{ $BPJSStatus }}">{{ number_format($BPJSPercentage, 2) }}% </i> Dari Seluruh BPJS</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i>  Kunjungan Kartu Hijau</span>
        <div class="count green">{{ $monthGreenVisitors }}</div>
        <span class="count_bottom"><i class="green">{{ number_format($greenPercentage, 2) }}% </i> Dari Seluruh Pasien Hijau</span>
    </div>

</div>

<div class="clearfix"></div>
<div class="row tile_count">
    <h2>PROLANIS</h2>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i>  Kehadiran Prolanis</span>
        <div class="count {{ $prolanisStatus }}">{{ $monthProlanisVisitors }}</div>
        <span class="count_bottom"><i class="{{ $prolanisStatus }}">{{ number_format($prolanisPercentage, 2) }}% </i> Dari Pasien Prolanis</span>
    </div>
</div>