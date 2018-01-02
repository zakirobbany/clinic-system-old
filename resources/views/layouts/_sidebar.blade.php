<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    @role('admin')
    <div class="menu_section">
        <br/>
        <h3 style="margin-top: 80px"></h3>
        <ul class="nav side-menu">
            <li><a href="/home"><i class="fa fa-home"></i> Home </a></li>
            <li><a><i class="fa fa-tachometer"></i> KPI <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="/admin/setkpi">KPI</a></li>
                    <li><a href="/admin/kpi">Capaian KPI</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-users"></i> Karyawan <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                        <li><a href="/admin/registrasi">Perawat</a></li>
                        <li><a href="/admin/dokter">Dokter</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-male"></i> Pasien <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="/admin/pasien">Pasien</a></li>
                    <li><a href="/admin/pasienumum">Pasien Umum</a></li>
                    <li><a href="/admin/pasienbpjs">Pasien BPJS</a></li>
                    <li><a href="/admin/pasienkartuhijau">Pasien Kartu Hijau</a></li>
                    <li><a href="/admin/pasienprolanis">Prolanis</a></li>
                    <li><a href="/admin/kategoripasien">Kategori Pasien</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-group"></i>Kunjungan <span class="fa fa-chevron-down"></span> </a>
                <ul class="nav child_menu">
                    <li><a href="/admin/kunjunganPoli">Kunjungan</a></li>
                    <li><a href="/admin/kunjunganumum">Kunjungan Umum</a></li>
                    <li><a href="/admin/kunjunganbpjs">Kunjungan BPJS</a></li>
                    <li><a href="/admin/kunjungankontakbpjs">Kunjungan Kontak BPJS</a></li>
                    <li><a href="/admin/kunjunganhijau">Kunjungan Kartu Hijau</a></li>
                    <li><a href="/admin/kunjunganprolanis">Kunjungan Prolanis</a></li>
                    </ul>
            </li>
            <li><a href="/admin/poli"><i class="fa fa-eyedropper"></i>Poli</a></li>
            <li><a href="/admin/spesialis"><i class="fa fa-code-fork"></i>Spesialis</a></li>
            <li><a href="/admin/rujukan"><i class="fa fa-building-o"></i>Rujukan</a></li>
            <li><a href="/admin/rekammedis"><i class="fa fa-folder-open-o"></i>Rekam Medis</a></li>
        </ul>
    </div>
    @endrole
    @role('registrasi')
    <div class="menu_section">
        <h3 style="margin-top: 100px"></h3>
        <ul class="nav side-menu">
            <li><a href="/home"><i class="fa fa-home"></i> Home </a></li>
            <li><a><i class="fa fa-male"></i> Pasien <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="/perawat/perawat-pasien">Pasien</a></li>
                    <li><a href="/perawat/perawat-pasienumum">Pasien Umum</a></li>
                    <li><a href="/perawat/perawat-pasienbpjs">Pasien BPJS</a></li>
                    <li><a href="/perawat/perawat-pasienkartuhijau">Pasien Kartu Hijau</a></li>
                    <li><a href="/perawat/perawat-pasienprolanis">Pasien Prolanis</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-group"></i>Kunjungan <span class="fa fa-chevron-down"></span> </a>
                <ul class="nav child_menu">
                    <li><a href="/perawat/perawat-kunjunganPoli">Kunjungan</a></li>
                    <li><a href="/perawat/perawat-kunjunganumum">Kunjungan Umum</a></li>
                    <li><a href="/perawat/perawat-kunjunganbpjs">Kunjungan BPJS</a></li>
                    <li><a href="/perawat/perawat-kunjungankontakbpjs">Kunjungan Kontak BPJS</a></li>
                    <li><a href="/perawat/perawat-kunjunganhijau">Kunjungan Kartu Hijau</a></li>
                    <li><a href="/perawat/perawat-kunjunganprolanis">Kunjungan Prolanis</a></li>
                </ul>
            </li>
            <li><a href="/perawat/perawat-rujukan"><i class="fa fa-male"></i>Rujukan</a></li>
            <li><a href="/perawat/perawat-rekammedis"><i class="fa fa-folder-open-o"></i>Rekam Medis</a></li>
            <li><a href="/perawat/perawat-prolanis"><i class="fa fa-child"></i>Prolanis</a></li>
            <li><a><i class="fa fa-plus-circle"></i>Obat <span class="fa fa-chevron-down"></span> </a>
                <ul class="nav child_menu">
                    <li><a href="/perawat/perawat-obat">Data Obat</a></li>
                    <li><a href="/perawat/perawat-rekapobat">Rekap Obat</a></li>
                </ul>
            </li>
            <li><a href="/perawat/setkpi"><i class="fa fa-tachometer"></i>System Variable</a></li>
        </ul>
    </div>
    @endrole
    @role('dokter')
    <div class="men_section">
        <h3 style="margin-top: 150px"></h3>
        <ul class="nav side-menu">
            <li><a href="/home"><i class="fa fa-home"></i> Home </a></li>
            <li><a><i class="fa fa-male"></i> Pasien <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="/dokter/dokter-pasien">Pasien</a></li>
                    <li><a href="/dokter/dokter-pasienumum">Pasien Umum</a></li>
                    <li><a href="/dokter/dokter-pasienbpjs">Pasien BPJS</a></li>
                    <li><a href="/dokter/dokter-pasienkartuhijau">Pasien Kartu Hijau</a></li>
                    <li><a href="/dokter/dokter-pasienprolanis">Pasien Prolanis</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-group"></i>Kunjungan <span class="fa fa-chevron-down"></span> </a>
                <ul class="nav child_menu">
                    <li><a href="/dokter/dokter-kunjunganPoli">Kunjungan</a></li>
                    <li><a href="/dokter/dokter-kunjunganumum">Kunjungan Umum</a></li>
                    <li><a href="/dokter/dokter-kunjunganbpjs">Kunjungan BPJS</a></li>
                    <li><a href="/dokter/dokter-kunjungankontakbpjs">Kunjungan Kontak BPJS</a></li>
                    <li><a href="/dokter/dokter-kunjunganhijau">Kunjungan Kartu Hijau</a></li>
                    <li><a href="/dokter/dokter-kunjunganprolanis">Kunjungan Prolanis</a></li>
                </ul>
            </li>
            <li><a href="/dokter/dokter-rujukan"><i class="fa fa-male"></i>Rujukan</a></li>
            <li><a href="/dokter/dokter-rekammedis"><i class="fa fa-folder-open-o"></i>Rekam Medis</a></li>
        </ul>
    </div>
    @endrole
</div>