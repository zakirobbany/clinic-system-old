<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
   return view('landing');
});


Route::get('/login', function (){
   return view('auth/login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function(){
    Route::resource('registrasi', 'RegistrasiController');
    Route::resource('dokter', 'DokterController');
    Route::resource('kategoripasien', 'KategoriPasienController');
    Route::resource('poli', 'PoliController');
    Route::resource('spesialis', 'SpesialisController');

    Route::resource('kpi', 'KpiController');
    Route::get('setkpi', ['uses' => 'KpiController@kpi', 'as' => 'kpi.kpi.index']);

    //Rekam Medis
    Route::resource('rekammedis', 'RekamMedisController');
    Route::get('rekammedisbulanan', ['uses' => 'RekamMedisController@bulananIndex', 'as' => 'rekammedis.bulanan.index']);

        //kunjungan
    Route::resource('kunjunganPoli', 'KunjunganPoliController');
    Route::get('kunjunganRujukan/{id}', ['uses'=>'KunjunganPoliController@kunjunganRujukan', 'as' => 'kunjungan.kunjunganRujukan']);

        //harian
    Route::get('kunjunganumum', ['uses' => 'KunjunganPoliController@umumIndex', 'as' => 'kunjungan.umum.index']);
    Route::get('kunjunganbpjs', ['uses' => 'KunjunganPoliController@bpjsIndex', 'as' => 'kunjungan.bpjs.index']);
    Route::get('kunjunganhijau', ['uses' => 'KunjunganPoliController@hijauIndex', 'as' => 'kunjungan.hijau.index']);
    Route::get('kunjunganprolanis', ['uses' => 'KunjunganPoliController@prolanisIndex', 'as' => 'kunjungan.prolanis.index']);
        //bulanan
    Route::get('kunjunganbulanan', ['uses' => 'KunjunganPoliController@bulananIndex', 'as' => 'kunjungan.bulanan.index']);
    Route::get('kunjunganbulananumum', ['uses' => 'KunjunganPoliController@bulananUmumIndex', 'as' => 'kunjungan.bulanan.umum.index']);
    Route::get('kunjunganbulananbpjs', ['uses' => 'KunjunganPoliController@bulananBpjsIndex', 'as' => 'kunjungan.bulanan.bpjs.index']);
    Route::get('kunjunganbulanankartuhijau', ['uses' => 'KunjunganPoliController@bulananHijauIndex', 'as' => 'kunjungan.bulanan.hijau.index']);
    Route::get('kunjunganbulananprolanis', ['uses' => 'KunjunganPoliController@bulananProlanisIndex', 'as' => 'kunjungan.bulanan.prolanis.index']);
    Route::get('kunjungankontakbpjs', ['uses'=>'KunjunganPoliController@kunjunganKontakBpjs', 'as' => 'kunjungan.kontak.bpjs']);

    //pasien
    Route::resource('pasien', 'PasienController');
    Route::resource('pasienbpjs', 'PasienBpjsController');
    Route::resource('pasienprolanis', 'PasienProlanisController');
    Route::get('pasienumum', ['uses' => 'PasienController@umumIndex', 'as' => 'pasien.umum.index']);
    Route::get('pasienkartuhijau', ['uses' => 'PasienController@kartuhijauIndex', 'as' => 'pasien.kartuhijau.index']);

    //rujukan
    Route::resource('rujukan', 'RujukanController');
    Route::get('rujukanbulanan', ['uses' => 'RujukanController@bulananIndex', 'as' => 'rujukan.bulanan.index']);
    Route::get('/rujukan/{id}/create/', ['uses'=>'RujukanController@Create', 'as' => 'rujukan.create']);
    Route::post('/rujukan/{id}','RujukanController@Store');

    //Absensi
    Route::resource('absensidokter', 'AbsensiController@absensiDokter');
    Route::resource('absensiperawat', 'AbsensiController@absensiPerawat');
    Route::resource('absensidokterbulanan', 'AbsensiController@absensiDokterBulanan');
    Route::resource('absensiperawatbulanan', 'AbsensiController@absensiPerawatBulanan');
    Route::delete('/absensi/{id}/delete', 'AbsensiController@absensiDestroy');

    //Export
    Route::get('/export/kunjungan', ['uses'=>'KunjunganPoliController@exportKunjungan', 'as'=>'admin.export.kunjungan']);
    Route::get('/export/kunjunganumum', ['uses'=>'KunjunganPoliController@exportKunjunganUmum', 'as'=>'admin.export.kunjunganumum']);
    Route::get('/export/kunjunganbpjs', ['uses'=>'KunjunganPoliController@exportKunjunganBpjs', 'as'=>'admin.export.kunjunganbpjs']);
    Route::get('/export/kunjungankontakbpjs', ['uses'=>'KunjunganPoliController@exportKunjunganKontakBpjs', 'as'=>'admin.export.kunjungankontakbpjs']);
    Route::get('/export/kunjungankartuhijau', ['uses'=>'KunjunganPoliController@exportKunjunganKartuhijau', 'as'=>'admin.export.kunjungankartuhijau']);
    Route::get('/export/kunjunganprolanis', ['uses'=>'KunjunganPoliController@exportKunjunganProlanis', 'as'=>'admin.export.kunjunganprolanis']);

    Route::get('/export/pasien', ['uses'=>'PasienController@exportPasien', 'as'=>'admin.export.pasien']);
    Route::get('/export/pasienbpjs', ['uses'=>'PasienController@exportPasienBpjs', 'as'=>'admin.export.pasienbpjs']);
    Route::get('/export/pasienkartuhijau', ['uses'=>'PasienController@exportPasienKartuhijau', 'as'=>'admin.export.pasienkartuhijau']);
    Route::get('/export/pasienprolanis', ['uses'=>'PasienController@exportPasienProlanis', 'as'=>'admin.export.pasienprolanis']);

    Route::get('/export/rujukan', ['uses'=>'RujukanController@exportrujukan', 'as'=>'admin.export.rujukan']);
    Route::resource('prolanis', 'ProlanisController');
});

Route::group(['prefix' => 'perawat', 'middleware' => ['auth', 'role:registrasi']], function (){
    Route::resource('perawat-registrasi', 'RegistrasiController');

    Route::resource('kpi', 'KpiController');
    Route::get('setkpi', ['uses' => 'KpiController@kpi', 'as' => 'kpi.kpi.index']);

    //pasien
    Route::post('/perawat-pasien/store', ['uses'=> 'PasienController@perawatStore', 'as'=>'perawat.pasien.store']);
    Route::patch('/perawat-pasien/{id}/update', ['uses'=>'PasienController@perawatUpdate', 'as'=>'perawat.pasien.update']);
    Route::delete('/perawat-pasien/{id}/delete', ['uses'=>'PasienController@perawatDestroy', 'as'=>'perawat.pasien.destroy']);
    Route::resource('perawat-pasien', 'PasienController');


    Route::resource('perawat-pasienbpjs', 'PasienBPJSController');
    Route::post('/perawat-pasienbpjs/store', ['uses'=> 'PasienBPJSController@perawatStore', 'as'=>'perawat.pasienbpjs.store']);
    Route::patch('/perawat-pasienbpjs/{id}/update', ['uses'=>'PasienBPJSController@perawatUpdate', 'as'=>'perawat.pasienbpjs.update']);
    Route::delete('/perawat-pasienbpjs/{id}/delete', ['uses'=>'PasienBPJSController@perawatDestroy', 'as'=>'perawat.pasienbpjs.destroy']);


    Route::resource('perawat-pasienprolanis', 'PasienProlanisController');
    Route::post('/perawat-pasienprolanis/store', ['uses'=> 'PasienProlanisController@perawatStore', 'as'=>'perawat.pasienprolanis.store']);
    Route::patch('/perawat-pasienprolanis/{id}/update', ['uses'=>'PasienProlanisController@perawatUpdate', 'as'=>'perawat.pasienprolanis.update']);
    Route::delete('/perawat-pasienprolanis/{id}/delete', ['uses'=>'PasienProlanisController@perawatDestroy', 'as'=>'perawat.pasienprolanis.destroy']);


    Route::get('perawat-pasienumum', ['uses' => 'PasienController@umumIndex', 'as' => 'perawat.pasien.umum.index']);
    Route::get('perawat-pasienkartuhijau', ['uses' => 'PasienController@kartuhijauIndex', 'as' => 'perawat.pasien.kartuhijau.index']);

    Route::resource('perawat-kunjunganPoli', 'KunjunganPoliController');
    Route::get('kunjunganRujukan/{id}', ['uses'=>'KunjunganPoliController@kunjunganRujukan', 'as' => 'perawat.kunjungan.kunjunganRujukan']);

    //harian
    Route::get('perawat-kunjunganumum', ['uses' => 'KunjunganPoliController@umumIndex', 'as' => 'perawat.kunjungan.umum.index']);
    Route::get('perawat-kunjunganbpjs', ['uses' => 'KunjunganPoliController@bpjsIndex', 'as' => 'perawat.kunjungan.bpjs.index']);
    Route::get('perawat-kunjunganhijau', ['uses' => 'KunjunganPoliController@hijauIndex', 'as' => 'perawat.kunjungan.hijau.index']);
    Route::get('perawat-kunjunganprolanis', ['uses' => 'KunjunganPoliController@prolanisIndex', 'as' => 'perawat.kunjungan.prolanis.index']);
    //bulanan
    Route::get('perawat-kunjunganbulanan', ['uses' => 'KunjunganPoliController@bulananIndex', 'as' => 'perawat.kunjungan.bulanan.index']);
    Route::get('perawat-kunjunganbulananumum', ['uses' => 'KunjunganPoliController@bulananUmumIndex', 'as' => 'perawat.kunjungan.bulanan.umum.index']);
    Route::get('perawat-kunjunganbulananbpjs', ['uses' => 'KunjunganPoliController@bulananBpjsIndex', 'as' => 'perawat.kunjungan.bulanan.bpjs.index']);
    Route::get('perawat-kunjunganbulanankartuhijau', ['uses' => 'KunjunganPoliController@bulananHijauIndex', 'as' => 'perawat.kunjungan.bulanan.hijau.index']);
    Route::get('perawat-kunjunganbulananprolanis', ['uses' => 'KunjunganPoliController@bulananProlanisIndex', 'as' => 'perawat.kunjungan.bulanan.prolanis.index']);
    Route::get('perawat-kunjungankontakbpjs', ['uses'=>'KunjunganPoliController@kunjunganKontakBpjs', 'as' => 'perawat.kunjungan.kontak.bpjs']);
    //rujukan
    Route::resource('perawat-rujukan', 'RujukanController');
    Route::get('perawat-rujukanbulanan', ['uses' => 'RujukanController@bulananIndex', 'as' => 'perawat.rujukan.bulanan.index']);
    Route::get('perawat-rujukan/{id}/create', ['uses' => 'RujukanController@create', 'as' => 'perawat.rujukan.create']);
    Route::post('/perawat-rujukan/{id}', 'RujukanController@perawatStore');
    Route::patch('/rujukan/{id}','RujukanController@perawatUpdate');
    Route::delete('/rujukan/{id}/delete/', 'RujukanController@perawatDestroy');


    //rekam medis
    Route::resource('perawat-rekammedis', 'RekamMedisController');
    Route::get('perawat-rekammedisbulanan', ['uses' => 'RekamMedisController@bulananIndex', 'as' => 'perawat.rekammedis.bulanan.index']);
    Route::get('perawat-rekammedis/{id}/create', ['uses' => 'RekamMedisController@create', 'as' => 'perawat.rekammedis.create']);
    Route::post('perawat-rekammedis/{id}', 'RekamMedisController@perawatStore');
    Route::patch('/perawat-rekammedis/{id}/update', ['uses'=>'RekamMedisController@perawatUpdate', 'as' => 'perawat.rekammedis.update']);
    Route::delete('perawat-rekammedis/{id}/destroy', ['uses'=>'RekamMedisController@perawatDestroy', 'as' => 'perawat.rekammedis.destroy']);

    //rekap obat
    Route::resource('perawat-rekapobat', 'RekapObatController');


    //absensi
    Route::resource('absensi-perawat', 'PerawatController');

    //export
    Route::get('/export/kunjungan', ['uses'=>'KunjunganPoliController@exportKunjungan', 'as'=>'perawat.export.kunjungan']);
    Route::get('/export/kunjunganumum', ['uses'=>'KunjunganPoliController@exportKunjunganUmum', 'as'=>'perawat.export.kunjunganumum']);
    Route::get('/export/kunjunganbpjs', ['uses'=>'KunjunganPoliController@exportKunjunganBpjs', 'as'=>'perawat.export.kunjunganbpjs']);
    Route::get('/export/kunjungankontakbpjs', ['uses'=>'KunjunganPoliController@exportKunjunganKontakBpjs', 'as'=>'perawat.export.kunjungankontakbpjs']);
    Route::get('/export/kunjungankartuhijau', ['uses'=>'KunjunganPoliController@exportKunjunganKartuhijau', 'as'=>'perawat.export.kunjungankartuhijau']);
    Route::get('/export/kunjunganprolanis', ['uses'=>'KunjunganPoliController@exportKunjunganProlanis', 'as'=>'perawat.export.kunjunganprolanis']);

    Route::get('/export/pasien', ['uses'=>'PasienController@exportPasien', 'as'=>'perawat.export.pasien']);
    Route::get('/export/pasienbpjs', ['uses'=>'PasienController@exportPasienBpjs', 'as'=>'perawat.export.pasienbpjs']);
    Route::get('/export/pasienkartuhijau', ['uses'=>'PasienController@exportPasienKartuhijau', 'as'=>'perawat.export.pasienkartuhijau']);
    Route::get('/export/pasienprolanis', ['uses'=>'PasienController@exportPasienProlanis', 'as'=>'perawat.export.pasienprolanis']);

    Route::get('/export/rujukan', ['uses'=>'RujukanController@exportrujukan', 'as'=>'perawat.export.rujukan']);


    //prolanis
    Route::resource('perawat-prolanis', 'ProlanisController');
    Route::get('/export/prolanis', ['uses'=>'ProlanisController@exportProlanis', 'as'=>'perawat.export.prolanis']);

    //obat
    Route::resource('perawat-obat', 'ObatsController');


});

Route::group(['prefix'=> 'dokter', 'middleware'=>['auth', 'role:dokter']], function (){
    Route::resource('dokter-dokter', 'DokterController');
    Route::patch('/edit-dokter/{id}','DokterController@dokterUpdate');
    Route::resource('dokter-pasien', 'PasienController');
    Route::get('dokter-pasienumum', ['uses' => 'PasienController@umumIndex', 'as' => 'dokter.pasien.umum.index']);
    Route::resource('dokter-pasienbpjs', 'PasienBPJSController');
    Route::get('dokter-pasienkartuhijau', ['uses' => 'PasienController@kartuhijauIndex', 'as' => 'dokter.pasien.kartuhijau.index']);
    Route::resource('dokter-pasienprolanis', 'PasienProlanisController');

    Route::resource('dokter-kunjunganPoli', 'KunjunganPoliController');
    Route::get('kunjunganRujukan/{id}', ['uses'=>'KunjunganPoliController@kunjunganRujukan', 'as' => 'dokter.kunjungan.kunjunganRujukan']);

    //harian
    Route::get('dokter-kunjunganumum', ['uses' => 'KunjunganPoliController@umumIndex', 'as' => 'dokter.kunjungan.umum.index']);
    Route::get('dokter-kunjunganbpjs', ['uses' => 'KunjunganPoliController@bpjsIndex', 'as' => 'dokter.kunjungan.bpjs.index']);
    Route::get('dokter-kunjunganhijau', ['uses' => 'KunjunganPoliController@hijauIndex', 'as' => 'dokter.kunjungan.hijau.index']);
    Route::get('dokter-kunjunganprolanis', ['uses' => 'KunjunganPoliController@prolanisIndex', 'as' => 'dokter.kunjungan.prolanis.index']);
    //bulanan
    Route::get('dokter-kunjunganbulanan', ['uses' => 'KunjunganPoliController@bulananIndex', 'as' => 'dokter.kunjungan.bulanan.index']);
    Route::get('dokter-kunjunganbulananumum', ['uses' => 'KunjunganPoliController@bulananUmumIndex', 'as' => 'dokter.kunjungan.bulanan.umum.index']);
    Route::get('dokter-kunjunganbulananbpjs', ['uses' => 'KunjunganPoliController@bulananBpjsIndex', 'as' => 'dokter.kunjungan.bulanan.bpjs.index']);
    Route::get('dokter-kunjunganbulanankartuhijau', ['uses' => 'KunjunganPoliController@bulananHijauIndex', 'as' => 'dokter.kunjungan.bulanan.hijau.index']);
    Route::get('dokter-kunjunganbulananprolanis', ['uses' => 'KunjunganPoliController@bulananProlanisIndex', 'as' => 'dokter.kunjungan.bulanan.prolanis.index']);
    Route::get('dokter-kunjungankontakbpjs', ['uses'=>'KunjunganPoliController@kunjunganKontakBpjs', 'as' => 'dokter.kunjungan.kontak.bpjs']);

    //absensi
    Route::resource('dokter-absensi', 'AbsensiController');

    //rujukan
    Route::resource('dokter-rujukan', 'RujukanController');
    Route::get('dokter-rujukanbulanan', ['uses' => 'RujukanController@bulananIndex', 'as' => 'dokter.rujukan.bulanan.index']);
    Route::get('/rujukan/{id}/create/', ['uses'=>'RujukanController@Create', 'as' => 'dokter.rujukan.create']);
    Route::post('/rujukan/{id}','RujukanController@Store');

    //rekam medis
    Route::resource('dokter-rekammedis', 'RekamMedisController');
    Route::get('dokter-rekammedisbulanan', ['uses' => 'RekamMedisController@bulananIndex', 'as' => 'dokter.rekammedis.bulanan.index']);
    Route::get('/rekammedis/{id}/create/', ['uses'=>'RekamMedisController@Create', 'as' => 'dokter.rekammedis.create']);
    Route::post('/rekammedis/{id}','RekamMedisController@Store');

});

Auth::routes();

Route::get('home', 'HomeController@index');

