<?php

namespace App\Http\Controllers;

use App\Home;
use App\Kpi;
use App\Pasien;
use App\Service\Dashboard\Visitors;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        /*
         * visitor instance
         * */
        $visitors = new Visitors();

        /*
         * Total Patients
         * */
        $totalPatients = $visitors->patients()->count();
        $totalGeneralPatients = $visitors->generalPatients()->count();
        $totalBPJSPatients = $visitors->KPI()->where('kpi', '=', 'pasienbpjs')->first()->bobot;
        $totalGreenPatients = $visitors->greenPatients()->count();
        $totalProlanisPatients = $visitors->prolanisPatients()->count();

        /*
         * Daily Visitors
         * */
        $todayVisitors = $visitors->todayVisitors()->count();
        $todayGeneralVisitors = $visitors->todayGeneralVisitors()->count();
        $todayBPJSVisitors = $visitors->todayBPJSVisitors()->count();
        $todayGreenVisitors = $visitors->todayGreenVisitors()->count();

        /*
         * Monthly Visitors
         * */
        $monthVisitors = $visitors->thisMonthGeneralVisitors()->count();
        $monthGeneralVisitors = $visitors->thisMonthGeneralVisitors()->count();
        $monthBPJSVisitors = $visitors->thisMonthBPJSVisitors()->count();
        $monthGreenVisitors = $visitors->thisMonthGreenVisitors()->count();
        $monthProlanisVisitors = $visitors->thisMonthProlanisVisitors()->count();

        /*
         * KPI
         * */
        $generalKPI = $visitors->KPIGeneralVisitors();
        $BPJSKPI = $visitors->KPIBPJSVisitors();
        $prolanisKPI = $visitors->KPIProlanisVisitors();

        /*
         * Percentage
         * */
        $totalPercentage = ($monthVisitors / $totalPatients) * 100;
        $generalPercentage = ($monthGeneralVisitors / $totalGeneralPatients) * 100;
        $BPJSPercentage = ($monthBPJSVisitors / $totalBPJSPatients) * 100;
        $greenPercentage = ($monthGreenVisitors / $totalGreenPatients) * 100;
        $prolanisPercentage = ($monthProlanisVisitors / $totalProlanisPatients) * 100;

        $totalStatus = '';
        if ($totalPercentage >= $generalKPI)
            $totalStatus = 'green';
        elseif ($totalPercentage <= $generalKPI)
            $totalStatus = 'red';

        $generalStatus = '';
        if ($generalPercentage >= $generalKPI)
            $generalStatus = 'green';
        elseif ($generalPercentage <= $generalKPI)
            $generalStatus = 'red';

        $BPJSStatus = '';
        if ($BPJSPercentage >= $BPJSKPI)
            $BPJSStatus = 'green';
        elseif ($BPJSPercentage<$BPJSKPI)
            $BPJSStatus = 'red';

        $prolanisStatus = '';
        if ($prolanisPercentage >= $prolanisKPI)
            $prolanisStatus = 'green';
        elseif ($prolanisPercentage < $prolanisKPI)
            $prolanisStatus = 'red';

        return view('home', compact('totalPatients', 'totalGeneralPatients',
            'totalBPJSPatients', 'totalGreenPatients', 'totalProlanisPatients',
            'monthVisitors', 'monthGeneralVisitors', 'monthBPJSVisitors',
            'monthGreenVisitors', 'monthProlanisVisitors', 'totalPercentage',
            'generalPercentage', 'BPJSPercentage', 'greenPercentage', 'prolanisPercentage',
            'totalStatus', 'generalStatus', 'BPJSStatus', 'prolanisStatus',
            'todayVisitors', 'todayGeneralVisitors', 'todayBPJSVisitors', 'todayGreenVisitors'
        ));
    }

}
