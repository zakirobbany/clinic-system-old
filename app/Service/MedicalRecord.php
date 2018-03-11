<?php

namespace App\Service;

use App\RekamMedis;
use App\RekamMedisDiagnosis;
use App\RekamMedisObat;
use Carbon\Carbon;

class MedicalRecord
{
    private $year;
    private $month;
    private $day;

    public function __construct()
    {
        $this->year = Carbon::now()->year;
        $this->month = Carbon::now()->month;
        $this->day = Carbon::now()->day;
    }

    public function medicalRecord()
    {
        $data = RekamMedis::with('obat', 'diagnoses')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();

        return $data;
    }

    public function medicalRecordMedicine()
    {
        $data = RekamMedisObat::with('obat', 'rekamMedis')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();

        return $data;
    }

    public function medicalRecordDiagnoses()
    {
        $data = RekamMedisDiagnosis::with('diagnosis', 'rekamMedis')
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->get();

        return $data;
    }
    public function medicalRecordCollection()
    {

        return $this->medicalRecord();
    }
}