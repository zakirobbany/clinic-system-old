<?php

namespace App\Http\Controllers;

use App\Home;
use App\Kpi;
use App\Pasien;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $home = new Home();

        //bulanan

        $totalKunjungan = $home->getJumlahKunjungan();
        $totalPasien = $home->getJumlahPasien();

        $kunjunganUmum = $home->getKunjunganUmum();
        $pasienUmum = $home->getPasienUmum();

        $pasienBPJS = $home->getPasienBPJS();
        $kunjunganBpjs = $home->getKunjunganBpjs();

        $pasienKartuHijau = $home->getPasienHijau();
        $kunjunganHijau = $home->getKunjunganHijau();

        $pasienProlanis = $home->getPasienProlanis();
        $kunjunganProlanis = $home->getKunjunganProlanis();

        //Harian
        $harian = $home->getharian();
        $harianUmum = $home->getHarianUmum();
        $harianBpjs = $home->getHarianBpjs();
        $harianHijau = $home->getHarianHijau();

        $totalPercentage = ($totalKunjungan / $totalPasien) * 100;
        $umumPercentage = ($kunjunganUmum / $pasienUmum) * 100;
        $bpjsPercentage = ($kunjunganBpjs/ $pasienBPJS) * 100;
        $hijauPercentage = ($kunjunganHijau / $pasienKartuHijau) * 100;
        $prolanisPercentage = ($kunjunganProlanis / $pasienProlanis) * 100;

        $getBobot = Kpi::where('kpi', '=', 'kunjungan')->first();
        $minKunjunganUmum = $getBobot->bobot;

        $getBobotBpjs = Kpi::where('kpi', '=', 'bpjs')->first();
        $minKunjunganBpjs = $getBobotBpjs->bobot;

        $getBobotProlanis = Kpi::where('kpi', '=', 'prolanis')->first();
        $minKunjunganProlanis = $getBobotProlanis->bobot;

        $totalStatus = '';
        if ($totalPercentage >= $minKunjunganUmum)
            $totalStatus = 'green';
        elseif ($totalPercentage <= $minKunjunganUmum)
            $totalStatus = 'red';

        $umumStatus = '';
        if ($umumPercentage >= $minKunjunganUmum)
            $umumStatus = 'green';
        elseif ($umumPercentage <= $minKunjunganUmum)
            $umumStatus = 'red';

        $bpjsStatus = '';
        if ($bpjsPercentage >= $minKunjunganBpjs)
            $bpjsStatus = 'green';
        elseif ($bpjsPercentage<$minKunjunganBpjs)
            $bpjsStatus = 'red';

        $prolanisStatus = '';
        if ($prolanisPercentage >= $minKunjunganProlanis)
            $prolanisStatus = 'green';
        elseif ($prolanisPercentage < $minKunjunganProlanis)
            $prolanisStatus = 'red';


        return view('home', compact('totalPasien', 'pasienUmum',
            'pasienBPJS', 'pasienKartuHijau', 'pasienProlanis',
            'totalKunjungan', 'kunjunganUmum', 'kunjunganBpjs',
            'kunjunganHijau', 'kunjunganProlanis', 'totalPercentage',
            'umumPercentage', 'bpjsPercentage', 'hijauPercentage', 'prolanisPercentage',
            'totalStatus', 'umumStatus', 'bpjsStatus', 'prolanisStatus', 'kunjungans', 'polis',
            'harian', 'harianUmum', 'harianBpjs', 'harianHijau'
        ));
    }

}
