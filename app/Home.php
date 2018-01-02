<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    public function getJumlahPasien(){
        $totalPasien = Pasien::all()->count();
        return $totalPasien;
    }

    public function getJumlahKunjungan(){
        $now = Carbon::now();
        $cm = $now->month;
        $totalKunjungan = PasienPoli::with('pasien')->whereMonth('created_at', '=', $cm)->count();
        return $totalKunjungan;
    }

    public function getPasienUmum(){
        $pasienUmum = Pasien::where('id_kategori', '=', 1)->count();
        return $pasienUmum;
    }

    public function getKunjunganUmum(){
        $now = Carbon::now();
        $cm = $now->month;
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
        return $kunjunganUmum;
    }

    public function getPasienBPJS(){
        $pasienBPJS = Kpi::where('kpi', '=', 'pasienbpjs')->first();
        return $pasienBPJS->bobot;
    }

    public function getKunjunganBpjs(){
        $now = Carbon::now();
        $cm = $now->month;
        $kBpjs = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->whereMonth('pasien_poli.created_at', '=', $cm)
            ->whereIn('pasiens.id_kategori', [2,4])
            ->groupBy('pasien_poli.pasien_id')->get();
        $kunjunganBpjs = $kBpjs->count();
        return $kunjunganBpjs;
    }

    public function getPasienHijau(){
        $pasienHijau = Pasien::where('id_kategori', '=', 3)->count();
        return $pasienHijau;
    }

    public function getKunjunganHijau(){
        $now = Carbon::now();
        $cm = $now->month;
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
        return $kunjunganHijau;
    }

    public function getPasienProlanis(){
        $pasienProlanis = Pasien::where('id_kategori', '=', 4)->count();
        return $pasienProlanis;
    }

    public function getKunjunganProlanis(){
        $now = Carbon::now();
        $cm = $now->month;
        $kunjunganProlanis = Prolanis::whereMonth('created_at', '=', $cm)->get()->count();
        return $kunjunganProlanis;
    }

    //harian
    public function getharian(){
        $now = Carbon::now();
        $cm = $now->day;
        $totalKunjungan = PasienPoli::with('pasien')->whereDay('created_at', '=', $cm)->count();
        return $totalKunjungan;
    }

    public function getHarianUmum(){
        $now = Carbon::now();
        $cm = $now->day;
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
            ->where('pasiens.id_kategori', '=', '1')->whereDay('pasien_poli.created_at', '=', $cm)->count();
        return $kunjunganUmum;
    }

    public function getHarianBpjs(){
        $now = Carbon::now();
        $cd = $now->day;
        $cm = $now->month;
        $kBpjs = PasienPoli::query('pasien_poli')
            ->select('pasien_poli.*')
            ->join('pasiens', 'pasien_poli.pasien_id', '=', 'pasiens.id')
            ->whereDay('pasien_poli.created_at', '=', $cd)
            ->whereMonth('pasien_poli.created_at', '=', $cm)
            ->whereIn('pasiens.id_kategori', [2,4])
            ->groupBy('pasien_poli.pasien_id')->get();
        $kunjunganBpjs = $kBpjs->count();
        return $kunjunganBpjs;
    }

    public function getHarianHijau(){
        $now = Carbon::now();
        $cm = $now->day;
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
            ->where('pasiens.id_kategori', '=', '3')->whereDay('pasien_poli.created_at', '=', $cm)->count();
        return $kunjunganHijau;
    }
}
