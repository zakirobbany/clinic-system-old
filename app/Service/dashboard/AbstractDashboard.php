<?php

namespace App\Service\Dashboard;

use App\KategoriPasien;
use App\Kpi;
use App\Pasien;
use App\PasienPoli;
use App\Prolanis;

abstract class AbstractDashboard
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function patients()
    {
        return Pasien::all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function KPI()
    {
        return Kpi::all();
    }

    /**
     * @return mixed
     */
    public function KPIGeneralVisitors()
    {
        return $this->KPI()->where('kpi', '=', 'kunjungan')->first()->bobot;
    }

    /**
     * @return mixed
     */
    public function KPIBPJSVisitors()
    {
        return $this->KPI()->where('kpi', '=', 'bpjs')->first()->bobot;
    }

    /**
     * @return mixed
     */
    public function KPIProlanisVisitors()
    {
        return $this->KPI()->where('kpi', '=', 'prolanis')->first()->bobot;
    }

    public function prolanis()
    {
        return Prolanis::all();
    }

    /**
     * @return static
     */
    public function generalPatients()
    {
        $generalPatients = $this->patients()->where('id_kategori', '=', 1);

        return $generalPatients;
    }

    /**
     * @return static
     */
    public function bpjsPatients()
    {
        $bpjsPatients = $this->patients()->where('id_kategori', '=', 2);

        return $bpjsPatients;
    }

    /**
     * @return static
     */
    public function greenPatients()
    {
        $greenPatients = $this->patients()->where('id_kategori', '=', 3);

        return $greenPatients;
    }

    /**
     * @return static
     */
    public function prolanisPatients()
    {
        $prolanisPatients = $this->patients()->where('id_kategori', '=', 4);

        return $prolanisPatients;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function patientPolicies()
    {
        return PasienPoli::all();
    }
}