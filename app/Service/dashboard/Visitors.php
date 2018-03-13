<?php

namespace App\Service\Dashboard;

use App\PasienPoli;
use Carbon\Carbon;

class Visitors extends AbstractDashboard
{
    private $today;

    public function __construct()
    {
        $this->today = Carbon::now();
    }

    public function todayVisitors()
    {
        $visitorsToday = $this->patientPolicies()->filter(function ($visit) {
            if ($visit->created_at->toDateString() == $this->today->toDateString()) {
                return $visit;
            }
        });

        return $visitorsToday;
    }

    public function thisMonthVisitors()
    {
        $thisMonthVisitors = $this->patientPolicies()->filter(function ($visit) {
            if ($visit->created_at >= $this->today->firstOfMonth() and $visit->created_at <= $this->today->lastOfMonth()) {
                return $visit;
            }
        });

        return $thisMonthVisitors;
    }

    public function todayGeneralVisitors()
    {
        $visitors = PasienPoli::with('pasien')
            ->whereYear('created_at', $this->today->year)
            ->whereMonth('created_at', $this->today->month)
            ->whereDay('created_at', $this->today->day)
            ->get();

        $visitors = $visitors->filter(function ($visit) {
            if ($visit->pasien->id_kategori == 1) {
                return $visit;
            }
        });

        return $visitors;
    }

    public function thisMonthGeneralVisitors()
    {
        $visitors = PasienPoli::with('pasien')
            ->whereYear('created_at', $this->today->year)
            ->whereMonth('created_at', $this->today->month)
            ->get();

        $visitors = $visitors->filter(function ($visit) {
            if ($visit->pasien->id_kategori == 1) {
                return $visit;
            }
        });

        return $visitors;
    }

    public function todayBPJSVisitors()
    {
        $visitors = PasienPoli::with('pasien')
            ->whereYear('created_at', $this->today->year)
            ->whereMonth('created_at', $this->today->month)
            ->whereDay('created_at', $this->today->day)
            ->get();

        $visitors = $visitors->filter(function ($visit) {
            if ($visit->pasien->id_kategori == 2 or  $visit->pasien->id_kategori == 4) {
                return $visit;
            }
        });

        return $visitors->groupBy('pasien_id');
    }

    public function thisMonthBPJSVisitors()
    {
        $visitors = PasienPoli::with('pasien')
            ->whereYear('created_at', $this->today->year)
            ->whereMonth('created_at', $this->today->month)
            ->get();
        $visitors = $visitors->filter(function ($visit) {
            if ($visit->pasien->id_kategori == 2 or  $visit->pasien->id_kategori == 4) {
                return $visit;
            }
        });

        return $visitors->groupBy('pasien_id');
    }

    public function todayGreenVisitors()
    {
        $visitors = PasienPoli::with('pasien')
            ->whereYear('created_at', $this->today->year)
            ->whereMonth('created_at', $this->today->month)
            ->whereDay('created_at', $this->today->day)
            ->get();

        $visitors = $visitors->filter(function ($visit) {
            if ($visit->pasien->id_kategori == 3) {
                return $visit;
            }
        });

        return $visitors;
    }

    public function thisMonthGreenVisitors()
    {
        $visitors = PasienPoli::with('pasien')
            ->whereYear('created_at', $this->today->year)
            ->whereMonth('created_at', $this->today->month)
            ->get();

        $visitors = $visitors->filter(function ($visit) {
            if ($visit->pasien->id_kategori == 3) {
                return $visit;
            }
        });

        return $visitors;
    }

    public function thisMonthProlanisVisitors()
    {
        $prolanis = $this->prolanis()->filter(function ($p) {
            if ($p->created_at >= $this->today->firstOfMonth() and $p->created_at <= $this->today->lastOfMonth()) {
                return $p;
            }
        });

        return $prolanis;
    }
}