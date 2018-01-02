<div class="row tile_count">
    <h2>JUMLAH PASIEN</h2>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-user"></i> Pasien</span>
        <div class="count">{{ $totalPasien }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-user"></i> Pasien Umum</span>
        <div class="count">{{ $pasienUmum }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-user"></i> Pasien BPJS</span>
        <div class="count">{{ $pasienBPJS }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-user"></i> Pasien Kartu Hijau</span>
        <div class="count">{{ $pasienKartuHijau }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-user"></i> Pasien Prolanis</span>
        <div class="count">{{ $pasienProlanis }}</div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row tile_count">
    <H2>JUMLAH KUNJUNGAN HARI INI</H2>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i> Total Kunjungan</span>
        <div class="count">{{ $harian }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i> Total Kunjungan Umum</span>
        <div class="count">{{ $harianUmum }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i> Kunjungan Kontak BPJS</span>
        <div class="count">{{ $harianBpjs }}</div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i> Total Kunjungan Kartu Hijau</span>
        <div class="count">{{ $harianHijau }}</div>
    </div>
</div>

<div class="clearfix"></div>

<div class="row tile_count">
    <h2>JUMLAH KUNJUNGAN BULAN INI</h2>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i> Total Kunjungan</span>
        <div class="count {{ $totalStatus }}">{{ $totalKunjungan }}</div>
        <span class="count_bottom"><i class="{{ $totalStatus }}">{{ number_format($totalPercentage, 2) }}% </i> Dari Seluruh Pasien</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i>  Kunjungan Umum</span>
        <div class="count {{ $umumStatus }}">{{ $kunjunganUmum }}</div>
        <span class="count_bottom"><i class="{{ $umumStatus }}">{{ number_format($umumPercentage, 2) }}% </i> Dari Pasien Umum</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i>  Kontak BPJS</span>
        <div class="count {{ $bpjsStatus }}">{{ $kunjunganBpjs }}</div>
        <span class="count_bottom"><i class="{{ $bpjsStatus }}">{{ number_format($bpjsPercentage, 2) }}% </i> Dari Seluruh BPJS</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i>  Kunjungan Kartu Hijau</span>
        <div class="count">{{ $kunjunganHijau }}</div>
        <span class="count_bottom">{{ number_format($hijauPercentage, 2) }}% </> Dari Pasien Kartu Hijau</span>
    </div>

</div>

<div class="clearfix"></div>
<div class="row tile_count">
    <h2>PROLANIS</h2>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="width: 208px">
        <span class="count_top"><i class="fa fa-group"></i>  Kehadiran Prolanis</span>
        <div class="count {{ $prolanisStatus }}">{{ $kunjunganProlanis }}</div>
        <span class="count_bottom"><i class="{{ $prolanisStatus }}">{{ number_format($prolanisPercentage, 2) }}% </i> Dari Pasien Prolanis</span>
    </div>
</div>