@role('registrasi')
<div class="col-sm-4 col-md-4 col-xs-4 text-left">
    <p><a class="btn btn-primary" href="{{ route('perawat-kunjunganPoli.create') }}">Tambah Kunjungan</a></p>
</div>
@endrole
@role('admin')
<div class="col-sm-12 col-md-12 col-xs-12 text-right">
    <p><a class="btn btn-primary" href="{{ route('kunjungan.bulanan.index') }}">Kunjungan Bulan Ini</a></p>
</div>
@endrole
@role('dokter')
<div class="col-sm-12 col-md-12 col-xs-12 text-right">
    <p><a class="btn btn-primary" href="{{ route('dokter.kunjungan.bulanan.index') }}">Kunjungan Bulan Ini</a></p>
</div>
@endrole
@role('registrasi')
<div class="col-sm-8 col-md-8 col-xs-8 text-right">
    <p><a class="btn btn-primary" href="{{ route('perawat.kunjungan.bulanan.index') }}">Kunjungan Bulan Ini</a></p>
</div>
@endrole