<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Kpi;
use App\Pasien;
use App\PasienPoli;
use App\Rujukan;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class KpiController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $cm = $now->month;
        $pasienUmum = Pasien::where('id_kategori', '=', 1)->count();
        $kunjunganUmum = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '1')->whereMonth('pasien_poli.created_at', '=', $cm)->count();
        $umumPercentage = ($kunjunganUmum / $pasienUmum) *100;
        $kunjunganHijau = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '3')->whereMonth('pasien_poli.created_at', '=', $cm)->count();
        $pasienHijau = Pasien::where('id_kategori', '=', 3)->count();
        $hijauPercentage = ($kunjunganHijau / $pasienHijau) * 100;
        $kunjunganProlanis = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*',
                'pasien_poli.pasien_id',
                'pasien_poli.poli_id',
                'pasien_poli.dokter_id',
                'pasien_poli.created_at',
                'pasien_poli.id',
                'pasiens.id',
                'pasiens.nama',
                'pasiens.id_kategori')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', '4')->whereMonth('pasien_poli.created_at', '=', $cm)->count();
        $pasienProlanis = Pasien::where('id_kategori', '=', 4)->count();
        $prolanisPercentage = ($kunjunganProlanis / $pasienProlanis) *  100;
        $rujukanBpjs = Rujukan::query('rujukans')
            ->select('rujukans.*')
            ->join('pasien_poli', 'rujukans.pasien_poli_id', '=', 'pasien_poli.id')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->where('pasiens.id_kategori', '=', 2)->whereMonth('rujukans.created_at', '=', $cm)->count();
        $js = Kpi::where('kpi', '=', 'pasienbpjs')->first();
        $pasienBpjs = $js->bobot;
        $rujukan = ($rujukanBpjs / $pasienBpjs) * 100;
        $kBpjs = PasienPoli::query('pasien_poli')
        ->select('pasien_poli.*')
        ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
        ->where('pasiens.id_kategori', '=', 2)->whereMonth('pasien_poli.created_at', '=', $cm)
        ->groupBy('pasien_poli.pasien_id')->get();
        $kunjunganBpjs = $kBpjs->count();
        $bpjsPercentage = ($kunjunganBpjs / $pasienBpjs) *100;
        $mkb = Kpi::where('kpi', '=', 'bpjs')->first();
        $minKunjunganBpjs = $mkb->bobot;
        $c = Carbon::now();
        $days = $c->daysInMonth;
        $absensiDokter = Absensi::whereNotNull('dokter_id')->whereMonth('created_at', '=', $cm)->count();
        $absensiDokterPercentage = ($absensiDokter / $days ) * 100;
        $absensiPerawat = Absensi::whereNotNull('registrasi_id')->whereMonth('created_at', '=', $cm)->count();
        $absensiPerawatPercentage = ($absensiPerawat / $days) * 100;
        $minKunjunganUmum = Kpi::where('kpi', '=', 'kunjungan')->first();
        $minKunjunganUmum = $minKunjunganUmum->bobot;
        $minKunjunganProlanis = Kpi::where('kpi', '=', 'prolanis')->first();
        $minKunjunganProlanis = $minKunjunganProlanis->bobot;
        $maxRujukan = Kpi::where('kpi', '=', 'rujukan')->first();
        $maxRujukan = $maxRujukan->bobot;
        $minAbsensi = Kpi::where('kpi', '=', 'absensi')->first();
        $minAbsensi = $minAbsensi->bobot;
        $umumStatus = '';
        if($umumPercentage >= $minKunjunganUmum)
            $umumStatus = 'bg-green';
        elseif($umumPercentage < $minKunjunganUmum)
            $umumStatus = 'bg-red';
        $bpjsStatus = '';
        if ($bpjsPercentage >= $minKunjunganBpjs)
            $bpjsStatus = 'bg-green';
        elseif($bpjsPercentage < $minKunjunganBpjs)
            $bpjsStatus = 'bg-red';
        $hijauStatus = '';
        if($hijauPercentage >= $minKunjunganUmum)
            $hijauStatus = 'bg-green';
        elseif($hijauPercentage < $minKunjunganUmum)
            $hijauStatus = 'bg-red';
        $rujukanStatus = '';
        if ($rujukan >= $maxRujukan)
            $rujukanStatus = 'bg-red';
        elseif ($rujukan < $maxRujukan)
            $rujukanStatus = 'bg-green';
        $prolanisStatus = '';
        if ($prolanisPercentage >= $minKunjunganProlanis)
            $prolanisStatus = 'bg-green';
        elseif($prolanisPercentage < $minKunjunganProlanis)
            $prolanisStatus = 'bg-red';
        $absensiDokterStatus = '';
        if ($absensiDokterPercentage >= $minAbsensi)
            $absensiDokterStatus = 'bg-green';
        elseif ($absensiDokterPercentage < $minAbsensi)
            $absensiDokterStatus = 'bg-red';
        $absensiPerawatStatus = '';
        if ($absensiPerawatPercentage >= $minAbsensi)
            $absensiPerawatStatus = 'bg-green';
        elseif ($absensiPerawatPercentage < $minAbsensi)
            $absensiPerawatStatus = 'bg-red';
        $kpis = Kpi::get();
        return view('admin.kpi.index', compact('kpis', 'umumPercentage', 'hijauPercentage',
            'prolanisPercentage', 'rujukan', 'umumStatus', 'hijauStatus', 'rujukanStatus',
            'prolanisStatus', 'absensiDokterPercentage', 'absensiDokterStatus', 'absensiPerawatPercentage',
            'absensiPerawatStatus', 'bpjsPercentage', 'bpjsStatus'
            ));
    }

    public function kpi(){
        $kpis = Kpi::get();
        return view('admin.kpi.kpiindex', compact('kpis', 'kunjunganBpjs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kpi = Kpi::findOrFail($id);
        return view('admin.kpi.edit', compact('kpi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kpi = Kpi::findOrFail($id);
        $this->validate($request, [
           'kpi'=>'required',
            'bobot'=>'required'
        ]);
        $kpi->update($request->all());
        Session::flash("flash_notification", [
           "level" => "success",
            "message" => "Berhasil merubah KPI $kpi->kpi"
        ]);
        return redirect()->route('kpi.kpi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
